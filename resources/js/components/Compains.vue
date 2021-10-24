<template>
    <div class="container">
        <h2>Compains</h2>
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
                    <td>{{ compain.daily_budget }}</td>
                    <td>{{ compain.total_budget }}</td>
                    <td>{{ compain.created_at }}</td>
                    <td>
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

export default {
    name: "Compains",
    props: ["id"],
    methods: {
        ...mapActions(["fetchCompains"])
    },
    computed: mapGetters(["allCompains"]),
    created() {
        this.fetchCompains();
    }
};
</script>

<style scoped>
h2 {
    padding: 10px;
}
table,
td,
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
</style>
