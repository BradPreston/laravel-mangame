<script setup>
defineProps({
'isLoggedIn': Boolean
});
</script>

<template>
    <h1>hello</h1>
    <p>Are you logged in?</p>
    <p>{{ isLoggedIn }}</p>
    <form action="/logout" method="GET" v-if="isLoggedIn">
        <button class="btn btn-primary">Log out</button>
    </form>
</template>
