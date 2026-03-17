import { Link, useSearchParams } from "react-router";
import MarketplaceSearchForm from "../../shared/components/MarketplaceSearchForm";
import { ArrowLeft, Search, TrendingUp, Star, Eye, ShoppingBag, Sparkles, Zap, ArrowRight, Filter, Grid3X3, List } from "lucide-react";
import ProductsSection from "./components/ProductsSection";
import CarouselAdBanner from "../../shared/components/CarouselAdBanner";
import MarketplaceAside from "./components/MarketplaceAside";
import useProducts from "../../hooks/useProducts";
import Loading from "../../shared/components/Loading";
import EmptyMapErr from "../../shared/components/EmptyMapErr";
import { useState } from "react";
import { Button } from "@heroui/react";

export default function MarketplacePage() {
	const { products, reload } = useProducts();
	const [searchParams, setSearchParams] = useSearchParams();
	const [viewMode, setViewMode] = useState<"grid" | "list">("grid");
	const [selectedCategory, setSelectedCategory] = useState<string>("all");

	// Filter products based on search
	const filteredProducts = products?.filter(product => {
		if (selectedCategory !== "all") {
			return product.category_id?.toString() === selectedCategory;
		}
		return true;
	}) || [];

	// Featured products (products with discount or high rating)
	const featuredProducts = products?.filter(p => p.discount || p.rating >= 4) || [];

	// Trending products (most viewed/sold - simulated)
	const trendingProducts = products?.slice(0, 8) || [];

	return (
		<div className="min-h-full bg-gradient-to-br from-slate-50 via-white to-blue-50/30">
			{/* Enhanced Header */}
			<div className="bg-white border-b border-slate-200 shadow-sm sticky top-0 z-50">
				<div className="max-w-7xl mx-auto px-4 py-4">
					<div className="flex items-center justify-between gap-4">
						<div className="flex items-center gap-4">
							<Link to="/" className="shrink-0">
								<ArrowLeft className="text-slate-600 hover:text-primary transition-colors" />
							</Link>
							<div>
								<h1 className="text-xl font-bold text-slate-800">
									Marketplace
								</h1>
								<p className="text-sm text-slate-500 hidden sm:block">
									Buy, sell, and earn effortlessly
								</p>
							</div>
						</div>

						{/* Quick Stats */}
						<div className="hidden md:flex items-center gap-6">
							<QuickStat icon={<ShoppingBag size={18} />} label="Products" value={products?.length || 0} color="text-blue-600" bg="bg-blue-50" />
							<QuickStat icon={<TrendingUp size={18} />} label="Trending" value={trendingProducts.length} color="text-green-600" bg="bg-green-50" />
							<QuickStat icon={<Star size={18} />} label="Featured" value={featuredProducts.length} color="text-amber-600" bg="bg-amber-50" />
						</div>
					</div>
				</div>
			</div>

			<div className="max-w-7xl mx-auto px-4 py-6">
				{/* Hero Section */}
				<Hero />

				{/* Quick Actions */}
				<div className="grid grid-cols-2 sm:grid-cols-4 gap-3 mb-8">
					<QuickActionCard
						icon={<ShoppingBag className="text-blue-600" />}
						title="Browse Products"
						description="Find amazing deals"
						link="/dashboard/marketplace"
						color="from-blue-50 to-blue-100"
					/>
					<QuickActionCard
						icon={<Sparkles className="text-purple-600" />}
						title="List Your Product"
						description="Start selling today"
						link="/dashboard/marketplace/list-product?type=list-product"
						color="from-purple-50 to-purple-100"
					/>
					<QuickActionCard
						icon={<Zap className="text-amber-600" />}
						title="Become a Reseller"
						description="Earn through promotion"
						link="/dashboard/marketplace/list-product?type=resell"
						color="from-amber-50 to-amber-100"
					/>
					<QuickActionCard
						icon={<TrendingUp className="text-green-600" />}
						title="Track Performance"
						description="View your analytics"
						link="/dashboard/marketplace/performance"
						color="from-green-50 to-green-100"
					/>
				</div>

				{/* Main Content Grid */}
				<div className="grid grid-cols-1 lg:grid-cols-[1fr_280px] gap-6">
					{/* Products Section */}
					<div className="space-y-8">
						{products ? (
							products.length > 0 ? (
								<>
									{/* Featured Products */}
									{featuredProducts.length > 0 && (
										<section className="space-y-4">
											<div className="flex items-center justify-between">
												<div className="flex items-center gap-2">
													<Sparkles className="text-amber-500" size={20} />
													<h2 className="font-semibold text-lg text-slate-800">Featured Products</h2>
												</div>
												<Link to="/dashboard/marketplace/c/featured" className="text-sm text-primary hover:underline flex items-center gap-1">
													View All <ArrowRight size={14} />
												</Link>
											</div>
											<div className="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
												{featuredProducts.slice(0, 4).map((product) => (
													<ProductCardV2 key={product.id} product={product} />
												))}
											</div>
										</section>
									)}

									<CarouselAdBanner />

									{/* Trending Products */}
									<ProductsSection
										products={trendingProducts}
										heading="Trending Now 🔥"
										link="/dashboard/marketplace/c/trending"
										grid
										useResponsiveCard
									/>

									<ProductsSection
										products={filteredProducts}
										heading="Best Deals & Services"
										link="/dashboard/marketplace/c/best-deals-and-services"
										grid
										useResponsiveCard
									/>

									<ProductsSection
										products={filteredProducts}
										heading="Popular Categories"
										link="/dashboard/marketplace/c/popular"
										grid
										useResponsiveCard
									/>

									<CarouselAdBanner />
								</>
							) : (
								<EmptyMapErr
									buttonInnerText="Reload"
									description="No products available yet. Be the first to list!"
									onButtonClick={reload}
								/>
							)
						) : (
							<Loading />
						)}
					</div>

					{/* Sidebar */}
					<div>
						<MarketplaceAside />
					</div>
				</div>
			</div>
		</div>
	);
}

