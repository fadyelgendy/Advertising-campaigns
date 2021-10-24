<template>
    <div class="container">
        <h1>Add Compain</h1>
        <form enctype="multipart/form-data">
            <div class="form-group">
                <label for="">name</label>
                <input
                    type="text"
                    name="name"
                    id="name"
                    v-model="compain.name"
                    class="form-control"
                />
            </div>

            <div class="form-group">
                <label for="">date from</label>
                <input
                    type="date"
                    name="date_from"
                    id="date_from"
                    v-model="compain.date_from"
                    class="form-control"
                />
            </div>

            <div class="form-group">
                <label for="">date to</label>
                <input
                    type="date"
                    name="date_to"
                    id="date_to"
                    v-model="compain.date_to"
                    class="form-control"
                />
            </div>

            <div class="form-group">
                <label for="">daily budget</label>
                <input
                    type="number"
                    name="daily_budget"
                    id="daily_budget"
                    v-model="compain.daily_budget"
                    class="form-control"
                />
            </div>

            <div class="form-group">
                <label for="">creative upload</label>
                <input
                    type="file"
                    name="creative_upload[]"
                    id="creative_upload"
                    multiple
                    class="form-control"
                />
            </div>

            <div class="btn-group">
                <button class="btn" @click.prevent="">Save</button>
                <router-link class="btn" to="/compains">Cancel</router-link>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    name: "AddCompain",
    data() {
        return {
            compain: {
                user_id: Math.floor(Math.random() * 10),
                name: "",
                date_from: "",
                date_to: "",
                daily_budget: "",
                creative_upload: []
            },
            errors: {}
        };
    }
};
</script>

<style scoped>
.container {
    width: 50%;
    max-width: 50%;
    background: #fff;
    padding: 10px;
    margin: 10px auto;
}
</style>
