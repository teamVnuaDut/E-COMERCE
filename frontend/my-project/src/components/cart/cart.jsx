import React, { useEffect, useState } from "react";
import axios from "axios";

function Cart() {
  const [data, setData] = useState([]);

  useEffect(() => {
    axios
      .get("/api/products")
      .then((res) => {
        console.log("API DATA:", res.data); // kiểm tra dữ liệu
        setData(res.data);
      })
      .catch((err) => console.log(err));
  }, []);

  return (
    <section className="py-10 mt-16">
      <div className="container mx-auto px-2 sm:px-4">
        <div className="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6 lg:gap-8">
          {Array.isArray(data) &&
            data.map((product) => (
              <div
                key={product.id}
                className="bg-white rounded-lg shadow hover:shadow-lg transition transform hover:-translate-y-1"
              >
                {/* Ảnh sản phẩm */}
                <div className="h-40 sm:h-48 overflow-hidden flex items-center justify-center bg-gray-100">
                  <img
                    src={product.img}
                    alt={product.name}
                    className="max-w-full max-h-full object-contain transition-transform duration-300 hover:scale-105"
                  />
                </div>

                {/* Nội dung sản phẩm */}
                <div className="p-3 sm:p-4">
                  <h3 className="font-semibold text-sm sm:text-lg mb-1 sm:mb-2 line-clamp-2">
                    {product.name}
                  </h3>
                  <p className="text-xs sm:text-sm text-gray-600 mb-2 sm:mb-4 line-clamp-2">
                    {product.desc}
                  </p>
                  <div className="flex justify-between items-center">
                    <span className="text-red-500 font-bold text-sm sm:text-base">
                      {product.price.toLocaleString("vi-VN")} ₫
                    </span>
                    <button className="bg-gray-800 text-white px-2 py-1 sm:px-3 sm:py-1 rounded text-xs sm:text-sm hover:bg-gray-900">
                      Add
                    </button>
                  </div>
                </div>
              </div>
            ))}
        </div>
      </div>
    </section>
  );
}

export default Cart;
