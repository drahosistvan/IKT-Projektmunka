<script setup lang="ts">
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';

import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import WebshopLayout from '@/layouts/app/WebshopLayout.vue';
import { type BreadcrumbItem, type SharedData, type User } from '@/types';
import TextLink from '@/components/TextLink.vue';

interface Props {
    mustVerifyEmail: boolean;
    status?: string;
}

defineProps<Props>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Profile settings',
        href: '/settings/profile',
    },
];

const page = usePage<SharedData>();
const user = page.props.auth.user as User;

const form = useForm({
    name: user.name,
    email: user.email,
});

const submit = () => {
    form.patch(route('profile.update'), {
        preserveScroll: true,
    });
};
</script>

<template>
    <WebshopLayout :breadcrumbs="breadcrumbs">
        <Head title="Profilbeállítások" />

        <div class="flex flex-col space-y-6">
            <div class="px-4 pt-16 text-center sm:px-6 lg:px-8">
                <h1 class="text-4xl font-bold tracking-tight text-gray-900">Profilbeállítások</h1>
                <p class="mx-auto mt-4 max-w-xl text-base text-gray-500">Módosítani szeretne nevén, vagy e-mail címén? Itt megteheti.</p>
            </div>

            <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm pb-7">
                <form @submit.prevent="submit" class="space-y-6">
                    <div>
                        <label for="email" class="block text-sm/6 font-medium text-gray-900">Név</label>
                        <div class="mt-2">
                            <Input id="name" class="lock w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" v-model="form.name" required autocomplete="name" placeholder="Full name" />
                            <InputError class="mt-2" :message="form.errors.name" />
                        </div>
                    </div>

                    <div>
                        <div class="flex items-center justify-between">
                            <label for="password" class="block text-sm/6 font-medium text-gray-900">E-mail cím</label>
                        </div>
                        <div class="mt-2">
                            <Input
                                id="email"
                                type="email"
                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                                v-model="form.email"
                                required
                                autocomplete="username"
                                placeholder="Email address"
                            />
                        </div>
                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>

                    <div>
                        <Button
                            :disabled="form.processing"
                            class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                        >Beállítások mentése</Button>

                        <Transition
                            enter-active-class="transition ease-in-out"
                            enter-from-class="opacity-0"
                            leave-active-class="transition ease-in-out"
                            leave-to-class="opacity-0"
                        >
                            <p v-show="form.recentlySuccessful" class="text-sm text-neutral-600">Beállítások elmentve.</p>
                        </Transition>
                    </div>

                    <div class="text-center text-sm text-muted-foreground">
                        <TextLink :href="route('password.edit')" :tabindex="5">Jelszó módosítása</TextLink>
                    </div>
                </form>
            </div>
        </div>
    </WebshopLayout>
</template>
