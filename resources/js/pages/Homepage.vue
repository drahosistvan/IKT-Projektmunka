<template>
    <WebshopLayout :homepage="true">
        <!-- Category section -->
        <section aria-labelledby="category-heading" class="bg-gray-50">
            <div class="mx-auto max-w-7xl px-4 py-24 sm:px-6 sm:py-32 lg:px-8">
                <div class="sm:flex sm:items-baseline sm:justify-between">
                    <h2 id="category-heading" class="text-2xl font-bold tracking-tight text-gray-900">Kiemelt kategóriáink</h2>
                </div>

                <div class="mt-6 grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:grid-rows-2 sm:gap-x-6 lg:gap-8">
                    <div class="group relative aspect-[2/1] overflow-hidden rounded-lg sm:row-span-2 sm:aspect-square">
                        <img src="https://ugmonk.com/cdn/shop/files/yuzu-black-nightstand-9_740x918_crop_center.jpg?v=1739808851&width=500" alt="Tárolók" class="absolute size-full object-cover group-hover:opacity-75" />
                        <div aria-hidden="true" class="absolute inset-0 bg-gradient-to-b from-transparent to-black opacity-50" />
                        <div class="absolute inset-0 flex items-end p-6">
                            <div>
                                <h3 class="font-semibold text-white">
                                    <Link :href="route('category', 'tarolok')">
                                        <span class="absolute inset-0" />
                                        Tárolók
                                    </Link>
                                </h3>
                                <p aria-hidden="true" class="mt-1 text-sm text-white">Vásárlás</p>
                            </div>
                        </div>
                    </div>
                    <div class="group relative aspect-[2/1] overflow-hidden rounded-lg sm:aspect-auto">
                        <img src="https://ugmonk.com/cdn/shop/files/steel-header-1.jpg?v=1739808851&width=500" alt="Jegyzetfüzetek" class="absolute size-full object-cover group-hover:opacity-75" />
                        <div aria-hidden="true" class="absolute inset-0 bg-gradient-to-b from-transparent to-black opacity-50" />
                        <div class="absolute inset-0 flex items-end p-6">
                            <div>
                                <h3 class="font-semibold text-white">
                                    <Link :href="route('category', 'jegyzettuzetek')">
                                        <span class="absolute inset-0" />
                                        Jegyzetfüzetek
                                    </Link>
                                </h3>
                                <p aria-hidden="true" class="mt-1 text-sm text-white">Vásárlás</p>
                            </div>
                        </div>
                    </div>
                    <div class="group relative aspect-[2/1] overflow-hidden rounded-lg sm:aspect-auto">
                        <img src="https://ugmonk.com/cdn/shop/files/jstark-jf-ls-6_740x918_crop_center.jpg?v=1711743162&width=500" alt="Walnut desk organizer set with white modular trays, next to porcelain mug on wooden desk." class="absolute size-full object-cover group-hover:opacity-75" />
                        <div aria-hidden="true" class="absolute inset-0 bg-gradient-to-b from-transparent to-black opacity-50" />
                        <div class="absolute inset-0 flex items-end p-6">
                            <div>
                                <h3 class="font-semibold text-white">
                                    <Link :href="route('category', 'taskak')">
                                        <span class="absolute inset-0" />
                                        Táskák
                                    </Link>
                                </h3>
                                <p aria-hidden="true" class="mt-1 text-sm text-white">Vásárlás</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Featured section -->
        <Sustanability></Sustanability>

        <!-- Favorites section -->
        <section aria-labelledby="favorites-heading">
            <div class="mx-auto max-w-7xl px-4 py-24 sm:px-6 sm:py-32 lg:px-8">
                <div class="sm:flex sm:items-baseline sm:justify-between">
                    <h2 id="favorites-heading" class="text-2xl font-bold tracking-tight text-gray-900">Our Favorites</h2>
                </div>

                <div class="mt-6 grid grid-cols-1 gap-y-10 sm:grid-cols-3 sm:gap-x-6 sm:gap-y-0 lg:gap-x-8">
                    <Product v-for="favorite in favorites" :key="favorite.id" :product="favorite"></Product>
                </div>

                <div class="mt-6 sm:hidden">
                    <a href="#" class="block text-sm font-semibold text-indigo-600 hover:text-indigo-500">
                        Browse all favorites
                        <span aria-hidden="true"> &rarr;</span>
                    </a>
                </div>
            </div>
        </section>
    </WebshopLayout>
</template>

<script setup>
import WebshopLayout from '@/layouts/app/WebshopLayout.vue';
import {Link} from '@inertiajs/vue3';
import {ref} from 'vue';
import Product from '@/components/Product.vue';
import Sustanability from '@/components/Sustanability.vue';

const props = defineProps({
    favorites: Array,
})

const favorites = ref(props.favorites);

</script>
