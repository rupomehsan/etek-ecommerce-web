<template>
    <div :class="[cs_class, 'cs-skeleton', { 'circle': isCircle }]"
        :style="{ width: `${width}`, height: `${height}` }">
        <div class="cover" :style="`height:${height}`"></div>
    </div>
</template>

<script>
export default {
    props: {
        width: {
            type: String,
            required: true
        },
        height: {
            type: String,
            required: true
        },
        cs_class: {
            type: String,
        },
        isCircle: {
            type: Boolean,
            default: false
        }
    }
}
</script>

<style>
.cs-skeleton {
    background-color: #fafafa !important;
    overflow: hidden;
    box-shadow: 0 8px 60px -8px hsl(210, 14%, 80%);
    /* border: 1px solid rgb(213, 218, 223); */
    /* padding: 14px; */
    border-radius: 0px;
}

.cover {
    border-radius: 0px;
    overflow: hidden;
}

.cs-skeleton.circle {
    border-radius: 50%;
}

/* sleleton elements */
.cover {
    background: linear-gradient(90deg,
            hsl(210, 15%, 88%),
            hsl(210, 15%, 95%),
            hsl(210, 15%, 88%));
    background-size: 200%;
    animation: loader 1s infinite reverse;
}


/* cs-skeleton animation */
@keyframes loader {
    from {
        background-position: -100% 0;
    }

    to {
        background-position: 100% 0;
    }
}
</style>
