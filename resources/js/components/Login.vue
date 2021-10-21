<template>
    <div class="login__form">
        <h1>Login</h1>
        <form action="#" @submit.prevent="handleLogin">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" name="email" id="email" class="form-control">
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" class="form-control">
            </div>

            <div class="form-group">
                <input type="submit" value="Login" class="btn">
            </div>

        </form>
    </div>
</template>

<script>
export default {
    name: "Login",
}
</script>