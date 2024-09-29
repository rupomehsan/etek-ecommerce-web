<?php

namespace App\Modules\PurchageManagement\PurchaseOrder\Actions;

use Carbon\Carbon;

class Update
{
    static $model = \App\Modules\PurchageManagement\PurchaseOrder\Models\Model::class;
    static $purchaseOrderProductsModel = \App\Modules\PurchageManagement\PurchaseOrder\Models\PurchaseOrderProductsModel::class;
    static $purchaseOrderChargeModel = \App\Modules\PurchageManagement\PurchaseOrder\Models\PurchaseChargeModel::class;
    /**
     * stock management model
     */
    static $producStockModel = \App\Modules\StockManagement\ProductStock\Models\Model::class;
    public static function execute($request, $slug)
    {
        try {
            if (!$purchaseOrder = self::$model::query()->where('slug', $slug)->first()) {
                return messageResponse('Data not found...', $purchaseOrder, 404, 'error');
            }
            $requestData = $request->validated();
            $subTotal = 0;
            if ($purchaseOrder->update($requestData)) {

                foreach ($requestData['products'] as $key => $product) {
                    $purchaseOrderProducts = self::$purchaseOrderProductsModel::where('purchase_order_id', $purchaseOrder->id)->where('id', $product->id)->first();
                    $purchaseOrderProducts->update([
                        "purchase_order_id" => $purchaseOrder->id,
                        "product_id" => $product->id,
                        "purchase_price" => $product->price,
                        "discount" => $product->dicount ?? 0,
                        "qty" => $product->qty,
                        "discount_type" => $product->discount_type,
                        "subtotal" => $product->price * $product->qty,
                        "total" => ($product->price * $product->qty) - $product->dicount,
                    ]);
                    $purchaseOrderCharge = self::$purchaseOrderChargeModel::where('purchase_order_id', $purchaseOrder->id)->where('purchase_order_product_id', $purchaseOrderProducts->id)->first();

                    $purchaseOrderCharge->update([
                        "purchase_order_id" => $purchaseOrder->id,
                        "purchase_order_product_id" => $purchaseOrderProducts->id,
                        "vat_id" => 1, //vat id kmne pabo
                        "vat_group_id" => null,
                        "amount" => $product->price * 2 / 100,
                    ]);

                    $purchaseOrderProducts->total += $purchaseOrderCharge->amount;
                    $purchaseOrderProducts->save();
                    $subTotal +=  $purchaseOrderProducts->total;

                    $producStock =  self::$producStockModel::create([
                        "purchase_order_id" => $purchaseOrder->id,
                        "date" => Carbon::now()->toDateString(),
                        "stock_type" => 'purchase',
                        "product_id" => $product->id,
                        "qty" => $purchaseOrderProducts->qty,
                        "bill_receipt_no" => $purchaseOrder->reference,
                    ]);

                    $producStock->save();
                }

                $purchaseOrder->subtotal = $subTotal;
                $purchaseOrder->total = $subTotal - $purchaseOrder->discount_on_all;
                $purchaseOrder->save();


                return messageResponse('Item added successfully', $purchaseOrder, 201);
            }
            return messageResponse('Item updated successfully', $data, 201);
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
