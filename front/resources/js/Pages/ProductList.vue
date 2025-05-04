<script setup>
import { inject, ref } from 'vue';
import { Axios } from 'axios';

const token = inject('token')
const products = ref([])
fetch("http://localhost:8000/api/products", {
    method: 'GET', // or 'POST', etc.
    headers: {
        'Authorization': `Bearer ${token}`, // Bearer token
        'Content-Type': 'application/json',
    }
})
    .then(response => response.json())
    .then(data => {
        console.log(data)
        products.value = data
    })
    .catch(error => console.error('Error:', error))
</script>

<template>
    <h1 class="text-3xl text-left font-medium p-4">Product list</h1>
    <div v-for="{ product } in products">
        <p>product</p>
    </div>
</template>
