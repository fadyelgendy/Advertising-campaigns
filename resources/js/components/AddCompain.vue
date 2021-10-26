<template>
    <div class="container">
        <div class="head">
            <BackBtn />
            <h2>create new campaign</h2>
        </div>
        <CreateForm v-bind:errors="errors" v-bind:compain="compain" />
    </div>
</template>

<script>
import BackBtn from "./BackBtn.vue";
import CreateForm from "./CreateForm.vue";

export default {
    name: "AddCompain",
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
                daily_budget: 1.0,
                creative_upload: []
            },
            errors: {
                name: "",
                date_from: "",
                date_to: "",
                daily_budget: ""
            },
            processing: false
        };
    },
    components: {
        BackBtn,
        CreateForm
    }
};
</script>

<style scoped>
.container {
    width: 50%;
    max-width: 50%;
    background: #fff;
    /* padding: 10px; */
    margin: 10px auto;
}

label {
    text-transform: capitalize;
}

.head {
    background: #ddd;
}
h2 {
    text-transform: capitalize;
    text-align: center;
}
</style>
