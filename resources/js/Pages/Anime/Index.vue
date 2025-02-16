<script setup>
import { Head, usePage } from "@inertiajs/vue3";
import Pagination from "../../Components/Navigation/Pagination.vue";
import { computed } from "vue";
import Container from "../../Components/Layout/Container.vue";
import TotalPerPage from "../../Components/Navigation/totalPerPage.vue";
const pageData = usePage();

const anime = computed(() => pageData.props.anime);
const limit = computed(() => pageData.props.limit);
const page = computed(() => pageData.props.page);
</script>

<template>
    <Head :title="`Anime${page > 1 ? ` - page ${page}` : ''}`" />
    <Container>
        <h1>All Anime</h1>
        <TotalPerPage />
        <ul class="list-none grid grid-cols-3 gap-4 p-0">
                <li v-for="a of anime.data">
                    <a :href="`/anime/${a.id}`">
                        <img
                            loading="lazy"
                            class="my-0"
                            :src="a.attributes.posterImage.small"
                        />
                        <h3 class="mt-0">{{ a.attributes.canonicalTitle }}</h3>
                    </a>
                </li>
            </ul>
            <Pagination :totalCount="anime.meta.count" :currentPage="page" :limit="limit" />
    </Container>
</template>
