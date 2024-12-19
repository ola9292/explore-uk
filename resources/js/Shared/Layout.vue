<script setup>
import Nav from './Nav.vue'
import {ref} from 'vue'
const inputText = ref('')
</script>

<template>
    <Nav />
    <slot />

</template>
<style>
nav{
    background-color: black;
    padding: 20px 40px;
    display: flex;
    justify-content: space-between;
    color: white;
}
h3, h1{
    font-weight: 600;
    text-transform: capitalize;
    font-size: large;
}
h1{
    font-size: x-large;
}
.btn{
 padding: 4px 16px;
 border-radius: 4px;
 color:white;
}
.btn-success{
    background-color: green;
}
.btn-danger{
    background-color: red;
}
.btn-alert{
    background-color: #000066
}
.btn-alt{
    border: 1px solid black;
    color: black;
}
.like-btn{
    border: none;
}
.link{
    text-decoration: underline;
    color:green
}
.error{
    color: red;;
}
ul{
    display: flex;
    gap: 10px;
}
.container{
    width: 600px;
    max-width: 90%;
    margin: 50px auto;
    /* border: 1px solid red; */
}
.header-nav_links{
   display:flex;
   align-items: center;
   gap:10px
}
.home-card{
    display: grid;
    grid-template-columns: 1fr 1fr;
    border: 1px solid #e6e6e6;
    padding: 20px;
    gap: 20px;
    box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
}
.home-main{
    display: grid;
    gap: 20px;
}
.home-card > .visual{
    height: 200px;

}
.home-card > .textual{
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
    align-items: start;
    gap: 8px
}

.home-card > .visual > img{
    border-radius: 10px;
    aspect-ratio: 4/3
}
.single-place_card{
    border: 1px solid #e6e6e6;
}
.single-place_card > img{
    aspect-ratio: 16/9
}
.single-place_card > .textual{
    padding: 20px;
}
.single-place_card > .textual > .cta{
    margin-top: 10px;
    display: flex;
    justify-content: space-between;
}
.form-container{
    display: grid;
    gap: 15px;
    width: 100%;
}
.form-container > .row{
   display: flex;
   flex-direction: column;

}
.form-container > .row > input{
    width:100%
}

@media only screen and (max-width: 740px) {
  nav {
    flex-direction: column;
    gap:10px;
  }
}
</style>
