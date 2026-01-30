<template>
    <section class="animate-fade-up" style="animation-delay: 0.15s">
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center gap-4">
                <div class="w-8 h-px bg-(--color-accent)"></div>
                <h2 class="text-2xl md:text-3xl">
                    Results
                </h2>
                <el-tag type="info" effect="plain" round>
                    {{ properties.length }}
                </el-tag>
            </div>
        </div>

        <el-card class="results-card" shadow="never" v-loading="loading">
            <el-table
                v-if="properties.length > 0"
                :data="properties"
                :row-key="rowKey"
                style="width: 100%"
                class="elegant-table"
            >
                <el-table-column prop="name" label="Name" min-width="180">
                    <template #default="{ row }">
                        <span class="property-name">{{ row.name }}</span>
                    </template>
                </el-table-column>

                <el-table-column prop="price" label="Price" width="180">
                    <template #default="{ row }">
                        <span class="price-cell">${{ formatPrice(row.price) }}</span>
                    </template>
                </el-table-column>

                <el-table-column prop="bedrooms" label="Beds" width="120" align="center">
                    <template #default="{ row }">
                        <el-tag effect="plain" round size="small">
                            {{ row.bedrooms }}
                        </el-tag>
                    </template>
                </el-table-column>

                <el-table-column prop="bathrooms" label="Baths" width="120" align="center">
                    <template #default="{ row }">
                        <el-tag effect="plain" round size="small">
                            {{ row.bathrooms }}
                        </el-tag>
                    </template>
                </el-table-column>

                <el-table-column prop="storeys" label="Storeys" width="130" align="center">
                    <template #default="{ row }">
                        <el-tag effect="plain" round size="small">
                            {{ row.storeys }}
                        </el-tag>
                    </template>
                </el-table-column>

                <el-table-column prop="garages" label="Garages" width="130" align="center">
                    <template #default="{ row }">
                        <el-tag effect="plain" round size="small">
                            {{ row.garages }}
                        </el-tag>
                    </template>
                </el-table-column>
            </el-table>

            <el-empty v-else description="No properties found matching your criteria">
                <el-button @click="$emit('reset')">
                    Reset Filters
                </el-button>
            </el-empty>
        </el-card>
    </section>
</template>

<script setup>
defineProps({
    properties: {
        type: Array,
        required: true,
    },
    loading: {
        type: Boolean,
        default: false,
    },
});

defineEmits(['reset']);

const rowKey = row => row.id ?? row.name;

const formatPrice = value => {
    const numeric = Number(value);
    return Number.isFinite(numeric) ? numeric.toLocaleString() : '-';
};
</script>

<style scoped>
.results-card :deep(.elegant-table .el-table__header-wrapper th) {
    background: var(--el-fill-color);
    color: var(--el-text-color-secondary);
    font-weight: 500;
    font-size: 0.75rem;
    letter-spacing: 0.05em;
    text-transform: uppercase;
    border-bottom: 1px solid var(--el-border-color);
    padding: 1rem 0.75rem;
    white-space: nowrap;
}

.results-card :deep(.elegant-table .el-table__body-wrapper td) {
    padding: 1.25rem;
}

.results-card :deep(.elegant-table) {
    cursor: pointer;
    transition: background 0.2s ease;
}
</style>
