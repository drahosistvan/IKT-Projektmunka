<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import WebshopLayout from '@/layouts/app/WebshopLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { LoaderCircle } from 'lucide-vue-next';

defineProps<{
    status?: string;
}>();

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>
    <WebshopLayout>
        <Head title="Forgot password" />

        <div class="mx-auto max-w-xl px-4 py-24 sm:px-6 sm:py-32 lg:px-8">
            <div v-if="status" class="mb-4 text-center text-sm font-medium text-green-600">
                {{ status }}
            </div>

            <div class="space-y-6">
                <form @submit.prevent="submit">
                    <div class="grid gap-2">
                        <Label for="email">Email address</Label>
                        <Input
                            id="email"
                            type="email"
                            name="email"
                            autocomplete="off"
                            v-model="form.email"
                            autofocus
                            placeholder="email@example.com"
                        />
                        <InputError :message="form.errors.email" />
                    </div>

                    <div class="my-6 flex items-center justify-start">
                        <Button class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600" :disabled="form.processing">
                            <LoaderCircle v-if="form.processing" class="h-4 w-4 animate-spin" />
                            Jelszóvisszaállító link küldése
                        </Button>
                    </div>
                </form>

                <div class="space-x-1 text-center text-sm text-muted-foreground">
                    <span>Vagy vissza a</span>
                    <TextLink :href="route('login')">bejelentkezéshez</TextLink>
                </div>
            </div>
        </div>
    </WebshopLayout>
</template>
