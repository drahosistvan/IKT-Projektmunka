<template>
    <div class="bg-white">
        <!-- Mobile menu -->
        <TransitionRoot as="template" :show="open">
            <Dialog class="relative z-40 lg:hidden" @close="open = false">
                <TransitionChild as="template" enter="transition-opacity ease-linear duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="transition-opacity ease-linear duration-300" leave-from="opacity-100" leave-to="opacity-0">
                    <div class="fixed inset-0 bg-black/25" />
                </TransitionChild>

                <div class="fixed inset-0 z-40 flex">
                    <TransitionChild as="template" enter="transition ease-in-out duration-300 transform" enter-from="-translate-x-full" enter-to="translate-x-0" leave="transition ease-in-out duration-300 transform" leave-from="translate-x-0" leave-to="-translate-x-full">
                        <DialogPanel class="relative flex w-full max-w-xs flex-col overflow-y-auto bg-white pb-12 shadow-xl">
                            <div class="flex px-4 pb-2 pt-5">
                                <button type="button" class="relative -m-2 inline-flex items-center justify-center rounded-md p-2 text-gray-400" @click="open = false">
                                    <span class="absolute -inset-0.5" />
                                    <span class="sr-only">Menü bezárása</span>
                                    <XMarkIcon class="size-6" aria-hidden="true" />
                                </button>
                            </div>

                            <div class="space-y-6 border-t border-gray-200 px-4 py-6">
                                <div v-for="category in $page.props.categories" :key="category.name" class="flow-root">
                                    <Link :href="route('category', category)" class="-m-2 block p-2 font-medium text-gray-900">{{ category.name }}</Link>
                                </div>
                            </div>

                            <div class="space-y-6 border-t border-gray-200 px-4 py-6">
                                <div class="flow-root">
                                    <Link :href="route('login')" class="-m-2 block p-2 font-medium text-gray-900">Sign in</Link>
                                </div>
                                <div class="flow-root">
                                    <a href="#" class="-m-2 block p-2 font-medium text-gray-900">Create account</a>
                                </div>
                            </div>
                        </DialogPanel>
                    </TransitionChild>
                </div>
            </Dialog>
        </TransitionRoot>

        <header class="relative overflow-hidden">
            <!-- Top navigation -->
            <nav aria-label="Top" class="relative z-20 bg-white/90 backdrop-blur-xl backdrop-filter">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div class="flex h-16 items-center">
                        <button type="button" class="relative rounded-md bg-white p-2 text-gray-400 lg:hidden" @click="open = true">
                            <span class="absolute -inset-0.5" />
                            <span class="sr-only">Menü megjelenítése</span>
                            <Bars3Icon class="size-6" aria-hidden="true" />
                        </button>

                        <!-- Logo -->
                        <div class="ml-4 flex lg:ml-0">
                            <Link href="/">
                                <span class="sr-only">Demo webáruház</span>
                                <img class="h-8 w-auto" src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=600" alt="" />
                            </Link>
                        </div>

                        <!-- Flyout menus -->
                            <div class="flex h-full space-x-8 ml-4">
                                <a v-for="category in $page.props.categories" :key="category.name" :href="route('category', category)" class="flex items-center text-sm font-medium text-gray-700 hover:text-gray-800">{{ category.name }}</a>
                            </div>

                        <div class="ml-auto flex items-center">
                            <div v-if="!$page.props.auth.user" class="hidden lg:flex lg:flex-1 lg:items-center lg:justify-end lg:space-x-6">
                                <Link :href="route('login')" class="text-sm font-medium text-gray-700 hover:text-gray-800">Bejelentkezés</Link>
                                <span class="h-6 w-px bg-gray-200" aria-hidden="true" />
                                <Link :href="route('register')" class="text-sm font-medium text-gray-700 hover:text-gray-800">Regisztráció</Link>
                            </div>
                            <div v-else class="hidden lg:flex lg:flex-1 lg:items-center lg:justify-end lg:space-x-6">
                                <Link class="text-sm font-medium text-gray-700 hover:text-gray-800" :href="route('profile.edit')" as="button">Profilbeállítások</Link>
                                <span class="h-6 w-px bg-gray-200" aria-hidden="true" />
                                <Link class="text-sm font-medium text-gray-700 hover:text-gray-800" method="post" :href="route('logout')" as="button">Kijelentkezés</Link>
                            </div>


                            <!-- Cart -->
                            <div class="ml-4 flow-root lg:ml-6">
                                <Link :href="route('cart')" class="group -m-2 flex items-center p-2">
                                    <ShoppingBagIcon class="size-6 shrink-0 text-gray-400 group-hover:text-gray-500" aria-hidden="true" />
                                    <span class="ml-2 text-sm font-medium text-gray-700 group-hover:text-gray-800">{{ Cart.count }}</span>
                                    <span class="sr-only">elem a kosárban, kosár megtekintése</span>
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Hero section -->
            <div v-if="props.homepage" class="pb-80 pt-16 sm:pb-40 sm:pt-24 lg:pb-48 lg:pt-40">
                <div class="relative mx-auto max-w-7xl px-4 sm:static sm:px-6 lg:px-8">
                    <div class="sm:max-w-lg">
                        <h1 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl">Legújabb jegyzetfüzeteink</h1>
                        <p class="mt-4 text-xl text-gray-500">Többféle mintázat, többféle rendszer. Tekintse meg kínálatunkat!</p>
                    </div>
                    <div>
                        <div class="mt-10">
                            <div aria-hidden="true" class="pointer-events-none lg:absolute lg:inset-y-0 lg:mx-auto lg:w-full lg:max-w-7xl">
                                <div class="absolute transform sm:left-1/2 sm:top-0 sm:translate-x-8 lg:left-1/2 lg:top-1/2 lg:-translate-y-1/2 lg:translate-x-8">
                                    <div class="flex items-center space-x-6 lg:space-x-8">
                                        <div class="grid shrink-0 grid-cols-1 gap-y-6 lg:gap-y-8">
                                            <div class="h-64 w-44 overflow-hidden rounded-lg sm:opacity-0 lg:opacity-100">
                                                <img src="https://ugmonk.com/cdn/shop/files/daily-blk-1_400x.jpg?v=1739938796" alt="" class="size-full object-cover" />
                                            </div>
                                            <div class="h-64 w-44 overflow-hidden rounded-lg">
                                                <img src="https://ugmonk.com/cdn/shop/files/weekly-black-1_400x.jpg?v=1739938796" alt="" class="size-full object-cover" />
                                            </div>
                                        </div>
                                        <div class="grid shrink-0 grid-cols-1 gap-y-6 lg:gap-y-8">
                                            <div class="h-64 w-44 overflow-hidden rounded-lg">
                                                <img src="https://ugmonk.com/cdn/shop/files/ImagefromiOS_400x.jpg?v=1742830884" alt="" class="size-full object-cover" />
                                            </div>
                                            <div class="h-64 w-44 overflow-hidden rounded-lg">
                                                <img src="https://ugmonk.com/cdn/shop/files/analog-white-hand-2_400x.jpg?v=1742399072" alt="" class="size-full object-cover" />
                                            </div>
                                            <div class="h-64 w-44 overflow-hidden rounded-lg">
                                                <img src="https://ugmonk.com/cdn/shop/files/weekly-white-3_400x.jpg?v=1739938712" alt="" class="size-full object-cover" />
                                            </div>
                                        </div>
                                        <div class="grid shrink-0 grid-cols-1 gap-y-6 lg:gap-y-8">
                                            <div class="h-64 w-44 overflow-hidden rounded-lg">
                                                <img src="https://ugmonk.com/cdn/shop/files/archive-ls-cropped-duo-white-2_400x.jpg?v=1739887632" alt="" class="size-full object-cover" />
                                            </div>
                                            <div class="h-64 w-44 overflow-hidden rounded-lg">
                                                <img src="https://ugmonk.com/cdn/shop/files/weekly-ls-12_a2f633e6-84fb-40ed-a671-8518d46d5a79_400x.jpg?v=1692391093" alt="" class="size-full object-cover" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <Link :href="route('category', 'jegyzetfuzetek')" class="inline-block rounded-md border border-transparent bg-indigo-600 px-8 py-3 text-center font-medium text-white hover:bg-indigo-700">Vásárlás</Link>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <main>
            <slot></slot>
        </main>

        <footer aria-labelledby="footer-heading" class="bg-white">
            <h2 id="footer-heading" class="sr-only">Footer</h2>
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="border-t border-gray-200">
                    <div class="pb-20 pt-16">
                        <div class="md:flex md:justify-center">
                            <img src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=600" alt="" class="h-8 w-auto" />
                        </div>
                        <div class="mx-auto mt-16 max-w-5xl xl:grid xl:grid-cols-2 xl:gap-8">
                            <div class="grid grid-cols-2 gap-8 xl:col-span-2">
                                <div class="space-y-12 md:grid md:grid-cols-2 md:gap-8 md:space-y-0">
                                    <div>
                                        <h3 class="text-sm font-medium text-gray-900">Vásárlás</h3>
                                        <ul role="list" class="mt-6 space-y-6">
                                            <li v-for="item in $page.props.categories" :key="item.name" class="text-sm">
                                                <Link :href="route('category', item)" class="text-gray-500 hover:text-gray-600">{{ item.name }}</Link>
                                            </li>
                                        </ul>
                                    </div>
                                    <div>
                                        <h3 class="text-sm font-medium text-gray-900">Ügyfélszolgálat</h3>
                                        <ul role="list" class="mt-6 space-y-6">
                                            <li v-for="item in footerNavigation.customerService" :key="item.name" class="text-sm">
                                                <Link :href="item.href" class="text-gray-500 hover:text-gray-600">{{ item.name }}</Link>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="space-y-12 md:grid md:grid-cols-2 md:gap-8 md:space-y-0">
                                    <div>
                                        <h3 class="text-sm font-medium text-gray-900">Rólunk</h3>
                                        <ul role="list" class="mt-6 space-y-6">
                                            <li v-for="item in footerNavigation.company" :key="item.name" class="text-sm">
                                                <Link :href="item.href" class="text-gray-500 hover:text-gray-600">{{ item.name }}</Link>
                                            </li>
                                        </ul>
                                    </div>
                                    <div>
                                        <h3 class="text-sm font-medium text-gray-900">Jogi információk</h3>
                                        <ul role="list" class="mt-6 space-y-6">
                                            <li v-for="item in footerNavigation.legal" :key="item.name" class="text-sm">
                                                <Link :href="item.href" class="text-gray-500 hover:text-gray-600">{{ item.name }}</Link>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="py-10 md:flex md:items-center md:justify-between">
                    <div class="text-center md:text-left">
                        <p class="text-sm text-gray-500">&copy; 2021 All Rights Reserved</p>
                    </div>

                    <div class="mt-4 flex items-center justify-center md:mt-0">
                        <div class="flex space-x-8">
                            <a v-for="item in footerNavigation.bottomLinks" :key="item.name" :href="item.href" class="text-sm text-gray-500 hover:text-gray-600">{{ item.name }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</template>

<script setup>
import { ref } from 'vue'
import {
    Dialog,
    DialogPanel,
    TransitionChild,
    TransitionRoot,
} from '@headlessui/vue'
import { Bars3Icon, ShoppingBagIcon, XMarkIcon } from '@heroicons/vue/24/outline'
import { Head, Link } from '@inertiajs/vue3';
import { cart } from '@/stores/cart';

const Cart = cart();
const props = defineProps({
    homepage: Boolean
})

const footerNavigation = {
    customerService: [
        { name: 'Szállítás', href: route('page', 'szallitas') },
        { name: 'Fizetés', href: route('page', 'fizetes') },
        { name: 'Visszaküldés', href: 'visszakuldes' },
    ],
    company: [
        { name: 'Fenntarthatóság', href: 'fenntarthatosag' },
        { name: 'Szerződési feltételek', href: route('page', 'altalanos-szerzodesi-feltetelek') },
        { name: 'Adatkezelési tájékoztató', href: route('page', 'adatkezelesi-tajekoztato') },
    ],
    legal: [
        { name: 'ÁSZF', href: route('page', 'altalanos-szerzodesi-feltetelek') },
        { name: 'Adatkezelés', href: route('page', 'adatkezelesi-tajekoztato') },
    ],
}

const open = ref(false)

</script>
