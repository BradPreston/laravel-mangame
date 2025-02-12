<script setup>
const props = defineProps({
    totalCount: Number,
    currentPage: Number,
    limit: Number,
});

function handlePagination(e) {
    const page = Number(e.target.dataset.targetPage);
    const urlObject = new URL(window.location.href);
    if (!page || page === 1) {
        urlObject.searchParams.delete("page");
        return (window.location.href = urlObject.toString());
    }
    if (urlObject.searchParams.get("page")) {
        urlObject.searchParams.set("page", page);
        return (window.location.href = urlObject.toString());
    }
    urlObject.searchParams.append("page", page);
    return (window.location.href = urlObject.toString());
}

function createPageList() {
    // When the page is loaded, set the pages to show the first 5
    const pagesToShow = {
        first: 1,
        last: 5,
    };
    // get the page from the search params
    const params = new URLSearchParams(window.location.search);
    const page = parseInt(params.get("page") || 1); // set 1 if no page param
    // handles keeping the active page in the center of the pagination list if necessary
    if (page > 3) {
        pagesToShow.first = page - 2;
        pagesToShow.last = page + 2;
    } else {
        (pagesToShow.first = 1), (pagesToShow.last = 5);
    }
    const lastPage = Math.ceil(props.totalCount / props.limit);
    if (lastPage - page < 3) {
        pagesToShow.first = lastPage - 5;
        pagesToShow.last = lastPage;
    }
    // create the 5 pages to show on the pagination
    const pages = [];
    for (let i = pagesToShow.first; i <= pagesToShow.last; i++) {
        pages.push(i);
    }
    return pages;
}
</script>

<template>
    <div class="join w-full justify-center">
        <button
            :data-target-page="1"
            @click="handlePagination"
            :class="`join-item btn ${currentPage <= 1 ? 'btn-disabled' : ''}`"
        >
            <i class="fa-solid fa-angles-left"></i>
        </button>
        <button
            :data-target-page="currentPage - 1"
            @click="handlePagination"
            :class="`join-item btn ${currentPage <= 1 ? 'btn-disabled' : ''}`"
        >
            <i class="fa-solid fa-angle-left"></i>
        </button>
        <button
            v-for="page of createPageList()"
            @click="handlePagination"
            :data-target-page="page"
            :class="`join-item btn ${
                currentPage === page ? 'btn-active pointer-events-none' : ''
            }`"
        >
            {{ page }}
        </button>
        <button
            :data-target-page="currentPage + 1"
            @click="handlePagination"
            :class="`join-item btn ${
                currentPage === Math.ceil(totalCount / limit)
                    ? 'btn-disabled'
                    : ''
            }`"
        >
            <i class="fa-solid fa-angle-right"></i>
        </button>
        <button
            @click="handlePagination"
            :data-target-page="`${Math.ceil(totalCount / limit)}`"
            :class="`join-item btn ${
                currentPage === Math.ceil(totalCount / limit)
                    ? 'btn-disabled'
                    : ''
            }`"
        >
            <i class="fa-solid fa-angles-right"></i>
        </button>
    </div>
</template>
