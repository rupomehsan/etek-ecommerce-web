<template lang="">
    <div class="theme-form">
        <div class="row check-out mt-2 ">
            <div class="checkout-title text-center">
                <h3>Personal Info</h3>
                <hr>
            </div>
            <div class="form-group col-12">
                <input type="hidden" name="user_slug" :value="auth_info?.slug" />
                <input type="hidden" name="address_id"
                    :value="auth_info?.user_delivery_address?.id" id="">
                <label>Name</label>
                <input type="text" name="user_name" id="user_name" :value="auth_info?.name">
            </div>

            <div class="form-group col-12">
                <label class="field-label">Phone</label>
                <input type="text" name="phone" id="phone" :value="auth_info?.phone_number">
            </div>
            <div class="form-group col-12">
                <label class="field-label">Email Address</label>
                <input type="text" name="email" id="email" :value="auth_info?.email">
            </div>

        </div>
    </div>
</template>
<script>
import { auth_store } from '../../../Store/auth_store';
import { mapState } from 'pinia';
export default {
    computed: {
        ...mapState(auth_store, [
            'auth_info',
        ])
    }
}
</script>
<style lang="">

</style>