function QuickStat({ icon, label, value, color, bg }: { icon: React.ReactNode; label: string; value: number; color: string; bg: string }) {
	return (
		<div className="flex items-center gap-2">
			<div className={`p-2 rounded-lg ${bg}`}>
				{icon}
			</div>
			<div>
				<p className="text-xs text-slate-500">{label}</p>
				<p className={`font-semibold ${color}`}>{value}</p>
			</div>
		</div>
	);
}

function QuickActionCard({ icon, title, description, link, color }: { icon: React.ReactNode; title: string; description: string; link: string; color: string }) {
	return (
		<Link to={link} className="block">
			<div className={`bg-gradient-to-br ${color} rounded-xl p-4 border border-white shadow-sm hover:shadow-md transition-all hover:-translate-y-0.5`}>
				<div className="flex items-center gap-3">
					<div className="p-2 bg-white rounded-lg shadow-sm">
						{icon}
					</div>
					<div>
						<h3 className="font-medium text-sm text-slate-800">{title}</h3>
						<p className="text-xs text-slate-500">{description}</p>
					</div>
				</div>
			</div>
		</Link>
	);
}

function Hero() {
	return (
		<div className="relative rounded-2xl overflow-hidden mb-8">
			<div className="absolute inset-0 bg-gradient-to-r from-primary via-primary/90 to-purple-600"></div>
			<div className="absolute inset-0 opacity-20">
				<div className="absolute top-0 left-0 w-40 h-40 bg-white rounded-full blur-3xl -translate-x-1/2 -translate-y-1/2"></div>
				<div className="absolute bottom-0 right-0 w-60 h-60 bg-amber-300 rounded-full blur-3xl translate-x-1/3 translate-y-1/3"></div>
			</div>
			<div className="relative z-10 p-6 sm:p-8 flex flex-col sm:flex-row items-center justify-between gap-6">
				<div className="text-center sm:text-left">
					<h2 className="text-2xl sm:text-3xl font-bold text-white mb-2">
						Connect, Trade & Earn
					</h2>
					<p className="text-white/80 text-sm sm:text-base max-w-md">
						Discover amazing products or start selling today. Join thousands of buyers and sellers on Hovertask Marketplace.
					</p>
					<div className="flex flex-wrap justify-center sm:justify-start gap-3 mt-4">
						<Link to="/dashboard/marketplace/list-product?type=list-product">
							<Button className="bg-white text-primary font-medium" size="sm">
								Sell Now
							</Button>
						</Link>
						<Link to="/dashboard/marketplace">
							<Button variant="bordered" className="border-white text-white hover:bg-white/10" size="sm">
								Browse Products
							</Button>
						</Link>
					</div>
				</div>
				<div className="w-full sm:w-auto max-w-md">
					<MarketplaceSearchForm />
				</div>
			</div>
		</div>
	);
}

// Simple product card component for marketplace
function ProductCardV2({ product }: { product: any }) {
	const discount = product.discount;
	const finalPrice = discount ? product.price - (product.price * discount / 100) : product.price;

	return (
		<Link to={`/dashboard/marketplace/p/${product.id}`} className="block group">
			<div className="bg-white rounded-xl overflow-hidden border border-slate-200 shadow-sm hover:shadow-lg transition-all hover:-translate-y-1">
				<div className="relative aspect-square overflow-hidden bg-slate-100">
					{product.product_images?.[0] ? (
						<img
							src={product.product_images[0].file_path}
							alt={product.name}
							className="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
						/>
					) : (
						<div className="w-full h-full flex items-center justify-center text-slate-400">
							<ShoppingBag size={32} />
						</div>
					)}
					{discount > 0 && (
						<div className="absolute top-2 left-2 bg-red-500 text-white text-xs font-medium px-2 py-1 rounded-full">
							-{discount}%
						</div>
					)}
					{product.is_featured && (
						<div className="absolute top-2 right-2 bg-amber-500 text-white text-xs font-medium px-2 py-1 rounded-full flex items-center gap-1">
							<Sparkles size={10} /> Featured
						</div>
					)}
				</div>
				<div className="p-3 space-y-2">
					<h3 className="font-medium text-sm text-slate-800 line-clamp-2 group-hover:text-primary transition-colors">
						{product.name}
					</h3>
					<div className="flex items-center gap-2">
						<span className="text-lg font-bold text-primary">
							₦{finalPrice.toLocaleString()}
						</span>
						{discount > 0 && (
							<span className="text-xs text-slate-400 line-through">
								₦{product.price.toLocaleString()}
							</span>
						)}
					</div>
					<div className="flex items-center justify-between text-xs text-slate-500">
						<span className="flex items-center gap-1">
							<Star size={12} className="text-amber-400 fill-amber-400" />
							{product.rating || "New"}
						</span>
						<span className="flex items-center gap-1">
							<Eye size={12} />
							{product.views || 0}
						</span>
					</div>
				</div>
			</div>
		</Link>
	);
}
