<script setup>
import { useForm } from "@inertiajs/vue3";
import { debounce } from "../../utils/debounce";
import { useTemplateRef, onMounted, ref } from "vue";
import axios from "axios";
import LoadingSpinner from "./LoadingSpinner.vue";

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

        fetch(`https://kitsu.io/api/edge/anime?filter[text]=${query}`)
            .then((res) => res.json())
            .then(({ data }) => {
                quickSearchResults.value = data;
            })
            .catch((err) => console.error(err));
    }

    input.value.addEventListener("input", () => {
        quickSearchResults.value = null;
        document.getElementById("quickSearchResults").style.display = "flex";
    });
    input.value.addEventListener(
        "input",
        debounce(fetchQuickSearchResults, 1500)
    );
});

function handleSearch(e) {
    const formData = new FormData(e.target);
    for (const [key, value] of formData.entries()) {
        console.log(key, value);
    }
}

function closeQuickResults() {
    quickSearchResults.value = null;
    document.getElementById("quickSearchResults").style.display = "none";
    form.reset();
}
</script>
<template>
    <div class="min-w-64 relative">
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
        <div
            id="quickSearchResults"
            style="display: none"
            class="w-96 h-72 z-10 bg-white absolute items-center justify-center"
        >
            <LoadingSpinner />
        </div>
        <div
            class="w-96 overflow-y-auto max-h-72 absolute z-20 bg-white px-4"
            v-if="quickSearchResults"
        >
            <article v-for="result of quickSearchResults" class="py-4">
                <p>{{ result.attributes.canonicalTitle }}</p>
            </article>
        </div>
    </div>
</template>
