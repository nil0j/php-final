<script setup>
import { inject, ref } from 'vue';
import { Axios } from 'axios';

const token = inject('token')
const products = ref([])
fetch("http://localhost:8000/api/products", {
    method: 'GET',
    headers: {
        'Authorization': `Bearer ${token}`,
        'Content-Type': 'application/json',
    }
})
    .then(response => response.json())
    .then(data => {
        products.value = data.map(product => {
            return product
        })
    })

function createProduct(product) {
    let url = 'http://localhost:8000/api/products'

    fetch(url, {
        method: 'POST',
        headers: {
            'Authorization': `Bearer ${token}`,
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            'name': product.name,
            'description': product.description,
            'price': product.price
        })
    }).then(response => response.json())
}

function editProduct(id, product) {
    let url = 'http://localhost:8000/api/products/' + id

    fetch(url, {
        method: 'PUT',
        headers: {
            'Authorization': `Bearer ${token}`,
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            'name': product.name,
            'description': product.description,
            'price': product.price
        })
    }).then(response => response.json())
}

function deleteProduct(id) {
    let url = 'http://localhost:8000/api/products/' + id

    fetch(url, {
        method: 'DELETE',
        headers: {
            'Authorization': `Bearer ${token}`,
            'Content-Type': 'application/json',
        }
    }).then(response => response.json())
}

function reload() {
    window.location.reload()
}
</script>


<template>
    <h1 class="text-3xl font-medium">Product list</h1>
    <div class="p-4 border-1 border-[var(--bg-secondary)] mt-6 hover:border-purple-500 glow-hover flex"
        v-for="product in products">
        <div class="w-1/6">
            <img :src="'/solgryn.png'" alt="">
        </div>
        <div class="w-5/6">
            <div class="w-3/4">
                <div v-if="product.isEditing">
                    <input class="bg-black border-purple-500 border-1 m-1" type="text" placeholder="name"
                        v-model="product.name"></input>
                    <input class="bg-black border-purple-500 border-1 m-1" type="text" placeholder="description"
                        v-model="product.description"></input>
                    <input class="bg-black border-purple-500 border-1 m-1" type="number" placeholder="price"
                        v-model="product.price"></input>
                </div>
                <div v-else>
                    <h3>Name: {{ product.name }}</h3>
                    <p>Description: {{ product.description }}</p>
                    <p>Price: {{ product.price }}</p>
                </div>
            </div>
            <div class="w-1/4 content-center">
                <div v-if="product.isEditing">
                    <button class="cursor-pointer" @click="() => {
                        product.isEditing = false
                        if (product.isNew) {
                            createProduct({ name: product.name, description: product.description, price: product.price })
                            product.isNew = false
                        } else {
                            if (!product.id) {
                                reload()
                            }
                            editProduct(product.id, { name: product.name, description: product.description, price: product.price })
                        }
                    }">Save</button>
                </div>
                <div v-else>
                    <button class="cursor-pointer px-4" @click="() => { product.isEditing = true }">Edit</button>
                    <button class="cursor-pointer px-4" @click="() => {
                        if (!product.id) {
                            reload()
                        }
                        deleteProduct(product.id)
                        products = products.filter(p => p.id != product.id)
                    }">Delete</button>
                </div>
            </div>
        </div>
    </div>
    <div class="p-4 border-1 border-[var(--bg-secondary)]
        mt-6 hover:border-purple-500 glow-hover flex
        cursor-pointer" @click="() => {
            products.push({ isNew: true, isEditing: true })
        }">
        +
    </div>
</template>
