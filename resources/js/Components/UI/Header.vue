<script setup>
import { Link } from "@inertiajs/vue3";
import SearchBar from "./SearchBar.vue";
defineProps(["navLinks", "userLinks"]);
</script>

<template>
    <div class="navbar bg-base-100 container mx-auto">
        <div class="navbar-start">
            <div class="dropdown">
                <div tabindex="0" role="button" class="btn btn-ghost lg:hidden">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 6h16M4 12h8m-8 6h16"
                        />
                    </svg>
                </div>
                <ul
                    tabindex="0"
                    class="menu menu-sm dropdown-content bg-base-100 rounded-box z-[1] mt-3 w-52 p-2 shadow"
                >
                    <li v-for="link of navLinks" :key="link.href">
                        <a :href="link.href">{{ link.name }}</a>
                    </li>
                </ul>
            </div>
            <a class="btn btn-ghost text-xl">Manganime</a>
        </div>
        <div class="navbar-center hidden lg:flex">
            <ul class="menu menu-horizontal px-1">
                <li v-for="link of navLinks" :key="link.href">
                    <a :href="link.href">{{ link.name }}</a>
                </li>
            </ul>
        </div>
        <div class="navbar-end">
            <SearchBar />
            <ul class="menu menu-horizontal px-1 gap-2">
                <li v-for="link of userLinks" :key="link.href">
                    <a :href="link.href" class="btn">{{ link.name }}</a>
                </li>
            </ul>
        </div>
    </div>
</template>
