<template>
    <div class="container">
        <Spinner v-show="display" />
        <div class="head">
            <h2>campaigns list:</h2>
            <div class="add_compain_btn">
                <router-link to="/compain/create">
                    add campaign
                    <font-awesome-icon icon="plus-square"></font-awesome-icon>
                </router-link>
            </div>
        </div>
        <table>
            <thead>
                <th>#</th>
                <th>name</th>
                <th>date from</th>
                <th>Date to</th>
                <th>Daily budget</th>
                <th>total budget</th>
                <th>Created at</th>
                <th>actions</th>
            </thead>

            <tbody>
                <tr v-for="(compain, index) in allCompains" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ compain.name }}</td>
                    <td>{{ compain.date_from }}</td>
                    <td>{{ compain.date_to }}</td>
                    <td>${{ compain.daily_budget }}</td>
                    <td>${{ compain.total_budget }}</td>
                    <td>{{ compain.created_at }}</td>
                    <td class="action_btns">
                        <button>
                            <font-awesome-icon icon="eye"></font-awesome-icon>
                        </button>
                        <router-link
                            :to="{
                                name: 'edit.compain',
                                params: { id: compain.id }
                            }"
                        >
                            <font-awesome-icon
                                icon="pencil-alt"
                            ></font-awesome-icon>
                        </router-link>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import Spinner from "./Sipnner.vue";

export default {
    name: "Compains",
    props: ["id"],
    data() {
        return {
            display: false
        };
    },
    components: {
        Spinner
    },
    methods: {
        ...mapActions(["fetchCompains"])
    },
    computed: {
        ...mapGetters(["allCompains"])
    },
    async created() {
        this.display = true;
        try {
            await this.fetchCompains();
            this.display = false;
        } catch (err) {
            this.display = false;
        }
    }
};
</script>

<style scoped>
h2 {
    padding: 10px;
}
table,
tr,
th {
    border: 1px solid #ddd;
    text-align: left;
}
th {
    background: #ddd;
}

tr:hover {
    background: #ddd;
    cursor: pointer;
}

table {
    border-collapse: collapse;
    width: 100%;
    margin: 10px 0;
    background: #fff;
}

th,
td {
    padding: 15px;
    text-transform: capitalize;
}

.action_btns {
    display: flex;
    justify-content: space-around;
    flex-direction: row;
    align-items: center;
    align-content: center;
}

.action_btns button {
    padding: 4.6px 10px;
    background: navy;
    color: #fff;
    border: none;
    font-size: 16px;
    margin: 0;
}

.action_btns a {
    padding: 3px 10px;
    background: #080;
    color: #fff;
    border: none;
    margin: 0;
    font-size: 16px;
}

.head {
    display: flex;
    justify-content: space-between;
    align-content: center;
    align-items: center;
    flex-direction: row;
}
.add_compain_btn a {
    margin: 5px;
    border: 1px solid #080;
    padding: 5px 10px;
    border-radius: 5px;
    display: block;
    background-color: #008800;
    color: #ddd;
    text-transform: capitalize;
}
</style>
