<script>
import Layout from '@/Shared/Layout.vue';

export default {
  layout: Layout,
}
</script>

<script setup>
import { reactive } from 'vue'
import { useForm } from '@inertiajs/vue3'
// import Layout from '@/Shared/Layout.vue';
const props = defineProps({
    place: Object,
})
const form = useForm({
  name: props.place.name,
  description: props.place.description,
  picture:null
})


function submit() {
  form.put(`/places/${props.place.id}`);
}
</script>

<template>
    <div class="container">
            <div>
                <h1>Edit Place</h1>
            </div>

            <form @submit.prevent="submit">
                <div class="form-container">
                    <div class="row">
                        <label for="">Name</label>
                        <input type="text" placeholder="name" v-model="form.name">
                        <div v-if="form.errors.name">{{ form.errors.name }}</div>
                    </div>
                    <div class="row">
                        <label for="">Description</label>
                        <input type="text" placeholder="description" v-model="form.description">
                        <div v-if="form.errors.description">{{ form.errors.description }}</div>
                    </div>
                    <div class="row">
                        <label for="">Image</label>
                        <input type="file" @input="form.picture = $event.target.files[0]" />
                        <div v-if="form.errors.picture">{{ form.errors.picture }}</div>
                    </div>

                    <button type="submit" class="btn btn-alert">Update</button>
                </div>

        </form>
    </div>




</template>

<style>
button{
    border:1px solid gray;
}
</style>
