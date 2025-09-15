import React, { useEffect, useState } from "react";
import axios from "axios";

export default function ProductGrid() {
  const [data, setData] = useState([]);

  useEffect(() => {
    axios
      .get("/api/product") // gọi API backend
      .then((res) => {
        console.log("API DATA:", res.data);
        setData(res.data);
      })
      .catch((err) => console.log(err));
  }, []);

  return (
    <div className="mt-10">
      <div className="text-center p-10">
        <h1 className="font-bold text-4xl mb-4">
          Sản phẩm nổi bật
        </h1>
      </div>

      {/* ✅ Grid Section */}
      <section
        id="Projects"
        className="w-fit mx-auto grid grid-cols-1 lg:grid-cols-3 md:grid-cols-2 justify-items-center gap-y-20 gap-x-14 mt-10 mb-5"
      >
        {Array.isArray(data) &&
          data.map((product) => (
            <div
              key={product.id}
              className="w-72 bg-white shadow-md rounded-xl duration-500 hover:scale-105 hover:shadow-xl"
            >
              <a href="#">
                <img
                  src={product.image}
                  alt={product.name}
                  className="h-80 w-72 object-cover rounded-t-xl"
                />
                <div className="px-4 py-3 w-72">
                  <span className="text-gray-400 mr-3 uppercase text-xs">
                    {product.brand}
                  </span>
                  <p className="text-lg font-bold text-black truncate capitalize">
                    {product.name}
                  </p>
                  <div className="flex items-center">
                    <p className="text-lg font-semibold text-black cursor-auto my-3">
                      ${product.price}
                    </p>
                    {product.old_price && (
                      <del>
                        <p className="text-sm text-gray-600 cursor-auto ml-2">
                          ${product.old_price}
                        </p>
                      </del>
                    )}
                    <div className="ml-auto">
                      {/* 🛍️ Icon add to cart */}
                      <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="20"
                        height="20"
                        fill="currentColor"
                        className="bi bi-bag-plus"
                        viewBox="0 0 16 16"
                      >
                        <path
                          fillRule="evenodd"
                          d="M8 7.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V12a.5.5 0 0 1-1 0v-1.5H6a.5.5 0 0 1 0-1h1.5V8a.5.5 0 0 1 .5-.5z"
                        />
                        <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z" />
                      </svg>
                    </div>
                  </div>
                </div>
              </a>
            </div>
          ))}
      </section>
    </div>
  );
}
