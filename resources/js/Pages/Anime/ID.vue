<script setup>
import { Head, usePage } from "@inertiajs/vue3";
import { computed } from "vue";
import Container from "../../Components/Layout/Container.vue";
import Hero from "../../Components/UI/Hero.vue";

const page = usePage();

const anime = computed(() => page.props.anime);
const details = anime.value.data.attributes;
const rating = Number(details.averageRating) / 20;
const fullStars = Math.floor(rating);
const halfStar = rating % 1 > 0.5;
const noStars = halfStar ? 4 - fullStars : 5 - fullStars;
console.log(details);
console.log(rating);
</script>

<template>
    <Head title="Anime" />
    <Hero
        :title="details.canonicalTitle"
        :background="details.coverImage?.large"
    />
    <Container>
        <div class="flex gap-10 mt-10">
            <div class="w-2/3 min-h-[10000px]">
                <section>
                    <h2 class="mt-0">Description</h2>
                    <p>{{ details.description }}</p>
                </section>
            </div>
            <aside class="w-1/3 capitalize sticky top-0 h-fit">
                <p>
                    <strong>Show Rating</strong>:
                    <i
                        class="fa-solid fa-star text-primary"
                        v-for="_ of fullStars"
                    ></i>
                    <i
                        class="fa-solid fa-star-half-stroke text-primary"
                        v-if="halfStar"
                    ></i>
                    <i
                        class="fa-regular fa-star text-primary"
                        v-for="_ of noStars"
                    ></i>

                    <span class="ml-1">({{rating.toFixed(2)}})</span>
                </p>
                <p><strong>Age Rating</strong>: {{ details.ageRating }}</p>
                <p><strong>Rating Guide</strong>: {{ details.ageRatingGuide }}</p>
                <p>
                    <strong>Adult Content</strong>:
                    {{ details.nsfw ? "Yes" : "No" }}
                </p>
                <p><strong>Type</strong>: {{ details.subtype }}</p>
                <p v-if="details.subtype === 'movie'">
                    <strong>Run time</strong>:
                    {{ details.episodeLength }} minutes
                </p>
                <p v-if="details.subtype !== 'movie'">
                    <strong>Episode Count</strong>: {{ details.episodeCount }}
                </p>
                <p>
                    <strong>First Aired</strong>:
                    {{ new Date(details.startDate).toLocaleDateString() }}
                </p>
            </aside>
        </div>
    </Container>
</template>
