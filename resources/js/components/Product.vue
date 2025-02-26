<script setup>
    import { ref } from 'vue';
    import { Link } from '@inertiajs/vue3';

    const props = defineProps({
        product: Object,
    });

    const product = ref(props.product);
</script>

<template>
    <div class="group relative mb-8">
        <img :src="product.main_image" class="h-96 w-full rounded-lg object-cover group-hover:opacity-75 sm:aspect-[2/3] sm:h-auto" />
        <h3 class="mt-4 text-base font-semibold text-gray-900">
            <Link :href="route('product', product)">
                <span class="absolute inset-0" />
                {{ product.name }}
            </Link>
        </h3>
        <p class="mt-1 text-sm text-gray-500">{{ product.formatted_price }}</p>
    </div>
</template>
