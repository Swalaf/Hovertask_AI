import { useEffect, useState } from "react";
import getAuthorization from "../../utils/getAuthorization";
import apiEndpointBaseURL from "../../utils/apiEndpointBaseURL";
import ProductStatusSummary from "./ProductStatusSummary";
import ProductListings from "./ProductListings";
import { Link } from "react-router";
import { ShoppingBag, Plus, BarChart3, DollarSign, Users, Eye, ArrowUpRight, ArrowDownRight, TrendingUp, Package, Star, Sparkles, Crown, Megaphone, ArrowRight, ExternalLink } from "lucide-react";

function ProductDashboard() {
  const [products, setProducts] = useState<any[]>([]);
  const [loading, setLoading] = useState(true);
  const [filter, setFilter] = useState<string>("all");
  const [stats, setStats] = useState({
    totalViews: 0,
    totalClicks: 0,
    totalSales: 0,
    totalEarnings: 0,
    activeListings: 0,
    featuredListings: 0,
  });

  useEffect(() => {
    const fetchProducts = async () => {
      try {
        const res = await fetch(`${apiEndpointBaseURL}/products/auth-user-product`, {
          headers: {
            "Content-Type": "application/json",
            Authorization: getAuthorization(),
          },
        });

        const data = await res.json();
        if (data.status) {
          setProducts(data.data);
          // Calculate stats
          const active = data.data.filter((p: any) => p.is_active).length;
          const featured = data.data.filter((p: any) => p.is_featured).length;
          setStats(prev => ({
            ...prev,
            activeListings: active,
            featuredListings: featured,
            totalViews: data.data.reduce((sum: number, p: any) => sum + (p.views || 0), 0),
          }));
        }
      } catch (err) {
        console.error("Failed to fetch products", err);
      } finally {
        setLoading(false);
      }
    };

    fetchProducts();
  }, []);

  if (loading) return (
    <div className="flex items-center justify-center h-64">
      <div className="animate-spin rounded-full h-8 w-8 border-b-2 border-primary"></div>
    </div>
  );

  return (
    <div className="space-y-6">
      {/* Header */}
      <div className="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
          <h2 className="text-xl font-bold text-slate-800">Marketplace Dashboard</h2>
          <p className="text-sm text-slate-500">Manage your listings and track performance</p>
        </div>
        <div className="flex gap-3">
          <Link
            to="/marketplace/performance"
            className="flex items-center gap-2 px-4 py-2 bg-white border border-slate-200 rounded-xl text-sm font-medium text-slate-700 hover:bg-slate-50 transition-colors"
          >
            <BarChart3 size={16} /> View Analytics
          </Link>
          <Link
            to="/marketplace/list-product?type=list-product"
            className="flex items-center gap-2 px-4 py-2 bg-primary text-white rounded-xl text-sm font-medium hover:bg-primary/90 transition-colors"
          >
            <Plus size={16} /> New Listing
          </Link>
        </div>
      </div>

      {/* Stats Grid */}
      <div className="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <StatCard 
          icon={<Eye className="text-blue-600" />}
          label="Total Views"
          value={stats.totalViews}
          change="+12%"
          positive
          color="bg-blue-50"
        />
        <StatCard 
          icon={<Users className="text-green-600" />}
          label="Active Listings"
          value={stats.activeListings}
          change={`of ${products.length}`}
          color="bg-green-50"
        />
        <StatCard 
          icon={<Star className="text-amber-600" />}
          label="Featured"
          value={stats.featuredListings}
          change={stats.featuredListings > 0 ? "Active" : "None"}
          color="bg-amber-50"
        />
        <StatCard 
          icon={<DollarSign className="text-purple-600" />}
          label="Est. Earnings"
          value={stats.totalEarnings}
          change="--"
          color="bg-purple-50"
        />
      </div>

      {/* Quick Actions */}
      <div className="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <QuickActionCard
          icon={<ShoppingBag className="text-blue-600" />}
          title="List New Product"
          description="Add a product to sell"
          link="/marketplace/list-product?type=list-product"
          color="from-blue-50 to-blue-100"
        />
        <QuickActionCard
          icon={<Crown className="text-amber-600" />}
          title="Go Featured"
          description="Boost your visibility"
          link="/marketplace/featured"
          color="from-amber-50 to-amber-100"
        />
        <QuickActionCard
          icon={<Megaphone className="text-purple-600" />}
          title="Run Ad Campaign"
          description="Promote your listings"
          link="/advertise"
          color="from-purple-50 to-purple-100"
        />
      </div>

      {/* Products Section */}
      <div className="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div className="p-4 sm:p-6 border-b border-slate-200">
          <h3 className="font-semibold text-lg text-slate-800">Your Listings</h3>
        </div>
        <div className="p-4 sm:p-6 space-y-6">
          {/* Summary with Filter */}
          <ProductStatusSummary products={products} filter={filter} setFilter={setFilter} />
          
          {/* Product Listings */}
          <ProductListings products={products} filter={filter} />
        </div>
      </div>

      {/* Performance Tips */}
      <div className="bg-gradient-to-r from-primary/5 to-purple-50 rounded-2xl p-6 border border-primary/10">
        <div className="flex items-start gap-4">
          <div className="p-3 bg-primary/10 rounded-xl">
            <TrendingUp className="text-primary" size={24} />
          </div>
          <div className="flex-1">
            <h4 className="font-semibold text-slate-800 mb-1">Tips to Boost Your Sales</h4>
            <ul className="text-sm text-slate-600 space-y-1">
              <li>• Add high-quality images to attract more buyers</li>
              <li>• Set competitive prices to stand out from competitors</li>
              <li>• Use the "Featured" option to appear at the top of listings</li>
              <li>• Run ad campaigns to reach more potential customers</li>
            </ul>
          </div>
          <Link to="/learn/seller-tips" className="text-primary text-sm font-medium hover:underline flex items-center gap-1">
            Learn More <ArrowRight size={14} />
          </Link>
        </div>
      </div>
    </div>
  );
}

function StatCard({ icon, label, value, change, positive, color }: { icon: React.ReactNode; label: string; value: number | string; change: string; positive?: boolean; color: string }) {
  return (
    <div className="bg-white rounded-xl p-4 border border-slate-200 shadow-sm">
      <div className="flex items-center justify-between mb-3">
        <div className={`p-2 rounded-lg ${color}`}>
          {icon}
        </div>
        <span className={`text-xs font-medium ${positive ? 'text-green-600' : 'text-slate-500'}`}>
          {change}
        </span>
      </div>
      <p className="text-2xl font-bold text-slate-800">{typeof value === 'number' ? value.toLocaleString() : value}</p>
      <p className="text-sm text-slate-500">{label}</p>
    </div>
  );
}

function QuickActionCard({ icon, title, description, link, color }: { icon: React.ReactNode; title: string; description: string; link: string; color: string }) {
  return (
    <Link to={link} className="block group">
      <div className={`bg-gradient-to-br ${color} rounded-xl p-4 border border-white shadow-sm hover:shadow-md transition-all hover:-translate-y-0.5`}>
        <div className="flex items-center gap-3">
          <div className="p-2 bg-white rounded-lg shadow-sm group-hover:scale-110 transition-transform">
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

export default ProductDashboard;
