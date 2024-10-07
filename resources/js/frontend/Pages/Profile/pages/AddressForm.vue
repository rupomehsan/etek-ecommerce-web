<template>
    <ProfileLayout :bread_cumb="bread_cumb">
        <div class="dashboard position-relative">
            <div class="page-title d-flex justify-content-between">
                <h2>
                   {{ id? 'Edit':"Create" }}  Address
                </h2>
            </div>
            <hr>
            <div>

            </div>
            <address-form :user_address="user_address_info"></address-form>
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
    data: () => ({
        id: null,
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
        this.id = new URL(window.location.href).searchParams.get('id')

        if (this.id) {
            await this.getSingleAddressInformation(this.id)
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
                this.user_address_info = response.data
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
