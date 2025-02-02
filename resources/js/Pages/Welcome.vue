<script setup>
import { Head, usePage } from "@inertiajs/vue3";
import { computed } from "vue";

const page = usePage();

const user = computed(() => page.props.auth.user);
</script>

<template>
    <Head title="Welcome" />
    <h1 class="text-center">
        Welcome
        <span v-if="user" class="capitalize">
            {{ user.first_name }} {{ user.last_name }}</span
        >
    </h1>
</template>
