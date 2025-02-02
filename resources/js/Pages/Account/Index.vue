<script setup>
import { Head, usePage } from "@inertiajs/vue3";
import { computed } from "vue";

const page = usePage();

const user = computed(() => page.props.auth.user);
</script>

<template>
    <Head title="Account - Mangame" />
    <ul class="list-none">
        <li class="capitalize">
            <strong>Name: </strong>{{ user.first_name }}
            {{ user.last_name }}
        </li>
        <li><strong>Email: </strong>{{ user.email }}</li>
    </ul>
</template>
