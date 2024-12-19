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

const form = useForm({
  name: null,
  description: null,
  picture:null
})

function submit() {
  form.post('/places');
}
</script>

<template>
    <div class="container">
            <div>
                <h1>Create Place</h1>
            </div>

            <form @submit.prevent="submit">
                <div class="form-container">
                    <div class="row">
                        <label for="">Name</label>
                        <input type="text" placeholder="name" v-model="form.name">
                        <div class="error" v-if="form.errors.name">{{ form.errors.name }}</div>
                    </div>
                    <div class="row">
                        <label for="">Description</label>
                        <input type="text" placeholder="description" v-model="form.description">
                        <div class="error" v-if="form.errors.description">{{ form.errors.description }}</div>
                    </div>

                    <div class="row">
                        <label for="">Image</label>
                        <input type="file" @input="form.picture = $event.target.files[0]" />
                        <div class="error" v-if="form.errors.picture">{{ form.errors.picture }}</div>
                    </div>

                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </form>


    </div>



</template>

<style>
button{
    border:1px solid gray;
}
</style>
