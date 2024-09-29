<?php

namespace App\Modules\ProductManagement\ProductMenufacturer\Actions;

use Illuminate\Support\Facades\Storage;

class Store
{
    static $model = \App\Modules\ProductManagement\ProductMenufacturer\Models\Model::class;

    public static function execute($request)
    {
        try {
            $requestData = $request->validated();
            if ($data = self::$model::query()->create($requestData)) {

                if(request()->hasFile('image')){
                    $data->image = Storage::put('uploads/manufacturers', request()->file('image'));
                }
                $data->save();

                return messageResponse('Item added successfully', $data, 201);
            }
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(),[], 500, 'server_error');
        }
    }
}
