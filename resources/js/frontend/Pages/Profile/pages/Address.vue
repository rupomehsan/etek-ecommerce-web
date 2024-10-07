<template>
    <ProfileLayout :bread_cumb="bread_cumb">
        <div class="dashboard position-relative">
            <div class="page-title d-flex justify-content-between">
                <h2>
                    Address book
                </h2>
                <div>
                    <Link href="address/create" class="btn btn-normal">Add new</Link>
                </div>
            </div>
            <hr>

            <div v-if="user_address_info.length">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th>Set Default</th>
                            <th>Street Address</th>
                            <th>division</th>
                            <th>district</th>
                            <th>station</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="item in user_address_info" :key="item.id">
                            <td> <i @click="setDefault(item.id)" title="default address"
                                    :class="item.is_default ? 'text-success fw-bold' : 'text-secondary'"
                                    class="fa fa-check c-pointer "></i> {{ item.address }}</td>
                            <td>{{ item.address }}</td>
                            <td>{{ item.division?.name }}</td>
                            <td>{{ item.district?.name }}</td>
                            <td>{{ item.station?.name }}</td>
                            <td>
                                <div>
                                    <button title="show contact person" type="button" class="btn btn-info btn-sm"
                                        @click="getContactPersonByAddress(item.id)">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                    <Link :href="`address/create?id=${item.id}`"  type="button" title="Edit"
                                        class="btn btn-info btn-sm mx-1"><i class="fa fa-edit"></i></Link>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>

            </div>

            <div v-if="contact_person_modal_show" class="contact-person-modal">
                <div class="">
                    <div class="card">
                        <span @click="contact_person_modal_show = false" class="c-pointer position-absolute"
                            style="right: 10px;">x</span>
                        <div class="card-body">
                            <table class="table table-bordered text-center">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Email</th>


                                    </tr>
                                </thead>
                                <tbody>
                                    <template v-if="contact_person.length">
                                        <tr v-for="item in contact_person" :key="item">
                                            <td>{{ item.name }}</td>
                                            <td>{{ item.phone_number }}</td>
                                            <td>{{ item.email }}</td>
                                        </tr>
                                    </template>
                                    <template v-else>
                                        <tr>
                                            <td colspan="3">Not found</td>

                                        </tr>
                                    </template>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div v-if="address_contact_form_show" class="address-contact-form">
                <span @click="address_contact_form_show = fasle"
                    class="position-absolute border p-1 m-1 c-pointer text-danger fw-bold"
                    style="right: 0px;top:0px;z-index: 10;">x</span>
                <div class="card px-2 py-5">

                    <address-form :user_address="user_address"></address-form>
                </div>
            </div>
        </div>

    </ProfileLayout>
</template>

<script>
import axios from "axios";
import ProfileLayout from "../shared/ProfileLayout.vue";
import { auth_store } from "../../../Store/auth_store.js";
import AddressForm from '../components/AddressForm.vue';

export default {
    components: { ProfileLayout, AddressForm },
    props: {
        user_address: Object,
    },
    data: () => ({
        user_address_info: [],
        bread_cumb: [
            {
                title: 'profile',
                url: '/profile',
                active: false,
            },
            {
                title: 'address',
                url: '/profile/address',
                active: true,
            },
        ],
        contact_person_modal_show: false,
        address_contact_form_show: false,
        contact_person: [],
    }),
    created: async function () {
        const authStore = auth_store();
        await authStore.check_is_auth();
        if (authStore.auth_info && authStore.auth_info?.user_delivery_address.length) {
            this.user_address_info = authStore.auth_info?.user_delivery_address
        }
    },

    methods: {
        setDefault: async function (id) {
            var data = await window.s_confirm('Are you want set it default?');
            if (data) {
                let response = await window.privateAxios('set-default-address', 'post', { id: id })
                window.s_alert(response.message)
                this.user_address_info = this.user_address_info.map(item => ({
                    ...item,
                    is_default: item.id === id ? 1 : 0 // Set the selected item as default and reset others
                }));
            }
        },
        getContactPersonByAddress: async function (id) {
            let response = await window.privateAxios('get-contact-person-by-address-id/' + id)
            if (response.status == 'success') {
                this.contact_person = response.data
                this.contact_person_modal_show = true
            }
        },
        getSingleAddressInformation: async function (id) {
            let response = await window.privateAxios('get-single-address/' + id)
            if (response.status == 'success') {
                this.contact_person = response.data
                this.contact_person_modal_show = true
            }
        }
    }
}

</script>
<style>
.contact-person-modal {
    position: absolute;
    top: 50%;
    left: 50%;
    width: 50%;
    height: auto;
    transform: translate(-50%, -50%);
    box-shadow: 0px 0px 5px #717171;
}

.address-contact-form {
    position: absolute;
    top: 50%;
    left: 50%;
    width: 100%;
    height: auto;
    max-height: 500px;
    overflow-y: auto;
    transform: translate(-50%, -50%);
    box-shadow: 0px 0px 5px #717171;
}
</style>
