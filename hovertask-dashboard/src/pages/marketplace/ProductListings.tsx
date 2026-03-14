import { useState } from "react";
import { Link } from "react-router";
import { Edit, Trash2, Eye, MoreVertical, Pause, Play, Star, Crown, ExternalLink, Copy, Check, BarChart3, Megaphone } from "lucide-react";
import { toast } from "sonner";

function ProductListings({ products, filter }: { products: any[]; filter: string }) {
  const [activeMenu, setActiveMenu] = useState<number | null>(null);

  let filteredProducts = products;

  if (filter === "active") {
    filteredProducts = products.filter((p) => p.is_active);
  } else if (filter === "inactive") {
    filteredProducts = products.filter((p) => !p.is_active);
  } else if (filter === "pending") {
    filteredProducts = products.filter((p) => p.status === "pending");
  } else if (filter === "review") {
    filteredProducts = products.filter((p) => p.status === "review");
  } else if (filter === "failed") {
    filteredProducts = products.filter((p) => p.status === "failed");
  }

  if (!filteredProducts.length) {
    return (
      <div className="text-center py-12 bg-slate-50 rounded-xl">
        <div className="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4">
          <Eye className="text-slate-400" size={24} />
        </div>
        <h3 className="font-medium text-slate-800 mb-1">No products found</h3>
        <p className="text-sm text-slate-500 mb-4">
          {filter !== "all" ? `No products match the "${filter}" filter` : "You haven't listed any products yet"}
        </p>
        <Link
          to="/marketplace/list-product?type=list-product"
          className="inline-flex items-center gap-2 px-4 py-2 bg-primary text-white rounded-lg text-sm font-medium hover:bg-primary/90 transition-colors"
        >
          <Star size={16} /> List Your First Product
        </Link>
      </div>
    );
  }

  return (
    <div className="space-y-4">
      {filteredProducts.map((p) => (
        <ProductListingCard 
          key={p.id} 
          product={p} 
          isMenuOpen={activeMenu === p.id}
          onMenuToggle={() => setActiveMenu(activeMenu === p.id ? null : p.id)}
        />
      ))}
    </div>
  );
}

function ProductListingCard({ product, isMenuOpen, onMenuToggle }: { product: any; isMenuOpen: boolean; onMenuToggle: () => void }) {
  const [copied, setCopied] = useState(false);
  
  const discount = product.discount;
  const finalPrice = discount ? product.price - (product.price * discount / 100) : product.price;
  
  const copyLink = () => {
    const url = `${window.location.origin}/marketplace/p/${product.id}`;
    navigator.clipboard.writeText(url);
    setCopied(true);
    toast.success("Link copied to clipboard!");
    setTimeout(() => setCopied(false), 2000);
  };

  return (
    <div className="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 p-4 bg-white border border-slate-200 rounded-xl hover:shadow-md transition-shadow">
      {/* Left: Image + Details */}
      <div className="flex items-start gap-4 flex-1 min-w-0">
        <div className="relative w-20 h-20 rounded-lg overflow-hidden bg-slate-100 shrink-0">
          {product.product_images && product.product_images.length > 0 ? (
            product.product_images[0].video_path ? (
              <video
                src={product.product_images[0].video_path}
                className="w-full h-full object-cover"
                controls
              />
            ) : (
              <img
                src={product.product_images[0].file_path}
                alt={product.name}
                className="w-full h-full object-cover"
              />
            )
          ) : (
            <div className="w-full h-full flex items-center justify-center text-slate-400">
              <Eye size={20} />
            </div>
          )}
          {product.is_featured && (
            <div className="absolute top-1 right-1">
              <Crown size={14} className="text-amber-500" />
            </div>
          )}
        </div>
        
        <div className="min-w-0 flex-1">
          <div className="flex items-center gap-2 mb-1">
            <h3 className="font-medium text-slate-800 truncate">{product.name}</h3>
            {product.is_featured && (
              <span className="px-2 py-0.5 text-xs bg-amber-100 text-amber-700 rounded-full flex items-center gap-1 shrink-0">
                <Crown size={10} /> Featured
              </span>
            )}
          </div>
          <div className="flex items-center gap-3 text-sm">
            <span className="font-semibold text-primary">
              ₦{finalPrice.toLocaleString()}
            </span>
            {discount > 0 && (
              <span className="text-slate-400 line-through">
                ₦{product.price.toLocaleString()}
              </span>
            )}
          </div>
          <div className="flex items-center gap-4 mt-2 text-xs text-slate-500">
            <span className="flex items-center gap-1">
              <Eye size={12} /> {product.views || 0} views
            </span>
            {product.resell_budget > 0 && (
              <span className="flex items-center gap-1 text-green-600">
                <Star size={12} className="fill-green-600" /> ₦{product.resell_budget.toLocaleString()} commission
              </span>
            )}
            <span className={`flex items-center gap-1 ${product.is_active ? 'text-green-600' : 'text-slate-400'}`}>
              {product.is_active ? <Play size={12} /> : <Pause size={12} />}
              {product.is_active ? "Active" : "Inactive"}
            </span>
          </div>
        </div>
      </div>

      {/* Right: Actions */}
      <div className="flex items-center gap-2 w-full sm:w-auto justify-end">
        <Link
          to={`/marketplace/p/${product.id}`}
          className="p-2 text-slate-500 hover:text-primary hover:bg-primary/5 rounded-lg transition-colors"
          title="View Listing"
        >
          <ExternalLink size={16} />
        </Link>
        
        <Link
          to={`/marketplace/performance?product=${product.id}`}
          className="p-2 text-slate-500 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors"
          title="View Analytics"
        >
          <BarChart3 size={16} />
        </Link>
        
        <button
          onClick={copyLink}
          className="p-2 text-slate-500 hover:text-green-600 hover:bg-green-50 rounded-lg transition-colors"
          title="Copy Link"
        >
          {copied ? <Check size={16} className="text-green-600" /> : <Copy size={16} />}
        </button>

        <div className="relative">
          <button
            onClick={onMenuToggle}
            className="p-2 text-slate-500 hover:bg-slate-100 rounded-lg transition-colors"
          >
            <MoreVertical size={16} />
          </button>
          
          {isMenuOpen && (
            <div className="absolute right-0 top-full mt-1 w-48 bg-white border border-slate-200 rounded-lg shadow-lg z-10 py-1">
              <Link
                to={`/marketplace/edit-product/${product.id}`}
                className="flex items-center gap-2 px-4 py-2 text-sm text-slate-700 hover:bg-slate-50"
              >
                <Edit size={14} /> Edit Listing
              </Link>
              <Link
                to={`/advertise?product=${product.id}`}
                className="flex items-center gap-2 px-4 py-2 text-sm text-slate-700 hover:bg-slate-50"
              >
                <Megaphone size={14} /> Run Ad Campaign
              </Link>
              <button className="w-full flex items-center gap-2 px-4 py-2 text-sm text-slate-700 hover:bg-slate-50">
                {product.is_featured ? (
                  <>
                    <Crown size={14} /> Manage Featured
                  </>
                ) : (
                  <>
                    <Star size={14} /> Upgrade to Featured
                  </>
                )}
              </button>
              <hr className="my-1" />
              <button className="w-full flex items-center gap-2 px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                <Trash2 size={14} /> Delete Listing
              </button>
            </div>
          )}
        </div>
      </div>
    </div>
  );
}

export default ProductListings;
