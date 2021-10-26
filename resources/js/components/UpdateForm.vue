<template>
    <form>
        <Spinner v-show="processing" />
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

        <h4>Uploaded creatives</h4>
        <div class="campaign_gallery">
            <img
                v-for="(src, index) in compain.creative_upload"
                :key="index"
                :src="base + src"
                :alt="compain.name"
            />
        </div>

        <div class="btn-group">
            <button class="btn" @click.prevent="handleSubmit">Save</button>
            <router-link class="btn" to="/">Cancel</router-link>
        </div>
    </form>
</template>

<script>
const csrf = document
    .getElementsByName("csrf-token")[0]
    .getAttribute("content");

import vue2Dropzone from "vue2-dropzone";
import "vue2-dropzone/dist/vue2Dropzone.min.css";
import { mapActions } from "vuex";
import Spinner from "./Sipnner.vue";

export default {
    name: "UpdateForm",
    props: {
        compain: Object,
        errors: Object
    },
    components: {
        Spinner,
        vueDropzone: vue2Dropzone
    },
    data() {
        return {
            dropzoneOptions: {
                url: "http://compains.test/api/compain/upload",
                thumbnailWidth: 150,
                maxFilesize: 1000000,
                headers: {
                    Accept: "application/json",
                    "X-CSRF-TOKEN": csrf
                }
            },
            processing: false,
            base: "http://compains.test/storage/"
        };
    },
    methods: {
        ...mapActions(["updateCompain"]),
        async handleSubmit() {
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

            this.processing = true;
            // Update compain
            try {
                const res = await this.updateCompain(
                    this.compain,
                    this.compain.id
                );
                if (res.status == 200) {
                    if (res.data.errors) {
                        this.processing = false;
                        this.errors = { ...res.data.errors };
                        return;
                    }
                }

                this.$router.push("/");
            } catch (err) {
                console.error(err);
            }
        },
        handleUpload(file, res) {
            if (res.success) {
                this.compain.creative_upload.push(res.path);
            } else {
                console.log(res.message);
            }
        }
    },
    async created() {
        this.processing = true;
        try {
            const response = await axios.get(
                `/api/compain/${this.$route.params.id}`
            );
            console.log(response);
            if (response.status == 200) {
                this.compain = { ...response.data.compain };
                this.processing = false;
            }
        } catch (err) {
            this.processing = false;
        }
    }
};
</script>

<style scoped>
label {
    text-transform: capitalize;
}
.campaign_gallery {
    border: 1px solid #999;
    border-radius: 5px;
    padding: 10px;
    margin-top: 10px;
    display: flex;
    flex-direction: row;
    justify-content: space-evenly;
    align-items: center;
    margin: 5px 10px;
    flex-wrap: wrap;
}
img {
    height: 100px;
    width: 100px;
    display: block;
    margin: 10px;
}
h4,
h2 {
    text-align: center;
    text-transform: capitalize;
}
</style>
