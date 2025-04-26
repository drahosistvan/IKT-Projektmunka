<template>
    <WebshopLayout>
        <div class="mx-auto max-w-2xl px-4 pb-24 pt-16 sm:px-6 lg:max-w-7xl lg:px-8">
            <h1 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Kosár</h1>

            <form class="mt-12 lg:grid lg:grid-cols-12 lg:items-start lg:gap-x-12 xl:gap-x-16">
                <section aria-labelledby="cart-heading" class="lg:col-span-7">

                    <ul role="list" class="divide-y divide-gray-200 border-b border-t border-gray-200">
                        <li v-for="(product, index) in Cart.content" :key="product.id" class="flex py-6 sm:py-10">
                            <div class="shrink-0">
                                <img :src="product.main_image" class="size-24 rounded-md object-cover sm:size-48" />
                            </div>

                            <div class="ml-4 flex flex-1 flex-col justify-between sm:ml-6">
                                <div class="relative pr-9 sm:grid sm:grid-cols-2 sm:gap-x-6 sm:pr-0">
                                    <div>
                                        <div class="flex justify-between">
                                            <h3 class="text-sm">
                                                <Link :href="route('product', product)" class="font-medium text-gray-700 hover:text-gray-800">
                                                    {{ product.name }}
                                                </Link>
                                            </h3>
                                        </div>

                                        <p class="mt-1 text-sm font-medium text-gray-900">{{ product.formatted_price }}</p>
                                    </div>

                                    <div class="mt-4 sm:mt-0 sm:pr-9">
                                        <div class="inline-grid w-full max-w-16 grid-cols-1">
                                            <div class="flex items-center">
                                                <MinusIcon class="text-gray-900 h-6 w-6 cursor-pointer pr-2" :class="{'cursor-not-allowed opacity-50': product.quantity == 1}" @click.prevent="decreaseQuantity(product)" />
                                                <span
                                                    class="text-gray-900 text-lg font-medium border-2 border-[#dce6f4] w-12 flex justify-center items-center select-none"
                                                    v-text="product.quantity" />
                                                <PlusIcon class="text-gray-900 h-6 w-6 cursor-pointer pl-2" @click.prevent="increaseQuantity(product)"/>
                                            </div>
                                        </div>

                                        <div class="absolute right-0 top-0">
                                            <button @click.prevent="Cart.remove(product)" type="button" class="-m-2 inline-flex p-2 text-gray-400 hover:text-gray-500">
                                                <span class="sr-only">Törlés</span>
                                                <XMarkIconMini class="size-5" aria-hidden="true" />
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <p class="mt-4 flex space-x-2 text-sm text-gray-700">
                                    <CheckIcon v-if="product.quantity <= product.qty" class="size-5 shrink-0 text-green-500" aria-hidden="true" />
                                    <ClockIcon v-else class="size-5 shrink-0 text-gray-300" aria-hidden="true" />
                                    <span>{{ product.quantity <= product.qty ? 'Készleten' : `15 napon belül szállítjuk` }}</span>
                                </p>
                            </div>
                        </li>
                    </ul>
                </section>

                <!-- Order summary -->
                <section aria-labelledby="summary-heading" class="mt-16 rounded-lg bg-gray-50 px-4 py-6 sm:p-6 lg:col-span-5 lg:mt-0 lg:p-8">
                    <h2 id="summary-heading" class="text-lg font-medium text-gray-900">Rendelés összesítő</h2>

                    <dl class="mt-6 space-y-4">
                        <div class="flex items-center justify-between">
                            <dt class="text-sm text-gray-600">Részösszeg</dt>
                            <dd class="text-sm font-medium text-gray-900">{{ Intl.NumberFormat('hu-HU', {
                                style: 'currency',
                                currency: 'HUF',
                                minimumFractionDigits: 0,
                                maximumFractionDigits: 0
                            }).format(Cart.subtotal) }}</dd>
                        </div>
                        <div class="flex items-center justify-between border-t border-gray-200 pt-4">
                            <dt class="flex items-center text-sm text-gray-600">
                                <span>Szállítás</span>
                            </dt>
                            <dd class="text-sm font-medium text-gray-900">{{ Intl.NumberFormat('hu-HU', {
                                style: 'currency',
                                currency: 'HUF',
                                minimumFractionDigits: 0,
                                maximumFractionDigits: 0
                            }).format(Cart.shipping) }}</dd>
                        </div>
                        <div class="flex items-center justify-between border-t border-gray-200 pt-4">
                            <dt class="flex text-sm text-gray-600">
                                <span>ÁFA</span>
                            </dt>
                            <dd class="text-sm font-medium text-gray-900">{{ Intl.NumberFormat('hu-HU', {
                                style: 'currency',
                                currency: 'HUF',
                                minimumFractionDigits: 0,
                                maximumFractionDigits: 0
                            }).format(Cart.tax) }}</dd>
                        </div>
                        <div class="flex items-center justify-between border-t border-gray-200 pt-4">
                            <dt class="text-base font-medium text-gray-900">Rendelés összesen</dt>
                            <dd class="text-base font-medium text-gray-900">{{ Intl.NumberFormat('hu-HU', {
                                style: 'currency',
                                currency: 'HUF',
                                minimumFractionDigits: 0,
                                maximumFractionDigits: 0
                            }).format(Cart.total) }}</dd>
                        </div>
                    </dl>

                    <div class="mt-6">
                        <div
                            class="text-center w-full rounded-md border border-transparent bg-indigo-600 px-4 py-3 text-base font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-50"
                        >
                            <Link :disabled="!Cart.count" :href="route('checkout')">Tovább a pénztárhoz</Link>
                        </div>
                    </div>
                </section>
            </form>
        </div>
    </WebshopLayout>
</template>

<script setup>
import { cart } from '@/stores/cart';
import WebshopLayout from '@/layouts/app/WebshopLayout.vue';
import { Link, useForm } from '@inertiajs/vue3';
import { ChevronDownIcon } from '@heroicons/vue/16/solid';
import { CheckIcon, ClockIcon, QuestionMarkCircleIcon, XMarkIcon as XMarkIconMini } from '@heroicons/vue/20/solid';
import { MinusIcon, PlusIcon, ArrowLeftIcon, TrashIcon, ShoppingBagIcon, Cog6ToothIcon } from '@heroicons/vue/24/outline';

const Cart = cart();

const form = useForm({
    products: Cart.content
});

const increaseQuantity = (product) => {
    product.quantity++
    Cart.update(product)
}

const decreaseQuantity = (product) => {
    if(product.quantity == 1) return
    product.quantity--
    Cart.update(product)
}


</script>
