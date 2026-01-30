/**
 * Конфигурация диапазонов для фильтров поиска недвижимости
 */
export const FILTER_RANGES = {
    bedrooms: [1, 2, 3, 4, 5, 6],
    bathrooms: [1, 2, 3, 4, 5],
    storeys: [1, 2, 3],
    garages: [1, 2, 3, 4],
};

/**
 * Начальное состояние фильтров
 */
export const getInitialFilters = () => ({
    name: '',
    bedrooms: null,
    bathrooms: null,
    storeys: null,
    garages: null,
    price_min: null,
    price_max: null,
});
