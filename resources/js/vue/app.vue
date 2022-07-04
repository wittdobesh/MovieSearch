<template>
    <div id="movieSearchContainer">
        <div class="text-center col-md-6">
            <h2 id="title">Movie Search</h2>
            <search-form />
        </div>
    </div>
</template>

<script>
import searchForm from "./searchForm.vue"

export default {
    components: {
        searchForm
    },
}
</script>