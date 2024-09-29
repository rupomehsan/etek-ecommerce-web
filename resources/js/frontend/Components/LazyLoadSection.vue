<template>
    <div ref="section" class="lazy-load-section">
        <slot v-if="isInView"></slot>
    </div>
</template>

<script>
import Skeleton from './Skeleton.vue';

export default {
    components: {
        Skeleton,
    },
    data() {
        return {
            isInView: false,
        };
    },
    mounted() {
        this.createObserver();
    },
    methods: {
        createObserver() {
            const options = {
                root: null,
                threshold: 0.1,
            };

            const observer = new IntersectionObserver(this.handleIntersect, options);
            observer.observe(this.$refs.section);
        },
        handleIntersect(entries, observer) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    this.isInView = true;
                    observer.unobserve(this.$refs.section);
                }
            });
        },
    },
};
</script>

<style scoped>
.lazy-load-section {
    min-height: 100vh;
}
</style>
