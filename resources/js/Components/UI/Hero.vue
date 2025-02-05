<script setup>
defineProps({
    title: String,
    body: String,
    linkTitle: String,
    linkHref: String,
});
</script>

<template>
    <div
        class="hero min-h-96"
        style="
            background-image: url(https://img.daisyui.com/images/stock/photo-1507358522600-9f71e620c44e.webp);
        "
    >
        <div class="hero-overlay bg-opacity-60"></div>
        <div class="hero-content text-neutral-content text-center">
            <div class="max-w-md">
                <h1 class="mb-5 text-5xl font-bold">{{ title }}</h1>
                <p class="mb-5">
                    {{ body }}
                </p>
                <a :href="linkHref" class="btn btn-primary">{{ linkTitle }}</a>
            </div>
        </div>
    </div>
</template>
