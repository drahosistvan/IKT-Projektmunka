<template>
    <WebshopLayout>
        <div class="px-4 pt-16 text-center sm:px-6 lg:px-8">
            <h1 class="text-4xl font-bold tracking-tight text-gray-900">{{ category.name}}</h1>
            <p v-html="category.description" class="mx-auto mt-4 max-w-xl text-base text-gray-500"></p>
        </div>

        <div class="mx-auto max-w-7xl px-4 py-24 sm:px-6 sm:py-32 lg:px-8">
            <div class="mt-6 grid grid-cols-1 gap-y-10 sm:grid-cols-3 sm:gap-x-6 sm:gap-y-0 lg:gap-x-8">
                <Product v-for="product in products" :key="product.id" :product="product"></Product>
            </div>
        </div>

    </WebshopLayout>
</template>

<script setup>
import { ref } from 'vue';
import WebshopLayout from '@/layouts/app/WebshopLayout.vue';
import Product from '@/components/Product.vue';

const props = defineProps({
    category: Object,
    products: Array
});

const category = ref(props.category);
const products = ref(props.products);

</script>
