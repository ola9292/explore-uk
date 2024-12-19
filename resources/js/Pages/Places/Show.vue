<script>
import Layout from '@/Shared/Layout.vue';
import { Link } from '@inertiajs/vue3'
export default {
  layout: Layout,
}
</script>

<script setup>

const props = defineProps({
    place: Object,
    pictureUrl: String,
    can: Object
})

</script>

<template>

   <div class="container">
        <div class="single-place_card">
            <img :src="pictureUrl" alt="">
            <div class="textual">
                <h3>{{ place.name }}</h3>
                <p>{{ place.description }}</p>
                <div class="cta">
                    <Link v-if="can.edit" :href="route('place.edit', { place: place.id })" class="btn btn-success">Edit</Link>
                    <Link v-if="can.delete" :href="route('place.destroy', { place: place.id })" method="delete" as="button" type="button" class="btn btn-danger">Delete</Link>
                </div>
            </div>

        </div>
   </div>

</template>
