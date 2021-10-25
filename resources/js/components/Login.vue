<template>
    <div class="login__form">
        <h1>Login</h1>
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
                <router-link to="/register" class="btn">Register</router-link>
            </div>
        </form>
    </div>
</template>

<script>
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
            }
        };
    },
    methods: {
        handleLogin() {
            // login
        }
    }
};
</script>
