<template>
    <div class="container">
        <div class="head">
            <h2>create new campaign</h2>
            <div class="back_btn">
                <router-link to="/compains">
                    <font-awesome-icon icon="arrow-left"></font-awesome-icon>
                    back to campaigns list
                </router-link>
            </div>
        </div>
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
                <div class="alert" v-if="errors.name">
                    {{ errors.name }}
                </div>
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

                <div class="alert" v-if="errors.date_from">
                    {{ errors.date_from }}
                </div>
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
                <div class="alert" v-if="errors.date_to">
                    {{ errors.date_to }}
                </div>
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
                <div class="alert" v-if="errors.daily_budget">
                    {{ errors.daily_budget }}
                </div>
            </div>

            <div class="form-group">
                <label for="">creative upload</label>
                <vue-dropzone
                    @vdropzone-success="handleUpload"
                    ref="myVueDropzone"
                    id="dropzone"
                    :options="dropzoneOptions"
                ></vue-dropzone>
            </div>

            <div class="btn-group">
                <button class="btn" @click.prevent="handleSubmit">Save</button>
                <router-link class="btn" to="/compains">Cancel</router-link>
            </div>
        </form>
    </div>
</template>

<script>
const csrf = document
    .getElementsByName("csrf-token")[0]
    .getAttribute("content");

import vue2Dropzone from "vue2-dropzone";
import "vue2-dropzone/dist/vue2Dropzone.min.css";
import { mapActions } from "vuex";

export default {
    name: "AddCompain",
    props: {
        user_id: Number,
        name: String,
        date_from: String,
        date_to: String,
        daily_budget: String,
        creative_upload: Array
    },
    data() {
        return {
            compain: {
                //TODO: change this to auth user in backend
                user_id: 1,
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
            dropzoneOptions: {
                url: "http://compains.test/api/compain/upload",
                thumbnailWidth: 150,
                maxFilesize: 1000000,
                headers: {
                    Accept: "application/json",
                    "X-CSRF-TOKEN": csrf
                }
            }
        };
    },
    components: {
        vueDropzone: vue2Dropzone
    },
    methods: {
        ...mapActions(["addCompain"]),
        handleSubmit() {
            // check for errors
            if (this.compain.name == "") {
                return (this.errors.name = "Name field is required!");
            }
            // clear after validate
            this.errors.name = "";

            if (this.compain.date_from == "") {
                return (this.errors.date_from = "Date from field is required!");
            }
            this.errors.date_from = "";

            if (this.compain.date_to == "") {
                return (this.errors.date_to = "Date to field is required!");
            }
            this.errors.date_to = "";

            if (this.compain.daily_budget == "") {
                return (this.errors.daily_budget =
                    "Daily budget to field is required!");
            }
            this.errors.daily_budget = "";

            if (this.compain.daily_budget <= 0) {
                return (this.errors.daily_budget =
                    "Daily budget must be more than $1.00");
            }
            this.errors.daily_budget = "";

            // Store compain
            this.addCompain(this.compain);
            this.$router.push("/compains");
        },
        handleUpload(file, res) {
            if (res.success) {
                this.compain.creative_upload.push(res.path);
            } else {
                console.log(res.message);
            }
        }
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

label {
    text-transform: capitalize;
}

.head {
    display: flex;
    justify-content: space-between;
    align-content: center;
    align-items: center;
    flex-direction: row;
}
h2 {
    flex: 10;
}
.back_btn a {
    margin: 5px;
    border: 1px solid rgb(202, 206, 202);
    padding: 5px 10px;
    border-radius: 5px;
    display: block;
    background-color: rgb(202, 206, 202);
    color: rgb(14, 13, 13);
    text-transform: capitalize;
}
</style>
