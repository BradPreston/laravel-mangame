<script setup>
import { useForm } from "@inertiajs/vue3";
import { Head } from "@inertiajs/vue3";
import { ref } from "vue";

const form = useForm({
    first_name: null,
    last_name: null,
    email: null,
    password: null,
});

const totalErrors = ref(0);

function handleSubmit() {
    form.post("/account/register", {
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
    <div class="prose container mx-auto">
        <Head title="Create New User - Mangame" />
        <h1 class="text-center">Create User page</h1>
        <form
            class="flex flex-col mx-auto max-w-sm"
            @submit.prevent="handleSubmit"
        >
            <label
                for="user[first_name]"
                :class="`mb-2 ${form.errors.first_name && 'text-red-500'}`"
            >
                First Name*
            </label>
            <input
                :class="`input input-bordered w-full max-w-sm mb-4 ${
                    form.errors.first_name && 'border-red-500'
                }`"
                id="user[first_name]"
                type="text"
                name="first_name"
                placeholder="John"
                v-model="form.first_name"
                required
            />
            <label
                for="user[last_name]"
                :class="`mb-2 ${form.errors.last_name && 'text-red-500'}`"
            >
                Last Name*
            </label>
            <input
                :class="`input input-bordered w-full max-w-sm mb-4 ${
                    form.errors.last_name && 'border-red-500'
                }`"
                id="user[last_name]"
                type="text"
                name="last_name"
                placeholder="Doe"
                v-model="form.last_name"
                required
            />
            <label
                for="user[email]"
                :class="`mb-2 ${form.errors.email && 'text-red-500'}`"
            >
                Email*
            </label>
            <input
                :class="`input input-bordered w-full max-w-sm mb-4 ${
                    form.errors.email && 'border-red-500'
                }`"
                type="email"
                name="email"
                id="user[email]"
                placeholder="john.doe@email.com"
                v-model="form.email"
                required
            />
            <p class="-mt-2 text-red-500" v-if="form.errors.email">
                {{ form.errors.email }}
            </p>
            <label
                for="user[password]"
                :class="`mb-2 ${form.errors.password && 'text-red-500'}`"
            >
                Password*
            </label>

            <input
                :class="`input input-bordered w-full max-w-sm mb-2 ${
                    form.errors.password && 'border-red-500'
                }`"
                type="password"
                name="password"
                id="user[password]"
                placeholder="password"
                v-model="form.password"
                pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                title="Password must contain at least one number, one uppercase letter, one lowercase letter, and at least 8 characters"
                required
            />
            <small class="mb-4"
                >Password must contain at least one number, one uppercase
                letter, one lowercase letter, and at least 8 characters</small
            >
            <button class="btn btn-primary max-w-sm">Submit</button>
        </form>
        <div
            role="alert"
            class="alert alert-error mt-4 max-w-sm mx-auto"
            v-if="totalErrors"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-6 w-6 shrink-0 stroke-current"
                fill="none"
                viewBox="0 0 24 24"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"
                />
            </svg>
            <span>Make sure all required fields are field out</span>
        </div>
    </div>
</template>
