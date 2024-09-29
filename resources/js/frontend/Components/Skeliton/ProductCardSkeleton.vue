<template>
    <div  style="width: 220px;display:inline-block;margin-right: 30px;">
        <div class="border my-2" >
            <skeleton :width="`240px`" :height="`250px`"></skeleton>
            <skeleton :width="`240px`" :height="`50px`" cs_class="my-1"></skeleton>
            <skeleton :width="`240px`" :height="`30px`"></skeleton>
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
