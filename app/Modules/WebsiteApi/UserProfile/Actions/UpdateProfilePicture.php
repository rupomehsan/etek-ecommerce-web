<?php

namespace App\Modules\WebsiteApi\UserProfile\Actions;




class UpdateProfilePicture
{
    static $model = \App\Modules\UserManagement\User\Models\Model::class;

    public static function execute()
    {
        try {
            // dd(request()->all());
            if (!$userData = self::$model::find(auth()->id())) {
                return messageResponse('User not found...', [], 404, 'error');
            }

            $requestData = [];

            if (request()->hasFile('profile_picture')) {
                $image = request()->file('profile_picture');
                $imageName = uploader($image, 'uploads/user');
                $requestData['photo'] = $imageName;
            }

            $userData->update($requestData);

            return messageResponse('Profile picture successfully updated', $userData, 201, 'success');
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
