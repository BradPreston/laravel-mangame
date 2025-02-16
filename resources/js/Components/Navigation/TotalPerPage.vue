<script setup>
import { ref, onMounted } from 'vue';

const perPage = ref();
const params = new URLSearchParams(window.location.search);

onMounted(() => {
    if (!params.get("limit")) {
        perPage.value = 9;
    } else {
        perPage.value = Number(params.get("limit"))
    }
})

function handlePerPage(e) {
    const urlObject = new URL(window.location.href);
    const count = Number(e.target.innerText);
    perPage.value = count;
    if (count === 9) {
        urlObject.searchParams.delete("limit");
        return (window.location.href = urlObject.toString());
    }
    urlObject.searchParams.set("limit", count)
    return (window.location.href = urlObject.toString());
}
</script>

<template>
    <div class="flex gap-4 items-center w-full justify-end">
    <p>Show</p>
    <div class="join">
        <button @click="handlePerPage" :class="`join-item btn btn-sm ${perPage === 9 ? 'btn-active pointer-events-none' : ''}`">9</button>
        <button @click="handlePerPage" :class="`join-item btn btn-sm ${perPage === 12 ? 'btn-active pointer-events-none' : ''}`">12</button>
        <button @click="handlePerPage" :class="`join-item btn btn-sm ${perPage === 15 ? 'btn-active pointer-events-none' : ''}`">15</button>
        <button @click="handlePerPage" :class="`join-item btn btn-sm ${perPage === 18 ? 'btn-active pointer-events-none' : ''}`">18</button>
    </div>
</div>
</template>
