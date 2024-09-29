<template>
    <div class="login-container">
        <a href="facebook/auth/redirect">
            <button class="btn-facebook">
                <i class="fa fa-facebook-f"></i> Login with Facebook
            </button>
        </a>
        <a href="google/auth/redirect">
            <button class="btn-google">
                <i class="fa fa-google"></i> Login with Google
            </button>
        </a>
    </div>
</template>

<script>
export default {

}
</script>

<style>
.login-container {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

button {
    width: 300px;
    padding: 15px;
    font-size: 16px;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    transition: background-color 0.3s ease;
}

button i {
    font-size: 20px;
}

/* Facebook Button */
.btn-facebook {
    background-color: #3b5998;
}

.btn-facebook:hover {
    background-color: #324b84;
}

/* Google Button */
.btn-google {
    background-color: #db4437;
}

.btn-google:hover {
    background-color: #c23321;
}
</style>
