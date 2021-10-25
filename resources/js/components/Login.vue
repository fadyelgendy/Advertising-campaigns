<template>
    <div class="login__form">
        <Spinner v-show="processing" />
        <h2>login</h2>
        <form action="#" @submit.prevent="handleLogin">
            <div class="form-group">
                <label for="email">Email:</label>
                <input
                    type="text"
                    name="email"
                    id="email"
                    class="form-control"
                    v-model="user.email"
                />
                <div class="alert" v-if="errors.email">{{ errors.email }}</div>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input
                    type="password"
                    name="password"
                    id="password"
                    class="form-control"
                    v-model="user.password"
                />
                <div class="alert" v-if="errors.password">
                    {{ errors.password }}
                </div>
            </div>

            <div class="btn-group">
                <button class="btn" type="submit">Login</button>
                <router-link to="/user/register" class="btn"
                    >Register</router-link
                >
            </div>
        </form>
    </div>
</template>

<script>
import { mapActions } from "vuex";
import Spinner from "./Sipnner.vue";

export default {
    name: "Login",
    data() {
        return {
            user: {
                email: "",
                password: ""
            },
            errors: {
                email: "",
                password: ""
            },
            processing: false
        };
    },
    methods: {
        ...mapActions(["login"]),
        async handleLogin() {
            if (this.user.email == "") {
                return (this.errors.email = "Email field is required!");
            }

            if (this.user.password == "") {
                return (this.errors.password = "Password field is required!");
            }

            this.processing = true;
            try {
                await axios.get("sanctum/csrf-cookie");
                await this.login(this.user);
                this.processing = false;
            } catch (err) {
                console.error(err);
            }
        }
    },
    components: {
        Spinner
    }
};
</script>

<style scoped>
.login__form {
    background: #fff;
}

.login__form h2 {
    background: #ddd;
    width: 100%;
    margin: 0px;
    padding: 10px;
    text-align: center;
    text-transform: capitalize;
}
</style>
