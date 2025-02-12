<script setup>
import { useForm } from "@inertiajs/vue3";
import { debounce } from "../../utils/debounce";
import { useTemplateRef, onMounted, ref } from "vue";
import axios from "axios";

const input = useTemplateRef("searchInput");

const form = useForm({
    search: null,
});

const quickSearchResults = ref(null);

onMounted(() => {
    function fetchQuickSearchResults(e) {
        const query = encodeURIComponent(e.target.value);
        if (!query) {
            quickSearchResults.value = null;
            form.reset();
            return;
        }
        axios
            .get(
                `https://kitsu.io/api/edge/anime?page[limit]=5&filter[text]=${query}`
            )
            .then(({ data: results }) => {
                console.log(results.data);
                quickSearchResults.value = results.data;
            })
            .catch((err) => console.error(err));
    }

    input.value.addEventListener("input", debounce(fetchQuickSearchResults));
});

function handleSearch(e) {
    const formData = new FormData(e.target);
    for (const [key, value] of formData.entries()) {
        console.log(key, value);
    }
}

function closeQuickResults() {
    quickSearchResults.value = null;
    form.reset();
}
</script>
<template>
    <div class="min-w-96 relative">
        <form @submit.prevent="handleSearch" class="w-full">
            <label class="input input-bordered flex items-center gap-2">
                <input
                    ref="searchInput"
                    type="text"
                    class="grow"
                    placeholder="Search"
                    name="search"
                    v-model="form.search"
                />
                <i
                    v-if="form.search"
                    class="fa-solid fa-xmark fill-current opacity-70"
                    @click.prevent="closeQuickResults"
                ></i>
            </label>
        </form>
        <div class="w-full absolute bg-white px-4" v-if="quickSearchResults">
            <button @click.prevent="closeQuickResults">close</button>
            <article v-for="result of quickSearchResults" class="py-4">
                <p>{{ result.attributes.canonicalTitle }}</p>
            </article>
        </div>
    </div>
</template>
