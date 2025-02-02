<script setup>
defineProps({
'isLoggedIn': Boolean
});
</script>

<template>
    <h1>hello</h1>
    <p>Are you logged in?</p>
    <p>{{ isLoggedIn }}</p>
</template>
