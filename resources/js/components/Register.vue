<template>
    <div class="register__form">
        <Spinner v-show="processing" />
        <h2>Register new user</h2>
        <form action="#" @submit.prevent="handleRegister">
            <div class="form-group">
                <label for="">Name:</label>
                <input
                    type="text"
                    class="form-control"
                    name="username"
                    id="username"
                    v-model="user.name"
                />
                <div class="alert" v-if="errors.name">{{ errors.name }}</div>
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
                <div class="alert" v-if="errors.email">{{ errors.email }}</div>
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
                <div class="alert" v-if="errors.password">
                    {{ errors.password }}
                </div>
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
                <div class="alert" v-if="errors.password_confirmation">
                    {{ errors.password_confirmation }}
                </div>
            </div>

            <div class="btn-group">
                <button class="btn" type="submit">Register</button>
                <router-link to="/user/login" class="btn">Cancel</router-link>
            </div>
        </form>
    </div>
</template>

<script>
import { mapActions } from "vuex";
import Spinner from "./Sipnner.vue";
export default {
    name: "Register",
    data() {
        return {
            user: {
                name: "",
                email: "",
                password: "",
                password_confirmation: ""
            },
            errors: {
                name: "",
                email: "",
                password: "",
                password_confirmation: ""
            },
            processing: false
        };
    },
    methods: {
        ...mapActions(["login"]),
        async handleRegister() {
            if (this.user.name == "") {
                return (this.errors.name = "Name is required!");
            }
            this.errors.name = "";

            if (this.user.email == "") {
                return (this.errors.email = "Email is required!");
            }
            this.errors.email = "";

            if (this.user.password == "") {
                return (this.errors.password = "Password is required!");
            }
            this.errors.password = "";

            if (this.user.password_confirmation == "") {
                return (this.errors.password_confirmation =
                    "Password confirmation is required!");
            }
            this.errors.password_confirmation = "";

            if (this.user.password !== this.user.password_confirmation) {
                return (this.errors.password_confirmation =
                    "Password and Password confirmation doesn't match");
            }
            this.errors.password_confirmation = "";

            this.processing = true;
            try {
                const res = await axios
                    .post("/api/register", this.user)
                    .then(res => {
                        this.processing = false;
                        this.$router.push({ name: "login" });
                    })
                    .catch(res => {
                        this.processing = false;
                        alert("Error, your email might be already registered");
                    });
            } catch (err) {
                console.error(err);
                this.processing = false;
            }
        }
    },
    components: {
        Spinner
    }
};
</script>

<style scoped>
.register__form {
    background-color: #fff;
}

.register__form h2 {
    background: #ddd;
    width: 100%;
    text-align: center;
    padding: 10px;
}
</style>
