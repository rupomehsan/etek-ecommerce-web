<template>
    <div class="row">
        <div class="col-md-9">
            <skeleton :width="`100%`" :height="`500px`" :cs_class="`my-2`"></skeleton>
            <div class="row">
                <div class="col-md-6">
                    <skeleton :width="`100%`" :height="`200px`" :cs_class="`my-2`"></skeleton>
                </div>
                <div class="col-md-6">
                    <skeleton :width="`100%`" :height="`200px`" :cs_class="`mt-2`"></skeleton>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <skeleton :width="`100%`" :height="`500px`" :cs_class="`my-2`"></skeleton>
            <skeleton :width="`100%`" :height="`200px`" :cs_class="`mt-3`"></skeleton>
        </div>
    </div>
</template>

<script>
import Skeleton from '../Skeleton.vue';
export default {
    components: { Skeleton }

}
</script>

<style></style>
