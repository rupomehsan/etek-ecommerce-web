<?php

namespace App\Modules\ProductManagement\ProductMenufacturer\Actions;

use Illuminate\Support\Facades\Storage;

class Update
{
    static $model = \App\Modules\ProductManagement\ProductMenufacturer\Models\Model::class;

    public static function execute($request,$slug)
    {
        try {
            if (!$data = self::$model::query()->where('slug', $slug)->first()) {
                return messageResponse('Data not found...',$data, 404, 'error');
            }
            $requestData = $request->validated();
            $data->update($requestData);
            if(request()->hasFile('image')){
                $data->image = Storage::put('uploads/manufacturers', request()->file('image'));
            }
            $data->save();
            return messageResponse('Item updated successfully',$data, 201);
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(),[], 500, 'server_error');
        }
    }
}
