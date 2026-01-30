<?php

namespace App\Services;

use App\Models\Property;
use Illuminate\Database\Eloquent\Collection;

class PropertyService
{
    /**
     * @param array $filters Я намерено не использовал DTO, чтобы не усложнять ничего
     * @return Collection
     */
    public function search(array $filters): Collection
    {
        $query = Property::query();

        if (!empty($filters['name'])) {
            $query->where('name', 'like', '%' . $filters['name'] . '%');
        }

        foreach (['bedrooms', 'bathrooms', 'storeys', 'garages'] as $field) {
            if (isset($filters[$field])) {
                $query->where($field, $filters[$field]);
            }
        }

        if (isset($filters['price_min'])) {
            $query->where('price', '>=', $filters['price_min']);
        }

        if (isset($filters['price_max'])) {
            $query->where('price', '<=', $filters['price_max']);
        }

        return $query->get();
    }
}
