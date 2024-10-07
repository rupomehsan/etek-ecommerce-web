<template lang="">
    <nav class="app_container nav_list">
        <ul>
            <li>
                <a @click.prevent="toggle_category()" href="/products">
                    <i class="icon icon-list"></i>
                    <span>categories</span>
                </a>
            </li>
            <li>
                <Link v-if="is_auth" href="/profile/wish-list">
                    <i class="icon icon-bolt"></i>
                    <span>Wish List</span>
                </Link>
                <a v-else href="#/login" onclick="openAccount()">
                    <i class="icon icon-user"></i>
                    <span>account</span>
                </a>
            </li>
            <li>
                <div class="logo">
                    <Link href="/">
                        <div class="logo_image">
                            <img class="" alt="etek bd" src="/frontend/images/etek_logo.png" />
                        </div>
                        <div class="shape_1"></div>
                        <div class="shape_2"></div>
                        <div class="shape_3"></div>
                    </Link>
                </div>
            </li>
            <li>
                <a href="#" onclick="openCart()">
                    <i class="icon icon-shopping-cart"></i>
                    <span>
                        cart
                        <b>
                            ( {{ carts.length }} )
                        </b>
                    </span>
                </a>
            </li>
            <li>
                <Link v-if="is_auth" href="/profile">
                    <i class="icon icon-user"></i>
                    <span>account</span>
                </Link>
                <a v-else href="#/login" onclick="openAccount()">
                    <i class="icon icon-user"></i>
                    <span>account</span>
                </a>
            </li>
        </ul>
    </nav>

</template>
<script>
import { cart_store } from '../../Store/cart_store';
import { auth_store } from '../../Store/auth_store';
import { mapState } from 'pinia';
export default {
    methods: {
        toggle_category: function () {
            document.querySelector('.modal_category_all_page').classList.toggle('active');
        },
    },
    computed: {
        ...mapState(auth_store, [
            "is_auth"
        ]),
        ...mapState(cart_store, [
            "carts"
        ]),
    }
}
</script>
<style lang="">

</style>
