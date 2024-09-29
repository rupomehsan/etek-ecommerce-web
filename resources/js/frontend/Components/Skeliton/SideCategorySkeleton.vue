<template>
    <div v-for="i in 12" :key="i">
        <skeleton :width="`100%`" :height="`50px`" :cs_class="`my-2`"></skeleton>
    </div>
</template>

<script>
import Skeleton from '../Skeleton.vue';
export default {
    components: { Skeleton }

}
</script>

<style></style>
