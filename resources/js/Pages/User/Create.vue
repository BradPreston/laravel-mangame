<script setup>
import { useForm } from "@inertiajs/vue3";
import { Head } from "@inertiajs/vue3";

const form = useForm({
    name: null,
    email: null,
    password: null,
});

function handleSubmit() {
    form.post("/user", {
        onSuccess: () => form.reset(),
    });
}
</script>

<template>
    <div class="prose container mx-auto">
        <Head title="Create New User - Mangame" />
        <h1 class="text-center">Create User page</h1>
        <form
            class="flex flex-col mx-auto max-w-xs"
            @submit.prevent="handleSubmit"
        >
            <label
                for="user[name]"
                :class="`mb-2 ${form.errors.name && 'text-red-500'}`"
            >
                Full Name*
            </label>
            <input
                :class="`input input-bordered w-full max-w-xs mb-4 ${
                    form.errors.name && 'border-red-500'
                }`"
                id="user[name]"
                type="text"
                name="name"
                placeholder="John Doe"
                v-model="form.name"
            />
            <label
                for="user[email]"
                :class="`mb-2 ${form.errors.email && 'text-red-500'}`"
            >
                Email*
            </label>
            <input
                :class="`input input-bordered w-full max-w-xs mb-4 ${
                    form.errors.email && 'border-red-500'
                }`"
                type="email"
                name="email"
                id="user[email]"
                placeholder="john.doe@email.com"
                v-model="form.email"
            />
            <label
                for="user[password]"
                :class="`mb-2 ${form.errors.password && 'text-red-500'}`"
            >
                Password*
            </label>
            <input
                :class="`input input-bordered w-full max-w-xs mb-4 ${
                    form.errors.password && 'border-red-500'
                }`"
                type="password"
                name="password"
                id="user[password]"
                placeholder="password"
                v-model="form.password"
            />
            <button class="btn btn-primary max-w-xs">Submit</button>
        </form>
    </div>
</template>
