<template>
    <section class="subscribe1  bg-size"
        style="background-image: url('https://files.etek.com.bd/cache/uploads/banner/subscribe2.png'); background-size: cover; background-position: center center; display: block;">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="subscribe-contain">
                        <div class="subscribe-left">
                            <div class="media">
                                <svg enable-background="new 0 0 512 512" viewBox="0 0 512 512"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g>
                                        <path d="m0
                                    197.61v297.8l173.2-154.29z"></path>
                                        <path d="m26.47 512h466.2l-236.65-203.21c-61.813
                                    53.36-16.636 13.542-229.55 203.21z"></path>
                                        <path d="m66.4 144.81-48.28 28.85 48.28
                                    40.01z"></path>
                                        <path d="m195.95 321.02c28.701-24.77 26.492-22.863
                                    57.32-49.47h5.43c41.981 36.045 29.32 25.174 57.52 49.39 71.602-58.557
                                    14.234-11.633 99.38-81.27 0-9.221 0-228.158 0-239.67h-319.2v238.53c60.491
                                    50.123 60.988 50.541 99.55
                                    82.49zm-36.35-115.02v-30h192.8v30zm0-158h192.8v30h-192.8zm0
                                    64h192.8v30h-192.8c0-7.219 0-23.148 0-30z"></path>
                                        <path d="m445.6
                                    144.82v70.32l49.69-40.63z"></path>
                                        <path d="m339.33 340.78 172.67
                                    148.28v-289.46z"></path>
                                    </g>
                                </svg>
                                <div class="media-body">
                                    <h6>Sale Up To 20% Off
                                        For
                                    </h6>
                                    <h3>join our newsletter</h3>
                                </div>
                            </div>
                        </div>
                        <div class="subscribe-right">
                            <form @submit.prevent="submitHandler">
                                <div class="input-group">
                                    <input class="form-control" id="name" name="email" type="text"
                                        placeholder="Enter Your Email" required>
                                    <button type="submit" class="input-group-text">subscribe</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import { mapActions } from 'pinia'
import { use_home_page_store } from "../Store/home_page_store"
export default {

    methods: {
        ...mapActions(use_home_page_store, {
            store_news_letter_subscriber: 'store_news_letter_subscriber'
        }),
        submitHandler() {
            let formData = event.target
            this.store_news_letter_subscriber(formData)
            event.target.reset()
        },

    }
}
</script>
