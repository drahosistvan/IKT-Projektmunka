<template>
    <WebshopLayout>
        <div class="bg-white">
            <div class="pt-6 sm:pb-24">
                <nav aria-label="Breadcrumb" class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <ol role="list" class="flex items-center space-x-4">
                        <li>
                            <div class="flex items-center">
                                <Link :href="route('home')" class="mr-4 text-sm font-medium text-gray-900">Kezdőlap</Link>
                                <svg viewBox="0 0 6 20" aria-hidden="true" class="h-5 w-auto text-gray-300">
                                    <path d="M4.878 4.34H3.551L.27 16.532h1.327l3.281-12.19z" fill="currentColor" />
                                </svg>
                            </div>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <Link :href="route('category', category)" class="mr-4 text-sm font-medium text-gray-900">{{ category.name }}</Link>
                                <svg viewBox="0 0 6 20" aria-hidden="true" class="h-5 w-auto text-gray-300">
                                    <path d="M4.878 4.34H3.551L.27 16.532h1.327l3.281-12.19z" fill="currentColor" />
                                </svg>
                            </div>
                        </li>
                        <li class="text-sm">
                            <Link :href="route('product', product)" aria-current="page" class="font-medium text-gray-500 hover:text-gray-600">{{ product.name }}</Link>
                        </li>
                    </ol>
                </nav>
                <div class="mx-auto mt-8 max-w-2xl px-4 sm:px-6 lg:max-w-7xl lg:px-8">
                    <div class="lg:grid lg:auto-rows-min lg:grid-cols-12 lg:gap-x-8">
                        <div class="lg:col-span-5 lg:col-start-8">
                            <div class="flex justify-between">
                                <h1 class="text-xl font-medium text-gray-900">{{ product.name }}</h1>
                                <p class="text-xl font-medium text-gray-900">{{ product.formatted_price }}</p>
                            </div>
                        </div>

                        <!-- Image gallery -->
                        <div class="mt-8 lg:col-span-7 lg:col-start-1 lg:row-span-3 lg:row-start-1 lg:mt-0">
                            <div class="grid grid-cols-1 lg:grid-cols-2 lg:gap-8">
                                <img :src="product.main_image" class="lg:col-span-2 lg:row-span-2 rounded-lg" />
                            </div>
                        </div>

                        <div class="lg:col-span-5">
                            <!-- Product details -->
                            <div class="my-12">
                                <div class="mt-4 space-y-6 text-m text-gray-500" v-html="product.description" />
                            </div>

                            <!-- Policies -->
                            <section aria-labelledby="policies-heading" class="mt-10">
                                <dl class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-1 xl:grid-cols-2">
                                    <div v-for="policy in policies" :key="policy.name" class="rounded-lg border border-gray-200 bg-gray-50 p-6 text-center">
                                        <dt>
                                            <component :is="policy.icon" class="mx-auto size-6 shrink-0 text-gray-400" aria-hidden="true" />
                                            <span class="mt-4 text-sm font-medium text-gray-900">{{ policy.name }}</span>
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-500">{{ policy.description }}</dd>
                                    </div>
                                </dl>
                            </section>

                            <button @click="Cart.add(product)" class="mt-8 flex w-full items-center justify-center rounded-md border border-transparent bg-indigo-600 px-8 py-3 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Kosárba rakom</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <section aria-labelledby="favorites-heading">
            <div class="mx-auto max-w-7xl px-4 py-24 sm:px-6 sm:py-32 lg:px-8">
                <div class="sm:flex sm:items-baseline sm:justify-between">
                    <h2 id="favorites-heading" class="text-2xl font-bold tracking-tight text-gray-900">Kapcsolódó termékek</h2>
                </div>

                <div class="mt-6 grid grid-cols-1 gap-y-10 sm:grid-cols-3 sm:gap-x-6 sm:gap-y-0 lg:gap-x-8">
                    <Product v-for="product in relatedProducts" :key="product.id" :product="product"></Product>
                </div>
            </div>
        </section>
    </WebshopLayout>
</template>

<script setup>
import { ref } from 'vue';
import WebshopLayout from '@/layouts/app/WebshopLayout.vue';
import { CurrencyDollarIcon, GlobeAmericasIcon } from '@heroicons/vue/24/outline'
import { Link } from '@inertiajs/vue3';
import Product from '@/components/Product.vue';
import { cart } from '@/Stores/cart';

const props = defineProps({
    product: Object,
    category: Object,
    relatedProducts: Array
});

const Cart = cart()
const product = ref(props.product);
product.value.quantity = 1;
const category = ref(props.category);
const relatedProducts = ref(props.relatedProducts);

const policies = [
    { name: 'Kiszállítás világszerte', icon: GlobeAmericasIcon, description: 'Szállítás 15 napon belül' },
    { name: 'Hűségprogram', icon: CurrencyDollarIcon, description: "Visszatérő vásárló? Kedvezményt adunk!" },
]
</script>
