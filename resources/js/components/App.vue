<template>
    <div>
        <Header v-show="showLogin"/>
        <div class="container">
            <Login v-show="showLogin" />
        </div>
        <Footer />
    </div>
</template>

<script>
import Header from "./Header.vue";
import Footer from "./Footer.vue";
import Login from './Login.vue';

export default {
    name: "App",
    components: {
        Header,
        Footer,
        Login,
    },
    data () {
        return {
            showLogin: true,
        }
    }
}
</script>