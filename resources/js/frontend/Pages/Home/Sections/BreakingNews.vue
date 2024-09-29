<template>
    <section class="   mt-5">
        <div class="custom-container">
            <div class="marquee_body py-3" @mouseover="is_paused = true" @mouseleave="is_paused = false">
                <marquee-text :paused="is_paused" :duration="60">
                    {{ get_setting_value('breaking_news') }}
                </marquee-text>
            </div>
        </div>
    </section>
</template>

<script>
import MarqueeText from 'vue-marquee-text-component'
import { common_store } from "../../../Store/common_store";
import { mapActions, mapState } from "pinia";
export default {
    components: {
        MarqueeText
    },
    data: () => ({
        is_paused: false,
    }),
    methods: {
        ...mapActions(common_store, {
            get_setting_value: "get_setting_value",
        }),
    },
}
</script>

<style></style>
