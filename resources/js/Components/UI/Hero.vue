<script setup>
import { reactive } from "vue";

const props = defineProps({
    title: String,
    body: String | null,
    linkTitle: String | null,
    linkHref: String | null,
    background: String,
});

const styledObject = reactive({
    backgroundImage: `url(${props.background})`,
});
</script>

<template>
    <div class="hero min-h-96 max-w-[1600px] mx-auto" :style="styledObject">
        <div class="hero-overlay bg-opacity-80"></div>
        <div class="hero-content text-neutral-content text-center">
            <div class="px-10">
                <h1 class="mb-5 text-5xl font-bold drop-shadow">
                    {{ title }}
                </h1>
                <p v-if="body" class="mb-5">
                    {{ body }}
                </p>
                <a v-if="linkTitle" :href="linkHref" class="btn btn-primary">{{
                    linkTitle
                }}</a>
            </div>
        </div>
    </div>
</template>
