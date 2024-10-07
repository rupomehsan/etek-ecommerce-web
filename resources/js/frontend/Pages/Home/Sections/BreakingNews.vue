<template>
    <section class="mt-2">
        <div class="marquee_body py-lg-2 bn" @mouseover="is_paused = true" @mouseleave="is_paused = false">
            <marquee-text :paused="is_paused" :duration="60">
                {{ get_setting_value('breaking_news') }}
            </marquee-text>
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
