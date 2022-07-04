<template>
    <div id="searchForm" class="search">
        <form onsubmit="return false">
            <label>Enter the name of the movie you want to search </label>
            <input type="text" v-model="search"/>
            <button @click="searchMovie()">Search</button>
        </form>
    </div>
    
    <div id="searchError" v-if="error">We had trouble finding anything for the search you provided. Please try a different search. </div>
    <show-movie 
        v-if="!error && movie.title!=''"
        :movie="movie"/>
</template>
<script>
import axios from 'axios'

import showMovie from "./showMovie.vue"

export default {
    components: { showMovie },
    data: function() { 
        return {
            error: false,
            search: "",
            movie: {
                title: "",
                overview: "",
                release_date: "",
                runtime: "",
                cast: []
            },
        }
    },
    methods: {
        searchMovie() {
            axios.get(`api/search?search=${this.search}`)
            .then( response=> {
                    //console.log(response.data);
                    this.movie = response.data;
                    this.error = false;
            })
            .catch( error=> {
                this.error = true;
                console.log(error);
            })
        }
    }

}
</script>