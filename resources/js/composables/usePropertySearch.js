import { ref, onMounted } from 'vue';
import axios from 'axios';
import { getInitialFilters } from '../constants/filterConfig';

export function usePropertySearch() {
    const loading = ref(false);
    const properties = ref([]);
    const filters = ref(getInitialFilters());

    // поиск по фильтрам, грузим даные
    const search = async () => {
        loading.value = true;
        try {
            const params = Object.fromEntries(
                Object.entries(filters.value).filter(([, value]) => value !== null && value !== '')
            );

            const response = await axios.get('/api/properties/search', { params });
            properties.value = response.data;
        } catch (error) {
            console.error('Search failed:', error);
        } finally {
            loading.value = false;
        }
    };

    // сброс фильтров и снова ищем
    const resetFilters = () => {
        filters.value = getInitialFilters();
        search();
    };

    // стартовый поиск при заходе
    onMounted(search);

    return {
        loading,
        properties,
        filters,
        search,
        resetFilters,
    };
}
