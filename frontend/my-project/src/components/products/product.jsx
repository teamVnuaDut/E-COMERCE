export default function Product() {
  return (
    <section className="relative bg-gray-100">
      <div className="max-w-7xl mx-auto px-4 py-20 flex flex-col md:flex-row items-center">
        <div className="md:w-1/2 space-y-6">
          <h2 className="text-4xl md:text-5xl font-extrabold">Khám phá ngay</h2>
          <p className="text-lg text-gray-600">
            Khám phá hương vị sữa tươi nguyên chất, tốt cho sức khỏe và tràn đầy
            năng lượng mỗi ngày!
          </p>
          <a
            href="#"
            className="inline-block bg-black text-white px-6 py-3 rounded hover:bg-gray-800 transition"
          >
            Tìm hiểu thêm
          </a>
        </div>

        <div className="md:w-1/2 mt-10 md:mt-0 flex justify-center">
          <img
            src="public/Gemini_Generated_Image_eqvjiheqvjiheqvj.png"
            alt="Sản phẩm sữa"
            className="max-w-md w-3/4 rounded shadow-lg"
          />
        </div>
      </div>
    </section>
  );
}
