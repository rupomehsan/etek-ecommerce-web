<template>
    <div class="container">
        <div class="product_info_content mb-2" id="product_info_content">
            <div class="product_d_inner" v-html="`${get_setting_value('home_page_descrption')}`"></div>
        </div>
    </div>

</template>

<script>
import { common_store } from "../../../Store/common_store";
import { mapActions, mapState } from "pinia";
export default {
    created: function(){
        // console.log(this.website_settings_data)
    },
    methods: {
        ...mapActions(common_store, {
            get_setting_value: "get_setting_value",
        }),
    },
    computed: {
        ...mapState(common_store,[
            'website_settings_data'
        ]),
    }
}
</script>
