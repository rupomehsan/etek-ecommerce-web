<template>
    <form action="" method="post" @submit.prevent="addressFormSubmitHandler($event)" enctype="multipart/form-data"
        class="form-horizontal">
        <div class="row">
            <div class="col-md-7">
                <p>Address information</p>
                <hr>
                <div class="form-group required">
                    <label for="address">Street Address</label>
                    <input type="text" :value="user_address.address" name="address" id="address"
                        placeholder="street address" class="form-control" />
                </div>
                <div class="form-group required">
                    <label for="country_id">Country</label>
                    <select name="country_id" id="country_id" class="form-control">
                        <option value=""> --- Please Select --- </option>
                        <option selected value="216">Bangladesh</option>
                    </select>
                </div>
                <div class="form-group required">
                    <label for="state_division_id">Division</label>
                    <select name="state_division_id" id="state_division_id" class="form-control"
                        v-model="state_division_id">
                        <option value=""> --- Please Select --- </option>
                        <option v-for="(division, index) in divisions" :key="index" :value="division.id"
                            :selected="division.id == user_address?.state_division_id ? 'selected' : ''">
                            {{ division.name }}</option>
                    </select>
                </div>
                <div class="form-group required">
                    <label for="district_id">District</label>
                    <select name="district_id" id="district_id" class="form-control" v-model="district_id"
                        :disabled="isSelectDistrictDisabled">
                        <option value=""> --- Please Select --- </option>
                        <option v-for="(district, index) in districts" :key="index" :value="district.id"
                            :selected="false">
                            {{ district.name }}</option>
                    </select>
                </div>
                <div class="form-group required">
                    <label for="station_id">Station</label>
                    <select name="station_id" id="station_id" class="form-control" v-model="station_id"
                        :disabled="isSelectStationDisabled">
                        <option value=""> --- Please Select --- </option>
                        <option v-for="(station, index) in stations" :key="index" :value="station.id" :selected="false">
                            {{ station.name }}</option>
                    </select>
                </div>

            </div>
            <div class="col-md-5">
                <div class="d-flex justify-content-between align-items-center">
                    <p>Contact person</p>
                    <button type="button" class="btn btn-info btn-sm border-b" @click="addContactPerson"> <i
                            class="fa fa-plus"></i>
                    </button>
                </div>
                <div class="border-top my-1"></div>
                <div v-for="(fields, index) in contact_person" :key="fields" class="  mt-3">
                    <p class="my-2">Person {{ index + 1 }}</p>
                    <div class="card p-1 position-relative">
                        <span @click="removeContactPerson(index)"
                            class="c-pointer p-1 position-absolute text-danger fw-bold" style="right: 5px;">x</span>
                        <div v-for="field in fields" :key="field" class="form-group required">
                            <label>{{ field.label }}</label>
                            <input type="text" :name="`contact_person[${index}][${field.name}]`" :value="field.value"
                                class="form-control" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center my-3">
            <button class="btn btn-normal">Submit</button>
        </div>
    </form>
</template>

<script>
import axios from "axios";
import { auth_store } from "../../../Store/auth_store.js";

export default {

    props: {
        user_address: Object,
    },
    data: () => ({
        user_address_info: [],
        contact_person: [
            [
                {
                    label: 'Name',
                    name: 'name',
                    value: '',
                },
                {
                    label: 'Email',
                    name: 'email',
                    value: '',
                },
                {
                    label: 'Phone number',
                    name: 'phone_number',
                    value: '',
                },
            ]

        ],

        isSelectDistrictDisabled: true,
        isSelectStationDisabled: true,

        divisions: null,
        districts: null,
        stations: null,

        state_division_id: '',
        district_id: '',
        station_id: '',


    }),
    created: async function () {
        const authStore = auth_store();
        await this.all_division();

        if (this.user_address) {
            this.state_division_id = this.user_address?.state_division_id
            this.district_id = this.user_address?.district_id
            this.station_id = this.user_address?.station_id

            if (this.user_address?.user_address_contact_person?.length) {
                this.contact_person = []
                this.user_address?.user_address_contact_person.forEach(item => {
                    let dataListArray = [
                        {
                            label: 'Name',
                            name: 'name',
                            value: item.name,
                        },
                        {
                            label: 'Email',
                            name: 'email',
                            value: item.email,
                        },
                        {
                            label: 'Phone number',
                            name: 'phone_number',
                            value: item.phone_number,
                        },
                    ]

                    this.contact_person.push(dataListArray)
                });
            }
        }
    },
    watch: {
        state_division_id: function (divisionId) {
            this.get_district_by_state_division_id(divisionId);
        },
        district_id: function (districtId) {
            this.get_station_by_district_id(districtId);
        }
    },
    methods: {

        addressFormSubmitHandler: async function (event) {
            if (this.user_address.id) {
                let formData = new FormData(event.target);
                let response = await window.privateAxios('address-info-update/' + this.user_address.id, 'post', formData);
                if (response.status === "success") {
                    window.s_alert(response.message);
                }
            } else {
                let formData = new FormData(event.target);
                let response = await window.privateAxios('/customer-address-create', 'post', formData);
                if (response.status === "success") {
                    window.s_alert(response.message);
                }
            }

        },

        all_division: async function () {
            let response = await axios.get('/state-divisions', {
                params: {
                    sort_by_col: 'id',
                    sort_type: 'asc',
                    status: 'active',
                    fields: ['id', 'name'],
                    get_all: 1,
                }
            })
            if (response.data.status === 'success') {
                this.divisions = response.data.data
            }
        },
        get_district_by_state_division_id: async function (state_division_id) {
            let response = await axios.get(`/get-district-by-division-id/${state_division_id}`, {
                params: {
                    sort_by_col: 'id',
                    sort_type: 'asc',
                    status: 'active',
                    fields: ['id', 'name']
                }
            })
            if (response.data.status === 'success') {
                this.districts = response.data.data
                this.isSelectDistrictDisabled = false;
            }

        },
        get_station_by_district_id: async function (district_id) {
            let response = await axios.get(`/get-station-by-district-id/${district_id}`, {
                params: {
                    sort_by_col: 'id',
                    sort_type: 'asc',
                    status: 'active',
                    fields: ['id', 'name']
                }
            })
            if (response.data.status === 'success') {
                this.stations = response.data.data
                this.isSelectStationDisabled = false;
            }

        },
        addContactPerson() {
            let dataListArray = [
                {
                    label: 'Name',
                    name: 'name',
                    value: '',
                },
                {
                    label: 'Email',
                    name: 'email',
                    value: '',
                },
                {
                    label: 'Phone number',
                    name: 'phone_number',
                    value: '',
                },
            ]

            this.contact_person.push(dataListArray)
        },
        removeContactPerson(indexToRemove) {

            this.contact_person = this.contact_person.filter((_, index) => index !== indexToRemove)
        }
    },


};
</script>

<style></style>
