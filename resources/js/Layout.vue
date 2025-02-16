<script setup>
import { usePage } from "@inertiajs/vue3";
import { computed } from "vue";
import Header from "./Components/UI/Header.vue";

const page = usePage();

const user = computed(() => page.props.auth.user);

const navLinks = [
    {
        href: "/",
        name: "Home",
    },
    {
        href: '/anime',
        name: "Anime"
    }
];

const loggedInUserLinks = [
    {
        href: "/account",
        name: "Account",
    },
    {
        href: "/logout",
        name: "Logout",
    },
];

const loggedOutUserLinks = [
    {
        href: "/account/login",
        name: "Login",
    },
    {
        href: "/account/register",
        name: "Register",
    },
];
</script>

<template>
    <main>
        <div v-if="user">
            <Header :navLinks="navLinks" :userLinks="loggedInUserLinks" />
        </div>
        <div v-else>
            <Header :navLinks="navLinks" :userLinks="loggedOutUserLinks" />
        </div>
        <slot />
    </main>
</template>
