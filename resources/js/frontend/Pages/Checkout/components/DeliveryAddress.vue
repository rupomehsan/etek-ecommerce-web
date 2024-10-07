<template lang="">
    <div class="theme-form mt-4">
        <div class="row check-out ">
            <div class="checkout-title text-center">
                <h3>Delivery Address</h3>
                <hr>
            </div>
            <div class="form-group required">
                <label for="state_division_id">Division</label>
                <select name="state_division_id" id="state_division_id"
                    class="form-control" v-model="state_division_id">
                    <option value=""> --- Please Select --- </option>
                    <option v-for="(division, index) in divisions" :key="index" :value="division.id">
                        {{  division.name }}
                    </option>
                </select>
            </div>
            <div class="form-group required">
                <label for="district_id">District</label>
                <select name="district_id" id="district_id" class="form-control"
                    v-model="district_id" >
                    <option value=""> --- Please Select --- </option>
                    <option v-for="(district, index) in districts" :key="index"
                        :value="district.id" :selected="false">{{ district.name }}
                    </option>
                </select>
            </div>

            <div class="form-group required" v-if="stations?.length">
                <label for="station_id">Select Thana</label>
                <select name="station_id" id="station_id" class="form-control"
                    v-model="station_id" >
                    <option value=""> --- Please Select --- </option>
                    <option v-for="(station, index) in stations" :key="index"
                        :value="station.id" :selected="false">{{ station.name }}
                    </option>
                </select>
            </div>

            <div class="form-group required" v-else>
                <label class="field-label">Type Thana Name</label>
                <input type="text" name="station_id" id="station_id">
            </div>

            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                <label class="field-label">Address</label>
                <textarea type="text" name="address" id="address" rows="4" class="p-1"
                    :value="auth_info?.user_delivery_address?.address"
                    placeholder="address"></textarea>
            </div>
            <!-- <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <input type="checkbox" name="shipping-option" id="account-option">
                <label for="account-option">Create An Account?</label>
            </div> -->

        </div>
    </div>
</template>
<script>
import { check_out_store } from '../store/check_out_store';
import { mapState, mapWritableState } from "pinia";
import { auth_store } from '../../../Store/auth_store';
export default {
    data: () => ({
        state_division_id: 3,
        district_id: 1,
        station_id: 5,

        divisions: [],
        districts: [],
        stations: [],
    }),
    watch: {
        district_id: async function (v) {
            if(v != 1){
                this.is_outside_dhaka = 1;
            }else{
                this.is_outside_dhaka = 0;
            }
            await this.get_station_by_district_id(v);
            this.station_id = this.stations[0].id;
        },
        state_division_id: async function (v) {
            await this.get_district_by_state_division_id(v);
            if (this.districts.length){
                await this.get_station_by_district_id(this.districts[0].id);
                this.district_id = this.districts[0].id;
            }
        },
    },
    mounted: async function () {
        await this.all_division();
        await this.get_district_by_state_division_id(this.state_division_id);
        await this.get_station_by_district_id(this.district_id);
    },
    methods: {
        all_division: async function () {
            let response = await axios.get('/state-divisions', {
                params: {
                    sort_by_col: 'name',
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
                    sort_by_col: 'name',
                    sort_type: 'asc',
                    status: 'active',
                    fields: ['id', 'name']
                }
            })
            if (response.data.status === 'success') {
                this.districts = response.data.data
            }

        },
        get_station_by_district_id: async function (district_id) {
            let response = await axios.get(`/get-station-by-district-id/${district_id}`, {
                params: {
                    sort_by_col: 'name',
                    sort_type: 'asc',
                    status: 'active',
                    fields: ['id', 'name']
                }
            })
            if (response.data.status === 'success') {
                this.stations = response.data.data
            }
        },
    },
    computed: {
        ...mapWritableState(check_out_store, [
            "is_outside_dhaka"
        ]),
        ...mapState(auth_store, [
            "auth_info",
        ]),
    }
}
</script>
<style lang="">

</style>
