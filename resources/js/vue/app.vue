<template>
    <div id="movieSearchContainer">
        <div class="heading">
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