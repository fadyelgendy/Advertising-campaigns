<template>
    <div>
        <footer>
            <p>Copyright &copy; 2021.</p>
        </footer>
    </div>
</template>

<script lang="ts">
export default {
    name: "Footer"
};
</script>

<style scoped>
footer {
    background-color: var(--baseColor);
    width: 100%;
    padding: 5px 10px;
    position: relative;
    bottom: 0;
    left: 0;
    text-align: center;
    color: #fff;
}
</style>
