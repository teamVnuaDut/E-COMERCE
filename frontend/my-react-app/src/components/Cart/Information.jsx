import { useState } from "react";
import { useLocation } from "react-router-dom";

export default function ProductDetail() {
  const [qty, setQty] = useState(1);
  const maxLimit = 10;
  const location = useLocation();
  const product = location.state?.product;

  const dec = () => {
    if (qty > 1) setQty(qty - 1);
  };

  const inc = () => {
    if (qty < maxLimit) setQty(qty + 1);
  };

  const addToCartAction = () => {
    if (qty > maxLimit) {
      alert(`Max order limit is ${maxLimit}`);
      return;
    }
    alert(`Added ${qty} item(s) of ${product?.name} to cart`);
  };

  if (!product) return <div>Không thấy sản phẩm này</div>;

  // ✅ Tính giá tổng theo số lượng
  const totalPrice = (product.price || 0) * qty;
  const totalSalePrice = product.sale_price ? product.sale_price * qty : null;

  return (
    <main className="max-w-6xl mx-auto p-6 lg:p-10 bg-gray-50 text-gray-800">
      {/* Breadcrumb / Header */}
      <nav className="text-sm text-gray-500 mb-6" aria-label="Breadcrumb">
        <ol className="flex items-center gap-2">
          <li>
            <a href="#" className="hover:underline">
              Back to products
            </a>
          </li>
          <li>•</li>
          <li className="text-gray-700">{product.name}</li>
        </ol>
      </nav>

      <section className="grid grid-cols-1 lg:grid-cols-2 gap-8 items-start">
        {/* LEFT: Images */}
        <div className="space-y-4">
          <div className="rounded-xl overflow-hidden bg-white p-6 shadow-sm">
            <img
              src={product.image || "https://via.placeholder.com/400"}
              alt={product.name}
              className="w-full h-96 object-cover rounded-lg"
            />
          </div>
        </div>

        {/* RIGHT: Product Info */}
        <aside className="sticky top-6">
          <div className="bg-white rounded-xl shadow p-6 lg:p-8">
            <h1 className="text-2xl lg:text-3xl font-extrabold leading-tight">
              {product.name}{" "}
              <span className="text-base font-medium text-gray-500">
                • {product.weight || "1.00 kg"}
              </span>
            </h1>

            {/* ✅ Hiển thị giá theo số lượng */}
            <div className="mt-4 flex items-end gap-4">
              <div>
                <div className="text-3xl lg:text-4xl font-extrabold">
                  {totalPrice.toLocaleString("vi-VN")} ₫
                </div>
                {totalSalePrice && (
                  <div className="text-sm text-gray-400 line-through">
                    {totalSalePrice.toLocaleString("vi-VN")} ₫
                  </div>
                )}
              </div>

              <button
                onClick={addToCartAction}
                className="ml-auto flex-1 lg:flex-none bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg px-6 py-3 shadow"
              >
                🛒 Add to Cart
              </button>
            </div>

            {/* Quantity */}
            <div className="mt-5 flex items-center gap-3">
              <button onClick={dec} className="px-4 py-2 bg-gray-200 rounded">
                −
              </button>
              <input
                type="number"
                value={qty}
                readOnly
                className="w-16 text-center"
              />
              <button onClick={inc} className="px-4 py-2 bg-gray-200 rounded">
                +
              </button>
            </div>
          </div>
        </aside>
      </section>
    </main>
  );
}
