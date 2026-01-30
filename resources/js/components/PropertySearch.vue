<template>
    <div class="property-search min-h-screen relative z-10">
        <header class="pt-12 pb-8 px-6 md:px-12 lg:px-20">
            <div class="max-w-7xl mx-auto">
                <div class="flex items-end justify-between">
                    <div>
                        <p class="text-(--el-text-color-secondary) text-xs tracking-[0.2em] uppercase mb-2">
                          Test Assignment for Hicaliber
                        </p>
                        <h1 class="text-4xl md:text-5xl lg:text-6xl tracking-tight">
                            Property search
                        </h1>
                    </div>
                    <div class="hidden md:block text-right">
                        <p class="text-xs text-(--el-text-color-secondary) tracking-wider">
                            {{ properties.length }} properties available
                        </p>
                    </div>
                </div>
            </div>
        </header>

        <main class="px-6 md:px-12 lg:px-20 pb-20">
            <div class="max-w-7xl mx-auto">
                <SearchFilters
                    :filters="filters"
                    :loading="loading"
                    @search="search"
                    @reset="resetFilters"
                />

                <PropertyTable
                    :properties="properties"
                    :loading="loading"
                    @reset="resetFilters"
                />
            </div>
        </main>

        <footer class="px-6 md:px-12 lg:px-20 py-8 border-t border-(--el-border-color)">
            <div class="max-w-7xl mx-auto text-center text-xs text-(--el-text-color-secondary) tracking-wider">
                <p>Test Assignment for Hicaliber</p>
            </div>
        </footer>
    </div>
</template>

<script setup>
import SearchFilters from './SearchFilters.vue';
import PropertyTable from './PropertyTable.vue';
import { usePropertySearch } from '../composables/usePropertySearch';

const {
    loading,
    properties,
    filters,
    search,
    resetFilters,
} = usePropertySearch();
</script>
