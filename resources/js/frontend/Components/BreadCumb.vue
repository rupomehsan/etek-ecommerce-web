<template>
    <ul class="breadcrumb">
        <li>
            <a href="/"><i class="fa fa-home" title="Home"></i></a>
        </li>
        <li v-for="i in bread_cumb" :key="i.title">
            <a v-if="i.active" :href="`${i.url}`" @click.prevent="()=>''">
                <span>
                    {{ i.title }}
                </span>
            </a>
            <Link v-else :href="`${i.url}`">
                <span>
                    {{ i.title }}
                </span>
            </Link>
        </li>
    </ul>
</template>
<script>
export default {
    props: {
        bread_cumb: {
            required: true,
            type: Array,
            default: [],
        }
    }
}
</script>
<style lang="">

</style>
