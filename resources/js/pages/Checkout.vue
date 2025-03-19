<template>
    <WebshopLayout>
        <div class="">
            <div class="py-20 lg:flex lg:min-h-full lg:flex-row-reverse lg:overflow-hidden">
                <!-- Mobile order summary -->
                <section aria-labelledby="order-heading" class="bg-gray-50 px-4 py-6 sm:px-6 lg:hidden">
                    <Disclosure as="div" class="mx-auto max-w-lg" v-slot="{ open }">
                        <div class="flex items-center justify-between">
                            <h2 id="order-heading" class="text-lg font-medium text-gray-900">Rendelés összesítő</h2>
                            <DisclosureButton class="font-medium text-indigo-600 hover:text-indigo-500">
                                <span v-if="open">Rendelés összesítés elrejtése</span>
                                <span v-if="!open">Rendelés összesítés megjelenítése</span>
                            </DisclosureButton>
                        </div>

                        <DisclosurePanel>
                            <ul role="list" class="divide-y divide-gray-200 border-b border-gray-200">
                                <li v-for="(product, index) in Cart.content" :key="product.id" class="flex space-x-6 py-6">
                                    <img :src="product.main_image" class="size-40 flex-none rounded-md bg-gray-200 object-cover" />
                                    <div class="flex flex-col justify-between space-y-4">
                                        <div class="space-y-1 text-sm font-medium">
                                            <h3 class="text-gray-900">{{ product.name }}</h3>
                                            <p class="text-gray-900">{{ product.quantity }} ✕ {{
                                                    Intl.NumberFormat('hu-HU', {
                                                        style: 'currency',
                                                        currency: 'HUF',
                                                        minimumFractionDigits: 0,
                                                        maximumFractionDigits: 0,
                                                    }).format(product.price) }}</p>
                                        </div>
                                        <div class="flex space-x-4">
                                            <div class="flex border-l border-gray-300 pl-4">
                                                <button
                                                    @click.prevent="Cart.remove(product)"
                                                    type="button"
                                                    class="text-sm font-medium text-indigo-600 hover:text-indigo-500"
                                                >
                                                    Törlés
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>

                            <dl class="mt-10 space-y-6 text-sm font-medium text-gray-500">
                                <div class="flex justify-between">
                                    <dt>Subtotal</dt>
                                    <dd class="text-gray-900">
                                        {{
                                            Intl.NumberFormat('hu-HU', {
                                                style: 'currency',
                                                currency: 'HUF',
                                                minimumFractionDigits: 0,
                                                maximumFractionDigits: 0,
                                            }).format(Cart.subtotal)
                                        }}
                                    </dd>
                                </div>
                                <div class="flex justify-between">
                                    <dt>Shipping</dt>
                                    <dd class="text-gray-900">
                                        {{
                                            Intl.NumberFormat('hu-HU', {
                                                style: 'currency',
                                                currency: 'HUF',
                                                minimumFractionDigits: 0,
                                                maximumFractionDigits: 0,
                                            }).format(Cart.shipping)
                                        }}
                                    </dd>
                                </div>
                                <div class="flex justify-between">
                                    <dt>Taxes</dt>
                                    <dd class="text-gray-900">
                                        {{
                                            Intl.NumberFormat('hu-HU', {
                                                style: 'currency',
                                                currency: 'HUF',
                                                minimumFractionDigits: 0,
                                                maximumFractionDigits: 0,
                                            }).format(Cart.tax)
                                        }}
                                    </dd>
                                </div>
                            </dl>
                        </DisclosurePanel>

                        <p class="mt-6 flex items-center justify-between border-t border-gray-200 pt-6 text-sm font-medium text-gray-900">
                            <span class="text-base">Total</span>
                            <span class="text-base">{{
                                Intl.NumberFormat('hu-HU', {
                                    style: 'currency',
                                    currency: 'HUF',
                                    minimumFractionDigits: 0,
                                    maximumFractionDigits: 0,
                                }).format(Cart.total)
                            }}</span>
                        </p>
                    </Disclosure>
                </section>

                <!-- Order summary -->
                <section aria-labelledby="summary-heading" class="hidden w-full max-w-md mr-4 flex-col bg-gray-50 lg:flex">
                    <h2 id="summary-heading" class="sr-only">Rendelés összesítő</h2>

                    <ul role="list" class="flex-auto divide-y divide-gray-200 overflow-y-auto px-6">
                        <li v-for="(product, index) in Cart.content" :key="product.id" class="flex space-x-6 py-6">
                            <img :src="product.main_image" class="size-40 flex-none rounded-md bg-gray-200 object-cover" />
                            <div class="flex flex-col justify-between space-y-4">
                                <div class="space-y-1 text-sm font-medium">
                                    <h3 class="text-gray-900">{{ product.name }}</h3>
                                    <p class="text-gray-900">{{ product.quantity }} ✕ {{
                                            Intl.NumberFormat('hu-HU', {
                                                style: 'currency',
                                                currency: 'HUF',
                                                minimumFractionDigits: 0,
                                                maximumFractionDigits: 0,
                                            }).format(product.price) }}</p>
                                </div>
                                <div class="flex space-x-4">
                                    <div class="flex border-l border-gray-300 pl-4">
                                        <button @click.prevent="Cart.remove(product)" type="button" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">Törlés</button>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>

                    <div class="sticky bottom-0 flex-none border-t border-gray-200 bg-gray-50 p-6">
                        <dl class="mt-10 space-y-6 text-sm font-medium text-gray-500">
                            <div class="flex justify-between">
                                <dt>Subtotal</dt>
                                <dd class="text-gray-900">
                                    {{
                                        Intl.NumberFormat('hu-HU', {
                                            style: 'currency',
                                            currency: 'HUF',
                                            minimumFractionDigits: 0,
                                            maximumFractionDigits: 0,
                                        }).format(Cart.subtotal)
                                    }}
                                </dd>
                            </div>
                            <div class="flex justify-between">
                                <dt>Shipping</dt>
                                <dd class="text-gray-900">
                                    {{
                                        Intl.NumberFormat('hu-HU', {
                                            style: 'currency',
                                            currency: 'HUF',
                                            minimumFractionDigits: 0,
                                            maximumFractionDigits: 0,
                                        }).format(Cart.shipping)
                                    }}
                                </dd>
                            </div>
                            <div class="flex justify-between">
                                <dt>Taxes</dt>
                                <dd class="text-gray-900">
                                    {{
                                        Intl.NumberFormat('hu-HU', {
                                            style: 'currency',
                                            currency: 'HUF',
                                            minimumFractionDigits: 0,
                                            maximumFractionDigits: 0,
                                        }).format(Cart.tax)
                                    }}
                                </dd>
                            </div>

                            <div class="flex items-center justify-between border-t border-gray-200 pt-6 text-gray-900">
                                <dt>Total</dt>
                                <dd class="text-base">
                                    {{
                                        Intl.NumberFormat('hu-HU', {
                                            style: 'currency',
                                            currency: 'HUF',
                                            minimumFractionDigits: 0,
                                            maximumFractionDigits: 0,
                                        }).format(Cart.total)
                                    }}
                                </dd>
                            </div>
                        </dl>
                    </div>
                </section>

                <!-- Checkout form -->
                <section
                    aria-labelledby="payment-heading"
                    class="flex-auto overflow-y-auto px-4 pb-16 pt-12 sm:px-6 sm:pt-16 lg:px-8 lg:pb-24 lg:pt-0"
                >
                    <div class="mx-auto max-w-lg lg:pt-16">
                        <form class="mt-6"  @submit.prevent="submit">
                            <div class="grid grid-cols-12 gap-x-4 gap-y-6">
                                <div class="col-span-full">
                                    <label for="email" class="block text-sm/6 font-medium text-gray-700">E-mail cím</label>
                                    <div class="mt-2">
                                        <input
                                            v-model="form.email"
                                            type="email"
                                            id="email"
                                            name="email"
                                            autocomplete="email"
                                            class="block w-full rounded-md bg-white px-3 py-2 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                                        />
                                        <InputError :message="form.errors.email" />
                                    </div>
                                </div>

                                <div class="col-span-full">
                                    <div class="relative flex justify-center">
                                        <span class="bg-white px-4 text-sm font-medium text-gray-500">Számlázási adatok</span>
                                    </div>
                                </div>

                                <div class="col-span-full">
                                    <label for="billing_name" class="block text-sm/6 font-medium text-gray-700">Név</label>
                                    <div class="mt-2">
                                        <input
                                            v-model="form.billing_name"
                                            type="text"
                                            id="billing_name"
                                            name="billing_name"
                                            autocomplete="billing_name"
                                            class="block w-full rounded-md bg-white px-3 py-2 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                                        />
                                        <InputError :message="form.errors.billing_name" />
                                    </div>
                                </div>

                                <div class="col-span-4 sm:col-span-3">
                                    <label for="billing_zip" class="block text-sm/6 font-medium text-gray-700">Irányítószám</label>
                                    <div class="mt-2">
                                        <input
                                            v-model="form.billing_zip"
                                            type="text"
                                            name="billing_zip"
                                            id="billing_zip"
                                            autocomplete="billing_zip"
                                            class="block w-full rounded-md bg-white px-3 py-2 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                                        />
                                        <InputError :message="form.errors.billing_zip" />
                                    </div>
                                </div>

                                <div class="col-span-8 sm:col-span-9">
                                    <label for="billing_city" class="block text-sm/6 font-medium text-gray-700">Város</label>
                                    <div class="mt-2">
                                        <input
                                            v-model="form.billing_city"
                                            type="text"
                                            name="billing_city"
                                            id="billing_city"
                                            autocomplete="billing_city"
                                            class="block w-full rounded-md bg-white px-3 py-2 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                                        />
                                        <InputError :message="form.errors.billing_city" />
                                    </div>
                                </div>


                                <div class="col-span-full">
                                    <label for="billing_street" class="block text-sm/6 font-medium text-gray-700">Cím</label>
                                    <div class="mt-2">
                                        <input
                                            type="text"
                                            v-model="form.billing_street"
                                            id="billing_street"
                                            name="billing_street"
                                            autocomplete="billing_street"
                                            class="block w-full rounded-md bg-white px-3 py-2 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                                        />
                                        <InputError :message="form.errors.billing_street" />
                                    </div>
                                </div>

                                <div class="col-span-full">
                                    <label for="billing_country" class="block text-sm/6 font-medium text-gray-700">Ország</label>
                                    <div class="mt-2">
                                        <select
                                            v-model="form.billing_country"
                                            id="billing_country"
                                            name="billing_country"
                                            autocomplete="billing_country"
                                            class="block w-full rounded-md bg-white px-3 py-2 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                                        >
                                            <option v-for="country in countries" :key="country.code_2" :value="country.code_2">
                                                {{ country.name }}
                                            </option>
                                        </select>
                                        <InputError :message="form.errors.billing_country" />
                                    </div>
                                </div>


                                <div class="col-span-full">
                                    <div class="relative flex justify-center">
                                        <span class="bg-white px-4 text-sm font-medium text-gray-500">Szállítási adatok</span>
                                    </div>
                                </div>

                                <div class="col-span-full">
                                    <label for="shipping_name" class="block text-sm/6 font-medium text-gray-700">Név</label>
                                    <div class="mt-2">
                                        <input
                                            v-model="form.shipping_name"
                                            type="text"
                                            id="shipping_name"
                                            name="shipping_name"
                                            autocomplete="shipping_name"
                                            class="block w-full rounded-md bg-white px-3 py-2 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                                        />
                                        <InputError :message="form.errors.shipping_name" />
                                    </div>
                                </div>

                                <div class="col-span-4 sm:col-span-3">
                                    <label for="shipping_zip" class="block text-sm/6 font-medium text-gray-700">Irányítószám</label>
                                    <div class="mt-2">
                                        <input
                                            v-model="form.shipping_zip"
                                            type="text"
                                            name="shipping_zip"
                                            id="shipping_zip"
                                            autocomplete="shipping_zip"
                                            class="block w-full rounded-md bg-white px-3 py-2 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                                        />
                                        <InputError :message="form.errors.shipping_zip" />
                                    </div>
                                </div>

                                <div class="col-span-8 sm:col-span-9">
                                    <label for="shipping_city" class="block text-sm/6 font-medium text-gray-700">Város</label>
                                    <div class="mt-2">
                                        <input
                                            v-model="form.shipping_city"
                                            type="text"
                                            name="shipping_city"
                                            id="shipping_city"
                                            autocomplete="shipping_city"
                                            class="block w-full rounded-md bg-white px-3 py-2 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                                        />
                                        <InputError :message="form.errors.shipping_city" />
                                    </div>
                                </div>


                                <div class="col-span-full">
                                    <label for="shipping_street" class="block text-sm/6 font-medium text-gray-700">Cím</label>
                                    <div class="mt-2">
                                        <input
                                            v-model="form.shipping_street"
                                            type="text"
                                            id="shipping_street"
                                            name="shipping_street"
                                            autocomplete="shipping_street"
                                            class="block w-full rounded-md bg-white px-3 py-2 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                                        />
                                        <InputError :message="form.errors.shipping_street" />
                                    </div>
                                </div>

                                <div class="col-span-full">
                                    <label for="shipping_country" class="block text-sm/6 font-medium text-gray-700">Ország</label>
                                    <div class="mt-2">
                                        <select
                                            v-model="form.shipping_country"
                                            id="shipping_country"
                                            name="shipping_country"
                                            autocomplete="shipping_country"
                                            class="block w-full rounded-md bg-white px-3 py-2 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                                        >
                                            <option v-for="country in countries" :key="country.code_2" :value="country.code_2">
                                                {{ country.name }}
                                            </option>
                                        </select>
                                        <InputError :message="form.errors.shipping_country" />
                                    </div>
                                </div>

                            </div>

                            <button
                                :disabled="!Cart.count"
                                type="submit"
                                class="mt-6 w-full rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                            >
                                Rendelés kifizetése
                                ({{
                                    Intl.NumberFormat('hu-HU', {
                                        style: 'currency',
                                        currency: 'HUF',
                                        minimumFractionDigits: 0,
                                        maximumFractionDigits: 0,
                                    }).format(Cart.total)
                                }})
                            </button>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </WebshopLayout>
</template>

<script setup>
import { cart } from '@/Stores/cart';
import WebshopLayout from '@/layouts/app/WebshopLayout.vue';
import { reactive, ref } from 'vue';
import { router, useForm } from '@inertiajs/vue3';
import { Disclosure, DisclosureButton, DisclosurePanel } from '@headlessui/vue';
import InputError from '@/components/InputError.vue';
import { useToast } from "vue-toastification";

const toast = useToast()

const props = defineProps({
    user: Object,
    countries: Array
})

const user = ref(props.user);
const Cart = cart();
const form = useForm({
    products: Cart.content,
    billing_name: '',
    billing_zip: '',
    billing_city: '',
    billing_street: '',
    billing_country: '',
    shipping_name: '',
    shipping_zip: '',
    shipping_city: '',
    shipping_street: '',
    shipping_country: '',
    email: '',
    total: Cart.total,
    shipping_cost: Cart.shipping,
});

function submit() {
    form.post('/checkout', {
        onSuccess: () => {
            form.reset();
            Cart.clear();
        },
        onError: (error) => {
            toast.error(error.message, {
                timeout: 3000,
                hideProgressBar: true
            })
        },
    })
}


</script>
