<?php

namespace App\Modules\WebsiteApi\Cart\Actions;

class Update
{
    static $model = \App\Modules\WebsiteApi\Cart\Models\Model::class;

    public static function execute()
    {
        try {
            // dd(request()->all());
            if (!$data = self::$model::query()->find(request()->cartId)) {
                return messageResponse('Data not found...', $data, 404, 'error');
            }

            if (request()->has('quantity') && request()->quantity > 0 && request()->quantity != null) {
                $data->update(['quantity' => request()->quantity]);
                return messageResponse('Cart updated successfully', $data, 201);
            }

            if (request()->has('action') && request()->action != null) {

                if (request()->action === 'minus') {
                    if ($data->quantity > 1) {
                        $data->decrement('quantity');
                    } else {
                        return messageResponse('Quantity cannot be less than 1', $data, 200, 'warning');
                    }
                } elseif (request()->action === 'plus') {
                    $data->increment('quantity');
                }
                return messageResponse('Cart updated successfully', $data, 201);
            }


        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
