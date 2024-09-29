<template>
    <div class="download-buttons">
        <a href="https://play.google.com/store" target="_blank" class="store-button">
            <img src="https://upload.wikimedia.org/wikipedia/commons/7/78/Google_Play_Store_badge_EN.svg"
                alt="Google Play" />
        </a>
        <a href="https://www.apple.com/app-store/" target="_blank" class="store-button">
            <img src="https://developer.apple.com/assets/elements/badges/download-on-the-app-store.svg"
                alt="App Store" />
        </a>
        <!-- <a href="https://appgallery.huawei.com" target="_blank" class="store-button">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/3/31/Huawei_AppGallery_logo.svg/2560px-Huawei_AppGallery_logo.svg.png"
                alt="AppGallery" />
        </a> -->
    </div>

</template>

<script>
export default {

}
</script>

<style>
.download-buttons {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 10px;
    background-color: #123456;
    /* Replace with your preferred color */
    padding: 20px;
}

.store-button img {
    width: 180px;
    /* Adjust the width as needed */
    height: auto;
    border-radius: 8px;
    transition: transform 0.2s ease-in-out;
}

.store-button img:hover {
    transform: scale(1.05);
    /* Slight zoom on hover */
}
</style>
