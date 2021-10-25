<template>
    <div class="spinner">
        <font-awesome-icon icon="spinner"></font-awesome-icon>
        <span>Loading...</span>
    </div>
</template>

<script>
export default {
    name: "Spinner"
};
</script>

<style scoped>
.spinner {
    width: 100%;
    height: 100%;
    background: #000;
    opacity: 0.7;
    position: absolute;
    top: 0;
    left: 0;
    z-index: 999;
    display: flex;
    align-content: center;
    align-items: center;
    justify-content: center;
}
.spinner svg,
span {
    color: #fff;
    position: relative;
    font-size: 26px;
    z-index: 1000;
    margin-right: 10px;
}
</style>
