<?php

namespace App\Modules\UserManagement\User\Actions\Supplier;

use Illuminate\Support\Facades\Hash;

class Update
{
    static $model = \App\Modules\UserManagement\User\Models\Model::class;
    static $userAddressModel = \App\Modules\UserManagement\User\Models\UserAddressModel::class;
    static $userSupplierInfoModel = \App\Modules\UserManagement\User\Models\UserSupplierInformationModel::class;

    static $userShow = \App\Modules\UserManagement\User\Actions\Supplier\Show::class;
    static $userAddressContactPersonModel = \App\Modules\UserManagement\User\Models\UserAddressContactPersonModel::class;

    public static function execute($request, $id)
    {
        try {

            $requestData = $request->validated();
            unset($requestData['confirmed']);
            if (!$userData = self::$model::where('slug',$id)->first()) {
                return messageResponse('Data not found...', [], 404, 'error');
            }

            $additionalValidationData = [];
            if (!$request->supplier_type_id) {
                $additionalValidationData[] = 'supplier_type_id';
                $response = additionalValidation($additionalValidationData);
                if ($response) {
                    return $response;
                }
            }

            if(request()->get('password')) {
                $requestData['password'] = Hash::make(request()->get('password'));
            }else{
             unset( $requestData['password'] );
            }
            //store data
            $userData->fill($requestData)->save();
            if ( $userData) {
                $userSupplierInfoData = self::$userSupplierInfoModel::where('user_id', $userData->id)->first();
                if($userSupplierInfoData){
                    $userSupplierInfoData->update([
                        'user_id' => $userData->id,
                        'supplier_type_id' => $request->supplier_type_id,
                        'supplier_id' => $request->supplier_id,
                        'alt_email' => $request->alt_email,
                        'alt_mobile_number' => $request->alt_mobile_number,
                    ]);
                }

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
                //     dd($userData);
                //     $existingAddressIds = $userData->user_address()->pluck('id')->toArray();
                //     $newAddressIds = [];
                //     $userAddressContactPersons = [];

                //     foreach ($request->userAddress as $address) {
                //         $address = (object) $address;
                //         $addressData = [
                //             'user_id' => $userData->id,
                //             'is_shipping' => $address->is_shipping ?? null,
                //             'is_billing' => $address->is_billing ?? null,
                //             'address_types' => $address->address_types ?? null,
                //             'address' => $address->address ?? null,
                //             'country_id' => $address->country_id ?? null,
                //             'state_division_id' => $address->state_division_id ?? null,
                //             'division_id' => $address->division_id ?? null,
                //             'district_id' => $address->district_id ?? null,
                //             'station_id' => $address->station_id ?? null,
                //             'city_id' => $address->city_id ?? null,
                //             'zip_code' => $address->zip_code ?? null,
                //             'is_present_address' => $address->is_present_address ?? null,
                //             'is_permanent_address' => $address->is_permanent_address ?? null,
                //         ];

                //         if (isset($address->id) && in_array($address->id, $existingAddressIds)) {
                //             $userAddress = self::$userAddressModel::find($address->id);
                //             $userAddress->update($addressData);
                //             $newAddressIds[] = $userAddress->id;
                //         } else {
                //             $userAddress = self::$userAddressModel::create($addressData);
                //             $newAddressIds[] = $userAddress->id;
                //         }

                //         if (isset($address->contact_persons)) {
                //             foreach ($address->contact_persons as $contactPerson) {
                //                 $contactPerson = (object) $contactPerson;
                //                 $contactPersonData = [
                //                     'user_id' => $userData->id,
                //                     'user_address_id' => $userAddress->id,
                //                     'name' => $contactPerson->name ?? null,
                //                     'phone_number' => $contactPerson->phone_number ?? null,
                //                     'email' => $contactPerson->email ?? null,
                //                 ];

                //                 if (isset($contactPerson->id)) {
                //                     $userAddressContactPerson = self::$userAddressContactPersonModel::find($contactPerson->id);
                //                     $userAddressContactPerson->update($contactPersonData);
                //                 } else {
                //                     $userAddressContactPersons[] = $contactPersonData;
                //                 }
                //             }
                //         }
                //     }

                //     if (!empty($userAddressContactPersons)) {
                //         self::$userAddressContactPersonModel::insert($userAddressContactPersons);
                //     }

                //     $addressesToDelete = array_diff($existingAddressIds, $newAddressIds);
                //     self::$userAddressModel::destroy($addressesToDelete);
                // }
                return self::$userShow::execute($userData->slug);
            }
        } catch (\Exception $e) {
            // throw $e;
            return messageResponse($e->getMessage(),[], 500, 'server_error');
        }
    }
}
