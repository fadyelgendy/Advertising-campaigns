<template>
    <div class="back_btn">
        <router-link to="/">
            <font-awesome-icon icon="arrow-left"></font-awesome-icon>
            back to campaigns list
        </router-link>
    </div>
</template>

<script>
export default {
    name: "BackBtn"
};
</script>

<style scoped>
.back_btn {
    display: flex;
    align-content: flex-end;
    justify-content: end;
}
.back_btn a {
    margin: 5px;
    /* border: 1px solid rgb(202, 206, 202); */
    padding: 5px 10px;
    border-radius: 5px;
    display: block;
    /* background-color: rgb(202, 206, 202); */
    color: rgb(14, 13, 13);
    text-transform: capitalize;
}

.back_btn a:hover {
    background-color: #999;
}
</style>
