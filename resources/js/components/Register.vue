<template>
    <div class="register__form">
        <h2>Register new user</h2>
        <form action="#" @submit.prevent="createUser">
            <div class="form-group">
                <label for="">Username:</label>
                <input
                    type="text"
                    class="form-control"
                    name="username"
                    id="username"
                    v-model="user.username"
                />
            </div>

            <div class="form-group">
                <label for="">Email:</label>
                <input
                    type="email"
                    class="form-control"
                    name="email"
                    id="email"
                    v-model="user.email"
                />
            </div>

            <div class="form-group">
                <label for="">Password:</label>
                <input
                    type="password"
                    class="form-control"
                    name="password"
                    id="passwrod"
                    v-model="user.password"
                />
            </div>

            <div class="form-group">
                <label for="">Confrim Password:</label>
                <input
                    type="password"
                    class="form-control"
                    name="password_confirmation"
                    id="password_confirmation"
                    v-model="user.password_confirmation"
                />
            </div>

            <div class="btn-group">
                <button class="btn" type="submit">Register</button>
                <router-link to="/login" class="btn">Cancel</router-link>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    name: "Register",
    data() {
        return {
            user: {
                username: ""
            }
        };
    },
    methods: {
        createUser() {}
    }
};
</script>
