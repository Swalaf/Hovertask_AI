import { ShoppingBag, Search, Plus, Sparkles, BarChart3, Users, Megaphone, Star, Tag, ArrowRight, Zap, Crown } from "lucide-react";
import { useState } from "react";
import { Link } from "react-router";
import useProductCategories from "../../../hooks/useProductCategories";
import Loading from "../../../shared/components/Loading";
import EmptyMapErr from "../../../shared/components/EmptyMapErr";

export default function MarketplaceAside({
	omitCategories,
}: { omitCategories?: boolean }) {
	const [currentCategory, setCurrentCategory] = useState<string>("all");
	let categories = undefined;
	let refresh = undefined;

	if (!omitCategories) {
		({ categories, refresh } = useProductCategories());
	}

	return (
		<div className="space-y-6">
			{/* Quick Actions */}
			<div className="bg-gradient-to-br from-primary to-purple-600 rounded-2xl p-5 text-white space-y-4">
				<div className="flex items-center gap-2">
					<Sparkles className="text-amber-300" size={20} />
					<h3 className="font-semibold">Start Selling Today</h3>
				</div>
				<p className="text-sm text-white/80">
					List your products and reach thousands of buyers. Promote with ads or earn through referrals!
				</p>
				<div className="space-y-2">
					<Link
						to="/dashboard/marketplace/list-product?type=list-product"
						className="flex items-center justify-between bg-white text-primary px-4 py-2.5 rounded-xl font-medium text-sm hover:bg-white/90 transition-colors"
					>
						<span className="flex items-center gap-2">
							<Plus size={16} /> List Product
						</span>
						<ArrowRight size={16} />
					</Link>
					<Link
						to="/dashboard/marketplace/list-product?type=resell"
						className="flex items-center justify-between bg-white/20 text-white px-4 py-2.5 rounded-xl font-medium text-sm hover:bg-white/30 transition-colors"
					>
						<span className="flex items-center gap-2">
							<Users size={16} /> Resell & Earn
						</span>
						<ArrowRight size={16} />
					</Link>
				</div>
			</div>

			{/* Categories */}
			{!omitCategories && (
				<div className="bg-white rounded-2xl p-5 border border-slate-200 shadow-sm space-y-4">
					<div className="flex items-center justify-between">
						<h3 className="font-semibold text-slate-800 flex items-center gap-2">
							<Tag size={18} className="text-primary" />
							Categories
						</h3>
						<span className="text-xs text-slate-500">{categories?.length || 0} categories</span>
					</div>

					{/* Quick Category Links */}
					<div className="grid grid-cols-2 gap-2">
						<Link to="/dashboard/marketplace" onClick={() => setCurrentCategory("all")} className="text-xs text-center py-2 px-3 bg-slate-100 hover:bg-primary hover:text-white rounded-lg transition-colors">
							All Products
						</Link>
						<Link to="/dashboard/marketplace/c/featured" className="text-xs text-center py-2 px-3 bg-amber-50 hover:bg-amber-500 hover:text-white text-amber-700 rounded-lg transition-colors flex items-center justify-center gap-1">
							<Star size={12} className="fill-amber-500" /> Featured
						</Link>
						<Link to="/dashboard/marketplace/c/trending" className="text-xs text-center py-2 px-3 bg-green-50 hover:bg-green-500 hover:text-white text-green-700 rounded-lg transition-colors">
							Trending
						</Link>
						<Link to="/dashboard/marketplace/c/new" className="text-xs text-center py-2 px-3 bg-blue-50 hover:bg-blue-500 hover:text-white text-blue-700 rounded-lg transition-colors">
							New Arrivals
						</Link>
					</div>

					{categories ? (
						categories.length > 0 ? (
							<div className="space-y-2 max-h-64 overflow-y-auto">
								{categories.map((category) => (
									<Link
										key={category.key}
										to={`/dashboard/marketplace/c/${category.key}`}
										onClick={() => setCurrentCategory(category.key)}
										className={`flex items-center justify-between py-2 px-3 rounded-xl text-sm transition-colors ${currentCategory === category.key
											? "bg-primary text-white"
											: "bg-slate-50 hover:bg-slate-100 text-slate-700"
											}`}
									>
										<span>{category.label}</span>
										{currentCategory === category.key && <ArrowRight size={14} />}
									</Link>
								))}
							</div>
						) : (
							<EmptyMapErr
								onButtonClick={refresh}
								description="No categories available"
								buttonInnerText="Reload"
							/>
						)
					) : categories === null ? (
						<Loading />
					) : (
						<EmptyMapErr
							onButtonClick={refresh}
							description="Failed to load categories"
							buttonInnerText="Try Again"
						/>
					)}
				</div>
			)}

			{/* Seller Tools */}
			<div className="bg-white rounded-2xl p-5 border border-slate-200 shadow-sm space-y-4">
				<h3 className="font-semibold text-slate-800 flex items-center gap-2">
					<BarChart3 size={18} className="text-primary" />
					Seller Tools
				</h3>
				<div className="space-y-2">
					<Link to="/dashboard/marketplace/listings" className="flex items-center justify-between py-2 px-3 rounded-xl text-sm bg-slate-50 hover:bg-slate-100 text-slate-700 transition-colors">
						<span className="flex items-center gap-2">
							<ShoppingBag size={14} /> My Listings
						</span>
						<ArrowRight size={14} />
					</Link>
					<Link to="/dashboard/marketplace/performance" className="flex items-center justify-between py-2 px-3 rounded-xl text-sm bg-slate-50 hover:bg-slate-100 text-slate-700 transition-colors">
						<span className="flex items-center gap-2">
							<BarChart3 size={14} /> Performance
						</span>
						<ArrowRight size={14} />
					</Link>
					<Link to="/advertise" className="flex items-center justify-between py-2 px-3 rounded-xl text-sm bg-slate-50 hover:bg-slate-100 text-slate-700 transition-colors">
						<span className="flex items-center gap-2">
							<Megaphone size={14} /> Run Ad Campaign
						</span>
						<ArrowRight size={14} />
					</Link>
				</div>
			</div>

			{/* Earn as Reseller */}
			<div className="bg-gradient-to-br from-green-50 to-emerald-100 rounded-2xl p-5 border border-green-200 space-y-4">
				<div className="flex items-center gap-2">
					<Users className="text-green-600" size={20} />
					<h3 className="font-semibold text-green-800">Earn as a Reseller</h3>
				</div>
				<p className="text-sm text-green-700">
					Promote products and earn commission on every sale. No inventory needed!
				</p>
				<Link
					to="/earn/resell"
					className="flex items-center justify-center gap-2 bg-green-600 text-white px-4 py-2.5 rounded-xl font-medium text-sm hover:bg-green-700 transition-colors"
				>
					<Zap size={16} /> Start Reselling
				</Link>
			</div>

			{/* Featured Listing Upgrade */}
			<div className="bg-gradient-to-br from-amber-50 to-orange-100 rounded-2xl p-5 border border-amber-200 space-y-3">
				<div className="flex items-center gap-2">
					<Crown className="text-amber-600" size={20} />
					<h3 className="font-semibold text-amber-800">Go Featured</h3>
				</div>
				<p className="text-sm text-amber-700">
					Get your product in front of more buyers with priority placement and special badges!
				</p>
				<button className="w-full flex items-center justify-center gap-2 bg-amber-600 text-white px-4 py-2.5 rounded-xl font-medium text-sm hover:bg-amber-700 transition-colors">
					<Sparkles size={16} /> Upgrade to Featured
				</button>
			</div>
		</div>
	);
}
