<template>
    <WebshopLayout>
        <section aria-labelledby="category-heading" class="bg-gray-50">

            <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 sm:py-32 lg:px-8">
                <h1 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">{{ page.title }}</h1>
                <div class="py-12 prose" v-html="page.content">
                </div>
            </div>
        </section>
    </WebshopLayout>
</template>

<script setup>
import { ref } from 'vue';
import WebshopLayout from '@/layouts/app/WebshopLayout.vue';

const props = defineProps({
    page: Object,
});

const page = ref(props.page);

</script>
