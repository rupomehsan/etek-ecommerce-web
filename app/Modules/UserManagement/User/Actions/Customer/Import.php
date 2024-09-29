<?php

namespace App\Modules\UserManagement\User\Actions\Customer;

use Illuminate\Support\Facades\Hash;

class Import
{
    static $model = \App\Modules\UserManagement\User\Models\Model::class;
    static $userCustomerInfoModel = \App\Modules\UserManagement\User\Models\UserCustomerInformationModel::class;
    static $roleModel = \App\Modules\UserManagement\UserRole\Models\Model::class;
    static $userAddress = \App\Modules\UserManagement\User\Models\UserAddressModel::class;
    static $userAddressContactPerson = \App\Modules\UserManagement\User\Models\UserAddressContactPersonModel::class;
    public static function execute()
    {
        try {
            $existEmail = [];
            foreach (request()->data as $row) {
                $isEmailExist = self::$model::where('email', $row['email'])->exists();
                if ($isEmailExist) {
                    $existEmail[] = $row;
                } else {

                    $userData = self::$model::create([
                        "name" => $row['name'],
                        "user_name" => $row['user_name'],
                        "email" => $row['email'],
                        "password" => Hash::make($row['password']),
                        "role_id" =>   3,
                    ]);

                    self::$userAddress::create([
                        "user_id" => $userData->id,
                        "is_shipping" => $row['is_shipping'] == "yes" ? 1 : 0,
                        "is_billing" => $row['is_billing'] == "yes" ? 1 : 0,
                        "address_types" => $row['address_types'] ?? 'store',
                        "address" => $row['address'],
                        "country_id" => $row['country'] ?? null,
                        "state_division_id" => $row['state'] ?? null,
                        "division_id" => $row['division'] ?? null,
                        "district_id" => $row['district'] ?? null,
                        "station_id" => $row['station'] ?? null,
                        "city_id" => $row['city'] ?? null,
                        "zip_code" => $row['zip_code'] ?? null,
                        "is_present_address" => $row['is_present_address'] == "yes" ? 1 : 0,
                        "is_permanent_address" => $row['is_permanent_address'] == "yes" ? 1 : 0,
                    ]);

                    self::$userCustomerInfoModel::create([
                        'user_id' => $userData->id,
                        'customer_type_id' => $row['customer_type_id'] ?? null,
                        'website' => $row['website'] ?? null,
                        'client_id' => $row['client_id'] ?? null,
                    ]);
                }
            }

            return messageResponse('Items imported successfully');
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [],500, 'server_error');
        }
    }
}
