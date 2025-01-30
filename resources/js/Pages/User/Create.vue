<script setup>
import { useForm } from "@inertiajs/vue3";
import { Head } from "@inertiajs/vue3";

const form = useForm({
    name: null,
    email: null,
    password: null,
});
</script>

<template>
    <Head title="Create New User - Mangame" />
    <h1>Create User page</h1>
    <form @submit.prevent="form.post('/user')">
        <input
            type="text"
            name="name"
            placeholder="John Doe"
            v-model="form.name"
        />
        <div v-if="form.errors.name">{{ form.errors.name }}</div>
        <input
            type="email"
            name="email"
            placeholder="john.doe@email.com"
            v-model="form.email"
        />
        <div v-if="form.errors.email">{{ form.errors.email }}</div>
        <input
            type="password"
            name="password"
            placeholder="password"
            v-model="form.password"
        />
        <div v-if="form.errors.password">{{ form.errors.password }}</div>
        <button>Submit</button>
    </form>
</template>
