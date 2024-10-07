<?php

namespace App\Modules\UserManagement\User\Actions\Employee;

use Illuminate\Support\Facades\Hash;

class Store
{
    static $model = \App\Modules\UserManagement\User\Models\Model::class;
    static $userAddress = \App\Modules\UserManagement\User\Models\UserAddressModel::class;
    static $userAddressContactPerson = \App\Modules\UserManagement\User\Models\UserAddressContactPersonModel::class;
    static $userEmployeeInfoModel = \App\Modules\UserManagement\User\Models\UserEmployeeInformationModel::class;
    // static $userShow = \App\Modules\UserManagement\User\Actions\Customer\Show::class;
    public static function execute($request)
    {
        // dd(request()->all());
        try {
            // dd($request->userAddress);
            $requestData = $request->validated();
            $requestData['role_id'] = 9;
            unset($requestData['confirmed']);

            if(request()->get('password')) {
                $requestData['password'] = Hash::make(request()->get('password'));
            }else{
             unset( $requestData['password'] );
            }

            //store data
            if ($userData = self::$model::create($requestData)) {

                self::$userEmployeeInfoModel::create([
                    'user_id' => $userData->id,
                    'gender' => $request->gender,
                    'nick_name' => $request->nick_name,
                    'employee_code' => $request->employee_code,
                    'date_of_birth' => $request->date_of_birth,
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

                return messageResponse('Item added successfully', $userData, 201);
            }
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [],500, 'server_error');
        }
    }
}
