<template>
    <el-card class="search-card mb-12 animate-fade-up" shadow="never">
        <div class="flex items-center gap-4 mb-8">
            <div class="w-12 h-px bg-(--color-accent)"></div>
            <span class="text-xs tracking-[0.2em] uppercase text-(--el-text-color-secondary)">
                Search Filters
            </span>
        </div>

        <el-form :model="filters" label-position="top" class="elegant-form" @submit.prevent>
            <el-row :gutter="24">
                <el-col :xs="24" :md="12">
                    <el-form-item label="Property Name">
                        <el-input
                            v-model="filters.name"
                            placeholder="Search by name..."
                            clearable
                            size="large"
                        >
                            <template #prefix>
                                <svg class="w-4 h-4 text-(--el-text-color-secondary)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </template>
                        </el-input>
                    </el-form-item>
                </el-col>

                <el-col :xs="12" :md="6">
                    <el-form-item label="Min Price">
                        <el-input
                            v-model.number="filters.price_min"
                            type="number"
                            placeholder="$0"
                            clearable
                            size="large"
                        />
                    </el-form-item>
                </el-col>

                <el-col :xs="12" :md="6">
                    <el-form-item label="Max Price">
                        <el-input
                            v-model.number="filters.price_max"
                            type="number"
                            placeholder="$∞"
                            clearable
                            size="large"
                        />
                    </el-form-item>
                </el-col>
            </el-row>

            <el-row :gutter="24" class="mt-4">
                <el-col :xs="12" :sm="6">
                    <el-form-item label="Bedrooms">
                        <el-select v-model="filters.bedrooms" placeholder="Any" clearable size="large" class="w-full">
                            <el-option v-for="n in FILTER_RANGES.bedrooms" :key="n" :label="`${n} bed`" :value="n" />
                        </el-select>
                    </el-form-item>
                </el-col>

                <el-col :xs="12" :sm="6">
                    <el-form-item label="Bathrooms">
                        <el-select v-model="filters.bathrooms" placeholder="Any" clearable size="large" class="w-full">
                            <el-option v-for="n in FILTER_RANGES.bathrooms" :key="n" :label="`${n} bath`" :value="n" />
                        </el-select>
                    </el-form-item>
                </el-col>

                <el-col :xs="12" :sm="6">
                    <el-form-item label="Storeys">
                        <el-select v-model="filters.storeys" placeholder="Any" clearable size="large" class="w-full">
                            <el-option v-for="n in FILTER_RANGES.storeys" :key="n" :label="`${n} storey`" :value="n" />
                        </el-select>
                    </el-form-item>
                </el-col>

                <el-col :xs="12" :sm="6">
                    <el-form-item label="Garages">
                        <el-select v-model="filters.garages" placeholder="Any" clearable size="large" class="w-full">
                            <el-option v-for="n in FILTER_RANGES.garages" :key="n" :label="`${n} garage`" :value="n" />
                        </el-select>
                    </el-form-item>
                </el-col>
            </el-row>

            <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-4 mt-8 pt-8 border-t border-(--el-border-color-light)">
                <el-button
                    type="primary"
                    @click="$emit('search')"
                    :loading="loading"
                    size="large"
                >
                    <template #icon>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </template>
                    Search Properties
                </el-button>
                <el-button @click="$emit('reset')" size="large">
                    Clear All
                </el-button>
            </div>
        </el-form>
    </el-card>
</template>

<script setup>
import { FILTER_RANGES } from '../constants/filterConfig';

defineProps({
    filters: {
        type: Object,
        required: true,
    },
    loading: {
        type: Boolean,
        default: false,
    },
});

defineEmits(['search', 'reset']);
</script>
