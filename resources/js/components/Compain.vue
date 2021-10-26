<template>
    <div class="container">
        <div class="head">
            <BackBtn />
            <h2>edit campaign</h2>
        </div>
        <UpdateForm v-bind:errors="errors" v-bind:compain="compain" />
    </div>
</template>

<script>
import BackBtn from "./BackBtn.vue";
import UpdateForm from "./UpdateForm.vue";

export default {
    name: "EditCompain",
    props: {
        name: String,
        date_from: String,
        date_to: String,
        daily_budget: String,
        creative_upload: Array
    },
    data() {
        return {
            compain: {
                name: "",
                date_from: "",
                date_to: "",
                daily_budget: "",
                creative_upload: []
            },
            errors: {
                name: "",
                date_from: "",
                date_to: "",
                daily_budget: ""
            }
        };
    },
    components: {
        BackBtn,
        UpdateForm
    }
};
</script>

<style scoped>
.container {
    width: 50%;
    max-width: 50%;
    background: #fff;
    margin: 10px auto;
}

h4,
h2 {
    text-align: center;
    text-transform: capitalize;
}

.head {
    background: #ddd;
}
</style>
