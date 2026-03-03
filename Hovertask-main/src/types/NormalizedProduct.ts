// src/types/NormalizedProduct.ts

export interface NormalizedProduct {
    id: number;
    name: string;
    price: number;
    featured_image_url: string;
    rating: number;
    reviews_count: number;
    available_units: number;
    // Add more UI fields if needed
}
