<template>
    <div class="d-flex justify-content-center align-items-center redirect-container">
        <h1 class="redirect-text">Redirecting...</h1>
    </div>
</template>

<script>
export default {
    props: {
        token: String,
        user: Object,
    },
    created() {
        localStorage.setItem("token", this.token);
        window.location.href = "/";
    }
};
</script>


<style scoped>
.redirect-container {
    height: 100vh;
}

.redirect-text {
    font-size: 2rem;
    animation: fadeInOut 3s ease-in-out infinite;
}

@keyframes fadeInOut {
    0% {
        opacity: 0;
        transform: scale(1);
    }

    50% {
        opacity: 1;
        transform: scale(1.2);
    }

    100% {
        opacity: 0;
        transform: scale(1);
    }
}
</style>
