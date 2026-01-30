<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PropertySearchRequest;
use App\Http\Resources\PropertyResource;
use App\Services\PropertyService;
use Illuminate\Http\JsonResponse;

class PropertyController extends Controller
{
    public function __construct(
        private readonly PropertyService $propertyService
    ) {}

    public function search(PropertySearchRequest $request): JsonResponse
    {
        $properties = $this->propertyService->search($request->validated());

        return response()->json(PropertyResource::collection($properties)->resolve());
    }
}
