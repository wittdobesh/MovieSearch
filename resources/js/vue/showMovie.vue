<template>
    <div id="showMovie" class="movie">
        <p>Title: {{movie.title}}</p>
        <p>Overview: {{movie.overview}}</p>
        <p>Release Date: {{(new Date(movie.release_date)).toLocaleDateString("en-US", {weekday: 'long', month: 'long', year: 'numeric', day: 'numeric'})}}</p>
        <p>Runtime: {{Math.floor(movie.runtime/60)}} hours, {{movie.runtime%60}} minutes</p>
        <label>Cast:</label>
        <div v-for="(c, i) in movie.cast" :key="i">
            <span>{{c.name}} playing {{c.character}}</span>
        </div>
    </div>
</template>
<script>

export default {
    props: ['movie'],
    
}
</script>