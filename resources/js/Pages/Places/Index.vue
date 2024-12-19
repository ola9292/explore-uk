<script>
import Layout from '@/Shared/Layout.vue';
import { Link } from '@inertiajs/vue3'
export default {
  layout: Layout,
}
</script>

<script setup>

const props = defineProps({
    places: Array,
    can: Object
})

</script>

<template>
    <div class="container">
        <div class="home-main" v-if="places.length > 0">
            <div v-for="(place, index) in places">

                    <div :key="place.id" class="home-card">
                        <div class="visual">
                            <img :src="place.picture" alt="">
                        </div>
                        <div class="textual">
                            <h3 class="header">{{ place.name }}</h3>
                            <p class="description">{{ place.description.length > 100 ? place.description.slice(0, 100) + '...' : place.description }}</p>

                            <!-- <p>{{ place.liked ? 'Unlike' : 'Like' }} ({{ place.totalLikes }})</p> -->
                            <div class="likes">
                                <Link
                                    :href="`places/${place.id}/toggle-like`"
                                    method="post"
                                    as="button"
                                    type="button"
                                    class="like-btn"
                                    preserve-scroll>
                                    <i v-if="place.liked" class="fa-solid fa-heart"></i>
                                    <span v-else><i class="fa-regular fa-heart"></i></span>
                                </Link>
                                ({{ place.totalLikes }})
                            </div>
                            <p>By: {{ place.user.name }}</p>
                            <Link :href="`places/${place.id}`" class="btn btn-alt">See More...</Link>
                        </div>
                    </div>
            </div>
        </div>

        <div class="home" v-else>
            <p>There are no places to show at this time. <a class="link" href="/places/create">Create New Place</a></p>
        </div>
    </div>



</template>

