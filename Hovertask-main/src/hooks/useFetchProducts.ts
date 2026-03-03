import { useEffect, useState } from "react";
import type { NormalizedProduct } from "../types/NormalizedProduct";

export interface ProductImage {
    id: number;
    product_id: number;
    file_path: string | null;
    video_path: string | null;
    media_type: string | null;
    public_id: string | null;
}

export interface ProductApiResponse {
    id: number;
    user_id: number;
    category_id: number;
    name: string;
    description: string;
    price: string;
    stock: number;
    images: string | null;
    status: string;
    location: string | null;
    currency: string;
    discount: string;
    payment_method: string;
    meet_up_preference: string | null;
    delivery_fee: string;
    estimated_delivery_date: string;
    phone_number: string;
    email: string;
    social_media_link: string;
    video_path: string | null;
    resell_budget: string | null;
    product_images: ProductImage[];
}

const useFetchProducts = () => {
    const [products, setProducts] = useState<NormalizedProduct[]>([]);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState<string | null>(null);

    const API_ENDPOINT = "https://backend.hovertask.com/api/landing-page-products/all";

    useEffect(() => {
        const fetchProducts = async () => {
            try {
                const response = await fetch(API_ENDPOINT, {
                    method: "GET",
                    headers: { Accept: "application/json" },
                });

                if (!response.ok) {
                    throw new Error("Failed to fetch products");
                }

                const data: ProductApiResponse[] = await response.json();

                const formattedProducts: NormalizedProduct[] = data.map((item) => ({
                    id: item.id,
                    name: item.name,
                    price: Number(item.price),
                    featured_image_url:
                        item.product_images?.[0]?.file_path ||
                        item.images ||
                        "/placeholder.png",
                    rating: 0,
                    reviews_count: 0,
                    available_units: item.stock,
                }));

                setProducts(formattedProducts);
            } catch (err: any) {
                setError(err.message || "An error occurred");
            } finally {
                setLoading(false);
            }
        };

        fetchProducts();
    }, []);

    return { products, loading, error };
};

export default useFetchProducts;
