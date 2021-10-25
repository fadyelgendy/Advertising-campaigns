<template>
    <div>
        <header>
            <h2>
                <font-awesome-icon icon="flag"></font-awesome-icon>
                advertising campaigns
            </h2>
            <ul>
                <li>
                    <button
                        v-if="
                            this.$route.name != 'login' &&
                                this.$route.name != 'register'
                        "
                        class="btn"
                        @click.prevent="handleLogout"
                    >
                        logout
                        <font-awesome-icon
                            icon="sign-out-alt"
                        ></font-awesome-icon>
                    </button>
                </li>
            </ul>
        </header>
    </div>
</template>

<script>
import { mapActions } from "vuex";
export default {
    name: "Header",
    methods: {
        ...mapActions(["logout"]),
        async handleLogout() {
            try {
                axios.post("/api/logout");
                this.logout();
                this.$router.push({ name: "login" });
            } catch (err) {
                console.log(err);
            }
        }
    }
};
</script>

<style scoped>
h2 {
    padding: 10px 20px;
}
button {
    background: none;
}
button:hover {
    opacity: 0.7;
}
</style>
