import { useState } from "react";
import { Register } from "./register.jsx";
import { Forgot_password } from "./forgot_password.jsx";
export function Login({ onClose }) {
  const [showLogin, setShowLogin] = useState(false);
  return (
    // Overlay chiếm full màn hình
    <div
      onClick={onClose}
      className="fixed inset-0 flex justify-center items-center bg-black/50 backdrop-blur-sm z-50"
    >
      {/* Hộp login */}
      <div
        onClick={(e) => e.stopPropagation()}
        className="relative w-[350px] bg-black rounded-2xl p-6 text-center shadow-lg"
      >
        <h2 className="text-white text-2xl mb-6">Đăng nhập</h2>

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
            placeholder="Nhập mật khẩu của bạn"
            className="w-full px-3 py-2 rounded-lg bg-white/10 text-white text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500"
          />
        </div>

        {/* Button */}
        <button className="w-full py-2 bg-[#1f2d52] text-white rounded-full font-bold hover:bg-[#293b6a] transition">
          Đăng nhập
        </button>

        {/* Register */}
        <div className="flex justify-between text-sm text-white mt-4">
          {!showLogin && (
            <a
              onClick={() => setShowLogin(true)}
              href="#"
              className="text-blue-400 hover:underline"
            >
              Đăng ký
            </a>
          )}
          {showLogin && <Register onClose={() => setShowLogin(false)} />}

          {!showLogin && (
            <a
              onClick={() => setShowLogin(true)}
              href="#"
              className="text-blue-400 hover:underline"
            >
              Quên mật khẩu
            </a>
          )}
          {showLogin && <Forgot_password onClose={() => setShowLogin(false)} />}
        </div>

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
