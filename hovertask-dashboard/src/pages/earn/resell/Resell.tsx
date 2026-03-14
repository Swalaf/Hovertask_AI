import { ArrowLeft, Search, TrendingUp, DollarSign, Users, ArrowRight, Store } from "lucide-react";
import { Link } from "react-router";
import { useState } from "react";
import cn from "../../../utils/cn";
import ProductCard from "../../../shared/components/ProductCard";
import { useDisclosure } from "@heroui/react";
import useProducts from "../../../hooks/useProducts";
import Loading from "../../../shared/components/Loading";
import EmptyMapErr from "../../../shared/components/EmptyMapErr";
import useProductCategories from "../../../hooks/useProductCategories";

export default function ResellPage() {
	const { categories, refresh } = useProductCategories();
	const { products, reload } = useProducts();

	// FILTER STATES
	const [currentCategory, setCurrentCategory] = useState<string>("all");
	const [searchTerm, setSearchTerm] = useState<string>("");

	// FILTER LOGIC
	const filteredProducts = products
		? products
				.filter((p) => Number(p.resell_budget) >= 500)
				.filter((p =>
					currentCategory === "all"
						? true
						: String(p.category_id) === String(currentCategory)
				))
				.filter((p =>
					searchTerm.trim().length === 0
						? true
						: p.name.toLowerCase().includes(searchTerm.toLowerCase())
				))
		: [];

	return (
		<div className="space-y-6">
			{/* Hero Header */}
			<div 
				style={{ backgroundImage: "url('/images/Rectangle 39253.png')" }}
				className="bg-cover bg-center rounded-2xl p-8 text-white"
			>
				<div className="flex items-start gap-4 mb-6">
					<Link 
						to="/earn" 
						className="w-10 h-10 bg-white/20 backdrop-blur-sm rounded-lg flex items-center justify-center hover:bg-white/30 transition-colors"
					>
						<ArrowLeft className="w-5 h-5" />
					</Link>
					<div className="flex-1">
						<h1 className="text-2xl font-bold mb-2">
							Hot-selling Products to Maximize Your Earnings
						</h1>
						<p className="text-white/80">
							Get access to high-demand products and services at discounted rates, resell, and earn profits instantly!
						</p>
					</div>
				</div>

				{/* Search Bar */}
				<div className="max-w-xl">
					<div className="relative">
						<Search className="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-zinc-400" />
						<input
							type="text"
							placeholder="Search for products to resell..."
							value={searchTerm}
							onChange={(e) => setSearchTerm(e.target.value)}
							className="w-full pl-12 pr-4 py-3 rounded-xl border-0 focus:ring-2 focus:ring-primary/50 outline-none text-zinc-800"
						/>
					</div>
				</div>
			</div>

			{/* Quick Stats */}
			<div className="grid grid-cols-2 md:grid-cols-4 gap-4">
				{[
					{ label: "Total Sales", value: "₦125,400", icon: DollarSign, color: "bg-green-500" },
					{ label: "Products", value: "48", icon: Store, color: "bg-blue-500" },
					{ label: "Active Resellers", value: "234", icon: Users, color: "bg-purple-500" },
					{ label: "Profit Margin", value: "15-40%", icon: TrendingUp, color: "bg-amber-500" },
				].map((stat, index) => (
					<div key={index} className="bg-white rounded-xl p-4 border border-zinc-100">
						<div className={cn("w-10 h-10 rounded-lg flex items-center justify-center mb-3", stat.color)}>
							<stat.icon className="w-5 h-5 text-white" />
						</div>
						<p className="text-xl font-bold text-zinc-800">{stat.value}</p>
						<p className="text-xs text-zinc-500">{stat.label}</p>
					</div>
				))}
			</div>

			{/* How It Works */}
			<div className="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl p-6 border border-blue-100">
				<h2 className="text-lg font-semibold text-zinc-800 mb-6">How Reselling Works</h2>
				<div className="grid md:grid-cols-3 gap-6">
					{[
						{ step: "1", title: "Choose a Product", desc: "Browse our catalog and select products with high profit margins" },
						{ step: "2", title: "Share Your Link", desc: "Get your unique reseller link and share with your network" },
						{ step: "3", title: "Earn Commission", desc: "Receive instant payment when someone purchases through your link" },
					].map((item, index) => (
						<div key={index} className="text-center">
							<div className="w-12 h-12 bg-primary text-white rounded-full flex items-center justify-center text-xl font-bold mx-auto mb-4">
								{item.step}
							</div>
							<h3 className="font-semibold text-zinc-800 mb-2">{item.title}</h3>
							<p className="text-sm text-zinc-500">{item.desc}</p>
						</div>
					))}
				</div>
			</div>

			{/* Categories */}
			<div className="bg-white rounded-xl p-5 border border-zinc-100">
				<div className="flex items-center justify-between mb-4">
					<h2 className="font-semibold text-zinc-800">Categories</h2>
					<span className="text-xs text-zinc-500">{filteredProducts.length} products found</span>
				</div>
				<div className="flex gap-2 flex-wrap">
					<button
						type="button"
						onClick={() => setCurrentCategory("all")}
						className={cn(
							"py-2 px-4 rounded-lg text-sm font-medium transition-all",
							currentCategory === "all"
								? "bg-primary text-white"
								: "bg-zinc-100 text-zinc-600 hover:bg-zinc-200"
						)}
					>
						All
					</button>
					{categories ? (
						categories
							.filter((cat) => cat.key !== "all")
							.map((category) => (
								<button
									type="button"
									onClick={() => setCurrentCategory(String(category.key))}
									className={cn(
										"py-2 px-4 rounded-lg text-sm font-medium transition-all capitalize",
										String(category.key) === currentCategory
											? "bg-primary text-white"
											: "bg-zinc-100 text-zinc-600 hover:bg-zinc-200"
									)}
									key={category.key}
								>
									{category.label}
								</button>
							))
					) : categories === null ? (
						<Loading />
					) : (
						<EmptyMapErr
							onButtonClick={refresh}
							description="Failed to load product categories."
							buttonInnerText="Try Again"
						/>
					)}
				</div>
			</div>

			{/* Products Grid */}
			<div className="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
				{filteredProducts.length > 0 ? (
					filteredProducts.map((product) => (
						<ProductCard key={product.id} {...product} />
					))
				) : (
					<div className="col-span-full bg-white rounded-xl p-8 border border-zinc-100 text-center">
						<div className="w-16 h-16 bg-zinc-100 rounded-full flex items-center justify-center mx-auto mb-4">
							<Store className="w-8 h-8 text-zinc-400" />
						</div>
						<h3 className="text-lg font-semibold text-zinc-800 mb-2">No Products Found</h3>
						<p className="text-zinc-500 text-sm mb-4">
							Try adjusting your search or filter to find products.
						</p>
						<button 
							onClick={() => { setSearchTerm(""); setCurrentCategory("all"); }}
							className="inline-flex items-center gap-2 text-primary font-medium hover:underline"
						>
							Clear filters <ArrowRight size={16} />
						</button>
					</div>
				)}
			</div>
		</div>
	);
}
