<script setup>
import { useForm } from "@inertiajs/vue3";
import { Head } from "@inertiajs/vue3";
import { ref } from "vue";

const form = useForm({
    email: null,
    password: null,
});

const totalErrors = ref(0);

function handleSubmit() {
    form.post("/login", {
        onError: () => {
            totalErrors.value = Object.keys(form.errors).length;
        },
        onSuccess: () => {
            form.reset();
            totalErrors.value = 0;
        },
    });
}
</script>

<template>
    <Head title="Login - Mangame" />
    <form class="flex flex-col mx-auto max-w-sm" @submit.prevent="handleSubmit">
        <p v-if="form.errors" class="text-red-500 mb-2">
            {{ form.errors.message }}
        </p>
        <label for="user[email]" class="mb-2"> Email* </label>
        <input
            class="input input-bordered w-full max-w-sm mb-4"
            id="user[email]"
            type="email"
            name="email"
            placeholder="john.doe@email.com"
            v-model="form.email"
            required
        />
        <label for="user[password]" class="mb-2"> Password* </label>
        <input
            class="input input-bordered w-full max-w-sm mb-4"
            id="user[password]"
            type="password"
            name="password"
            placeholder="Password"
            v-model="form.password"
            required
        />
        <button class="btn btn-primary">Login</button>
    </form>
</template>
