<template>
    <div id="searchForm" class="search">
        <form onsubmit="return false">
            <label>Enter the title of the movie you want to find </label>
            <input type="text" v-model="search"/>
            <button @click="searchMovie()">Search</button>
        </form>
    </div>
    
    <p v-if="errors.length">
    <b>Please correct the following error(s):</b>
    <ul>
      <li v-for="error in errors">{{ error }}</li>
    </ul>
  </p>
    <show-movie 
        v-if="errors.length == 0 && movie.title!=''"
        :movie="movie"/>
</template>
<script>
import axios from 'axios'

import showMovie from "./showMovie.vue"

export default {
    components: { showMovie },
    data: function() { 
        return {
            errors: [],
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
            this.errors = [];
            if(!this.search) {
                this.errors.push("Please provide a title to search");
                return;
            }
            axios.get(`api/search?search=${this.search}`)
            .then( response=> {
                    //console.log(response.data);
                    this.movie = response.data;
            })
            .catch( error=> {
                this.errors.push("We had trouble finding anything for the search you provided. Please try a different search.       ");
                console.log(error);
            })
        }
    }

}
</script>