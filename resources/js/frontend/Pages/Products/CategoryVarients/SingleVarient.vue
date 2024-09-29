<template>

    <div class="mb-3 bg-white card filter_card">
        <div @click.prevent="toggle_list" class="card-header bg-white d-flex justify-content-between">
            <b>
                {{ varient.varient_details.title }}
            </b>
            <b>
                <i class="fa filter_toggler fa-angle-down"></i>
            </b>
        </div>
        <div class="p-2 pt-0" ref="items" style="display: none;">
            <div class="collection-collapse-block open">
                <div class="collection-collapse-block-content">
                    <div class="collection-brand-filter">
                        <div v-for="(value, index) in varient.values" :key="index"
                            class="custom-control custom-checkbox form-check collection-filter-checkbox">
                            <input type="checkbox" class="custom-control-input form-check-input mt-0"
                                :id="`varient` + value.varient_value_details?.id"
                                @change="set_varient_value_id(value.varient_value_details?.id)">
                            <label class="custom-control-label form-check-label"
                                :for="`varient` + value.varient_value_details?.id">
                                {{ value.varient_value_details?.title }}
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { mapActions } from 'pinia';
import { product_store } from '../Store/product_store';

export default {
    props: ['varient'],
    data: () => ({
    }),
    created: function () {
    },
    methods: {
        ...mapActions(product_store, {
            set_varient_value_id: "set_varient_value_id",
        }),
        toggle_list: function () {
            $(this.$refs.items).slideToggle();
        }
    },

}
</script>
<style lang="">

</style>
