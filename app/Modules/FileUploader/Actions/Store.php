<?php

namespace App\Modules\FileUploader\Actions;

class Store
{
    static $model = \App\Modules\FileUploader\Models\Model::class;

    public static function execute($request)
    {
        try {

            $images = [];
            $folderName = $request->folder_name ?? 'images';

            if ($request->has('images') && is_array($request->images) && count($request->images)) {

                foreach ($request->images as $key => $image) {
                    $file = $request->file('images.' . $key);
                    $imageName = uploader($file, "uploads/{$folderName}");
                    $images[] = $imageName;
                }

                if (!empty($images)) {
                    return messageResponse('Files successfully uploaded', $images, 201);
                }
            }

            return messageResponse('No files uploaded', null, 400);
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
