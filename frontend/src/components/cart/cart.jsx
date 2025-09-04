const productList = [
  {
    id: 1,
    name: "Tai Nghe Không Dây",
    desc: "Chất âm cao cấp với tính năng khử tiếng ồn chủ động.",
    price: "$99.99", // Có thể giữ $ hoặc đổi thành "2.299.000₫"
    img: "https://via.placeholder.com/300x200",
  },
  {
    id: 2,
    name: "Đồng Hồ Thông Minh",
    desc: "Theo dõi sức khỏe và kết nối mọi lúc mọi nơi.",
    price: "$149.99",
    img: "https://via.placeholder.com/300x200",
  },
  {
    id: 3,
    name: "Loa Bluetooth",
    desc: "Loa di động với pin lên đến 20 giờ sử dụng.",
    price: "$59.99",
    img: "https://via.placeholder.com/300x200",
  },
  {
    id: 4,
    name: "Đế Sạc Không Dây",
    desc: "Đế sạc nhanh tương thích với mọi thiết bị hỗ trợ chuẩn Qi.",
    price: "$29.99",
    img: "https://via.placeholder.com/300x200",
  },
  {
    id: 5,
    name: "Ốp Lưng Điện Thoại",
    desc: "Thiết kế mỏng nhẹ, bảo vệ tối ưu và hỗ trợ sạc không dây.",
    price: "$19.99",
    img: "https://via.placeholder.com/300x200",
  },
];
export function Cart() {
  return (
    <section className="py-16 h-[500px] overflow-y-scroll mt-16">
      <div className="container mx-auto px-4">
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
          {productList.map((product) => (
            <div
              key={product.id}
              className="bg-white rounded-lg shadow hover:shadow-lg transition transform hover:-translate-y-1"
            >
              <div className="h-48 overflow-hidden">
                <img
                  src={product.img}
                  alt={product.name}
                  className="w-full h-full object-cover hover:scale-105 transition-transform"
                />
              </div>
              <div className="p-4">
                <h3 className="font-semibold text-lg mb-2">{product.name}</h3>
                <p className="text-sm text-gray-600 mb-4">{product.desc}</p>
                <div className="flex justify-between items-center">
                  <span className="text-red-500 font-bold">
                    {product.price}
                  </span>
                  <button className="bg-gray-800 text-white px-3 py-1 rounded hover:bg-gray-900">
                    Add to Cart
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
