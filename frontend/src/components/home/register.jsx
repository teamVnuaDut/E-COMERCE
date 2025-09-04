export function Register({ onClose }) {
  return (
    <div
      onClick={onClose}
      className="fixed inset-0 flex justify-center items-center bg-black/50 backdrop-blur-sm z-50"
    >
      <div
        onClick={(e) => e.stopPropagation()}
        className="relative w-[350px] bg-black rounded-2xl p-6 text-center shadow-lg"
      >
        <h2 className="text-white text-2xl mb-6">Đăng ký</h2>

        {/* Username */}
        <div className="mb-4 text-left">
          <label className="block text-sm text-gray-400 mb-1">Tài khoản</label>
          <input
            type="text"
            placeholder="Nhập email của bạn"
            className="w-full px-3 py-2 rounded-lg bg-white/10 text-white text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500"
          />
        </div>

        {/* Password */}
        <div className="mb-4 text-left">
          <label className="block text-sm text-gray-400 mb-1">Mật khẩu</label>
          <input
            type="password"
            placeholder="Nhập mật khẩu"
            className="w-full px-3 py-2 rounded-lg bg-white/10 text-white text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500"
          />
        </div>

        {/* Confirm Password */}
        <div className="mb-4 text-left">
          <label className="block text-sm text-gray-400 mb-1">
            Xác nhận mật khẩu
          </label>
          <input
            type="password"
            placeholder="Nhập lại mật khẩu"
            className="w-full px-3 py-2 rounded-lg bg-white/10 text-white text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500"
          />
        </div>

        {/* Button */}
        <button className="w-full py-2 bg-[#1f2d52] text-white rounded-full font-bold hover:bg-[#293b6a] transition">
          Đăng ký
        </button>

        {/* Nút Đóng */}
        <button
          onClick={onClose}
          className="mt-4 w-full py-2 text-sm text-gray-300 hover:text-red-400 transition"
        >
          Đóng
        </button>
      </div>
    </div>
  );
}
