<?php

namespace App\Modules\UserManagement\User\Actions\User;

use Illuminate\Support\Facades\Hash;



class Update
{
    static $model = \App\Modules\UserManagement\User\Models\Model::class;
    static $userAddressModel = \App\Modules\UserManagement\User\Models\UserAddressModel::class;
    static $userAddressContactPersonModel = \App\Modules\UserManagement\User\Models\UserAddressContactPersonModel::class;
    static $userCustomerInformation = \App\Modules\UserManagement\User\Models\UserCustomerInformationModel::class;
    static $userSupplierInformation = \App\Modules\UserManagement\User\Models\UserSupplierInformationModel::class;
    static $userEmployeeInformation = \App\Modules\UserManagement\User\Models\UserEmployeeInformationModel::class;
    public static function execute($request, $id)
    {
        try {


            $requestData = $request->validated();
            unset($requestData['confirmed']);
            if (!$userData = self::$model::where('slug',$id)->first()) {
                return messageResponse('Data not found...', [], 404, 'error');
            }

            if (!$userData) {
                return response()->json(['message' => 'Data not found'], 404);
            }

            if(request()->get('password')) {
                $requestData['password'] = Hash::make(request()->get('password'));
            }else{
             unset( $requestData['password'] );
            }

            $userData->fill($requestData)->save();

            if ($request->userAddress) {

                self::$userAddressModel::where('user_id', $userData->id)->delete();
                self::$userAddressContactPersonModel::where('user_id', $userData->id)->delete();

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

                    $userAddressDataStore = self::$userAddressModel::create($userAddressData);

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
                    self::$userAddressContactPersonModel::insert($userAddressContactPersons);
                }
            }

            // if ($request->has('userAddress')) {
            //     $existingAddressIds = $userData->user_address()->pluck('id')->toArray();
            //     $newAddressIds = [];
            //     $userAddressContactPersons = [];

            //     foreach ($request->userAddress as $address) {
            //         $address = (object) $address;
            //         $addressData = [
            //             'user_id' => $userData->id,
            //             'is_shipping' => $address->is_shipping,
            //             'is_billing' => $address->is_billing,
            //             'address_types' => $address->address_types,
            //             'address' => $address->address,
            //             'country_id' => $address->country_id,
            //             'state_division_id' => $address->state_division_id,
            //             'division_id' => $address->division_id,
            //             'district_id' => $address->district_id,
            //             'station_id' => $address->station_id,
            //             'city_id' => $address->city_id,
            //             'zip_code' => $address->zip_code,
            //             'is_present_address' => $address->is_present_address,
            //             'is_permanent_address' => $address->is_permanent_address,
            //         ];

            //         if (isset($address->id) && in_array($address->id, $existingAddressIds)) {
            //             $userAddress = self::$userAddress::find($address->id);
            //             $userAddress->update($addressData);
            //             $newAddressIds[] = $userAddress->id;
            //         } else {
            //             $userAddress = self::$userAddress::create($addressData);
            //             $newAddressIds[] = $userAddress->id;
            //         }

            //         if (isset($address->contact_persons)) {
            //             foreach ($address->contact_persons as $contactPerson) {
            //                 $contactPerson = (object) $contactPerson;
            //                 $contactPersonData = [
            //                     'user_id' => $userData->id,
            //                     'user_address_id' => $userAddress->id,
            //                     'name' => $contactPerson->name,
            //                     'phone_number' => $contactPerson->phone_number,
            //                     'email' => $contactPerson->email,
            //                 ];

            //                 if (isset($contactPerson->id)) {
            //                     $userAddressContactPerson = self::$userAddressContactPerson::find($contactPerson->id);
            //                     $userAddressContactPerson->update($contactPersonData);
            //                 } else {
            //                     $userAddressContactPersons[] = $contactPersonData;
            //                 }
            //             }
            //         }
            //     }

            //     if (!empty($userAddressContactPersons)) {
            //         self::$userAddressContactPerson::insert($userAddressContactPersons);
            //     }

            //     $addressesToDelete = array_diff($existingAddressIds, $newAddressIds);
            //     self::$userAddress::destroy($addressesToDelete);
            // }
            return messageResponse('Item updated successfully');
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
