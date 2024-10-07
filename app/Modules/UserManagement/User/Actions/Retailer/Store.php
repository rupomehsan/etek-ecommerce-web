<?php

namespace App\Modules\UserManagement\User\Actions\Retailer;

use Illuminate\Support\Facades\Hash;

class Store
{
    static $model = \App\Modules\UserManagement\User\Models\Model::class;
    static $userAddress = \App\Modules\UserManagement\User\Models\UserAddressModel::class;
    static $userAddressContactPerson = \App\Modules\UserManagement\User\Models\UserAddressContactPersonModel::class;
    static $userRetailerInfoModel = \App\Modules\UserManagement\User\Models\UserRetailerInformationModel::class;
    static $userShow = \App\Modules\UserManagement\User\Actions\Retailer\Show::class;
    public static function execute($request)
    {
        try {
            // dd($request->userAddress);
            $requestData = $request->validated();
            $requestData['role_id'] = 6;
            unset($requestData['confirmed']);
            //additional validation
            $additionalValidationData = [];
            if (!$request->retailer_type_id) {
                // $additionalValidationData[] = 'retailer_type_id';
                // $response = additionalValidation($additionalValidationData);
                // if ($response) {
                //     return $response;
                // }
            }

            if(request()->get('password')) {
                $requestData['password'] = Hash::make(request()->get('password'));
            }else{
             unset( $requestData['password'] );
            }
            //store data
            if ($userData = self::$model::create($requestData)) {

                self::$userRetailerInfoModel::create([
                    'user_id' => $userData->id,
                    'retailer_type_id' => $request->retailer_type_id,
                    'retailer_id' => $request->retailer_id,
                    'alt_email' => $request->alt_email,
                    'alt_mobile_number' => $request->alt_mobile_number,
                ]);

                if ($request->userAddress) {

                    $userAddressContactPersons = [];
                    foreach ($request->userAddress as $key => $address) {

                        $address = (object) $address;
                        $userAddressData = [
                           'user_id' => $userData->id ?? null,
                            'is_shipping' => $address->is_shipping ?? null,
                            'is_billing' => $address->is_billing ?? null,
                            'address_types' => $address->address_types ?? null,
                            'address' => $address->address ?? null,
                            'country_id' => $address->country_id ?? null,
                            'state_division_id' => $address->state_division_id ?? null,
                            'division_id' => $address->division_id ?? null,
                            'district_id' => $address->district_id ?? null,
                            'station_id' => $address->station_id ?? null,
                            'city_id' => $address->city_id ?? null,
                            'zip_code' => $address->zip_code ?? null,
                            'is_present_address' => $address->is_present_address ?? null,
                            'is_permanent_address' => $address->is_permanent_address ?? null,
                        ];



                        $userAddressDataStore = self::$userAddress::create($userAddressData);

                        if (isset($address->contact_persons)) {
                            foreach ($address->contact_persons as $contactPerson) {
                                $contactPerson = (object) $contactPerson;
                                $userAddressContactPersons[] = [
                                 'user_id' => $userData->id ?? null,
                                    'user_address_id' => $userAddressDataStore->id ?? null,
                                    'name' => $contactPerson->name ?? null,
                                    'phone_number' => $contactPerson->phone_number ?? null,
                                    'email' => $contactPerson->email ?? null,
                                ];
                            }
                        }
                    }

                    if (!empty($userAddressContactPersons)) {
                        self::$userAddressContactPerson::insert($userAddressContactPersons);
                    }
                }

                return self::$userShow::execute($userData->slug);
            }
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [],500, 'server_error');
        }
    }
}
