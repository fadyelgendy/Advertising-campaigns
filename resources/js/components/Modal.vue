<template>
    <div class="modal">
        <img v-for="(src, index) in gallery" :key="index" :src="src" />
    </div>
</template>

<script>
export default {
    name: "Modal",
    props: {
        gallery: Array
    }
};
</script>

<style scoped>
.modal {
    display: flex;
    justify-content: space-evenly;
    align-content: center;
    align-items: center;
    position: fixed;
    top: 20%;
    left: 10%;
    height: 450px;
    width: 80vw;
    z-index: 1000;
    background: #fff;
    margin: auto;
    overflow: hidden;
}

img {
    display: block;
    height: 150px;
    max-height: 150px;
    width: 150px;
    max-width: 150px;
}
</style>
