<script setup lang="ts">

import { Link } from '@inertiajs/vue3';
</script>

<template>
    <section aria-labelledby="cause-heading">
        <div class="relative bg-gray-800 px-6 py-32 sm:px-12 sm:py-40 lg:px-16">
            <div class="absolute inset-0 overflow-hidden">
                <img src="https://tailwindcss.com/plus-assets/img/ecommerce-images/home-page-03-feature-section-full-width.jpg" alt="" class="size-full object-cover" />
            </div>
            <div aria-hidden="true" class="absolute inset-0 bg-gray-900/50" />
            <div class="relative mx-auto flex max-w-3xl flex-col items-center text-center">
                <h2 id="cause-heading" class="text-3xl font-bold tracking-tight text-white sm:text-4xl">Fenntartható gondolkodás</h2>
                <p class="mt-3 text-xl text-white">Célunk, hogy hozzájáruljunk egy fenntarthatóbb jövőhöz azáltal, hogy csökkentjük környezeti lábnyomunkat, és támogatjuk a tudatos vásárlói döntéseket. Hiszünk abban, hogy közös felelősségünk megvédeni bolygónkat a jövő generációi számára.</p>
                <Link :href="route('page', 'fenntarthatosag')" class="mt-8 block w-full rounded-md border border-transparent bg-white px-8 py-3 text-base font-medium text-gray-900 hover:bg-gray-100 sm:w-auto">További információk a fenntarthatóságunkról</Link>
            </div>
        </div>
    </section>
</template>
