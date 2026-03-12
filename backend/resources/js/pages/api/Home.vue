<script setup lang="ts">
import axios from 'axios';
import { ref, onMounted } from 'vue';
import { route } from 'ziggy-js';
import AppLayout from '@/layouts/ecommerce/AppLayoutEcom.vue';
import ProductGrid from '@/pages/api/components/ProductGrid.vue';
import type { ProductHome } from '@/types';

const products = ref<ProductHome[]>([]);
const loading = ref(true);
const error = ref<string | null>(null);

onMounted(async () => {
    try {
        const { data } = await axios.get(route('api.home'));
        products.value = data.data;
    } catch (err: unknown) {
        let message = 'Failed to load products.';
        if (axios.isAxiosError(err) || err instanceof Error) {
            message += err.message;
        }
        error.value = message;
    } finally {
        loading.value = false;
    }
});
</script>

<template>
    <AppLayout>
        <div v-if="loading" class="flex items-center justify-center py-20">
            <svg
                class="h-6 w-6 animate-spin text-muted-foreground"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
            >
                <circle
                    class="opacity-25"
                    cx="12"
                    cy="12"
                    r="10"
                    stroke="currentColor"
                    stroke-width="4"
                />
                <path
                    class="opacity-75"
                    fill="currentColor"
                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"
                />
            </svg>
        </div>

        <p v-else-if="error" class="py-20 text-center text-sm text-destructive">
            {{ error }}
        </p>
        <ProductGrid v-else :products="products" />
    </AppLayout>
</template>
