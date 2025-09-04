import { useState, useRef, useEffect } from "react";
import { Login } from "./home/login.jsx";

export function Home() {
  const [isFocused, setIsFocused] = useState(false);
  const [showLogin, setShowLogin] = useState(false);
  const [open, setOpen] = useState(false);
  const menuRef = useRef(null);
  const searchRef = useRef(null);
  const Ref = useRef(null);

  // Xử lý hover vào dropdown
  const handleMouseEnter = () => {
    clearTimeout(Ref.current);
    setOpen(true);
  };

  // Xử lý rời chuột khỏi dropdown
  const handleMouseLeave = () => {
    Ref.current = setTimeout(() => {
      setOpen(false);
    }, 100); // Độ trễ 100ms trước khi đóng
  };

  // Xử lý click ra ngoài dropdown thì đóng lại
  useEffect(() => {
    const handleClickOutside = (event) => {
      if (menuRef.current && !menuRef.current.contains(event.target)) {
        setOpen(false);
      }

      // Thu nhỏ ô search nếu không có nội dung
      if (
        searchRef.current &&
        !searchRef.current.contains(event.target) &&
        searchRef.current.value === ""
      ) {
        setIsFocused(false);
      }
    };

    document.addEventListener("mousedown", handleClickOutside);
    return () => document.removeEventListener("mousedown", handleClickOutside);
  }, []);

  const handleProductClick = () => {
    setOpen(false);
  };

  return (
    <header className="fixed left-0 right-0 h-16 bg-gray-300 dark:bg-gray-800 flex items-center px-4 md:px-8 z-50 shadow-md">
      {/* Logo */}
      <div className="w-16 h-16 md:w-14 md:h-14 flex-shrink-0">
        <img
          src="public/ChatGPT Image 22_17_45 28 thg 8, 2025.png"
          alt="logo"
          className="w-full h-full max-w-16 max-h-16 min-w-12 min-h-12 object-contain cursor-pointer transition-transform hover:scale-105"
          onClick={() => (window.location.href = "/")}
        />
      </div>
      {/* Nút Trang chủ */}
      <button
        onClick={() => (window.location.href = "/")}
        className="ml-4 md:ml-6 lg:ml-10 px-3 py-1 text-sm md:text-base hover:border-b-2 border-blue-500 dark:border-blue-400 rounded-b-md transition-all"
      >
        Trang chủ
      </button>
      {/* Sản phẩm - Dropdown (hover) */}
      <div
        className="relative inline-block"
        ref={menuRef}
        onMouseEnter={handleMouseEnter}
        onMouseLeave={handleMouseLeave}
      >
        <button className="px-3 py-1 text-sm md:text-base hover:border-b-2 border-blue-500 dark:border-blue-400 rounded-b-md flex items-center transition-all">
          Sản phẩm
          <svg
            className={`fill-current h-4 w-4 ml-1 transition-transform ${
              open ? "rotate-180" : ""
            }`}
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 20 20"
          >
            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
          </svg>
        </button>
        {open && (
          <ul
            className="absolute left-0 top-full mt-1 bg-white dark:bg-gray-700 rounded-md shadow-lg z-50 py-1 min-w-[160px]"
            onMouseEnter={handleMouseEnter}
            onMouseLeave={handleMouseLeave}
          >
            <li>
              <a
                href="#"
                className="px-4 py-2 block text-gray-800 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors"
                onClick={handleProductClick}
              >
                Sữa tươi
              </a>
            </li>
            <li>
              <a
                href="#"
                className="px-4 py-2 block text-gray-800 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors"
                onClick={handleProductClick}
              >
                Sữa không đường
              </a>
            </li>
            <li>
              <a
                href="#"
                className="px-4 py-2 block text-gray-800 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors"
                onClick={handleProductClick}
              >
                Sữa đặc
              </a>
            </li>
          </ul>
        )}
      </div>
      {/* Hỗ trợ */}
      <button className="px-3 py-1 text-sm md:text-base hover:border-b-2 border-blue-500 dark:border-blue-400 rounded-b-md transition-all">
        Hỗ trợ
      </button>
      {/* Giới thiệu */}
      <button className="px-3 py-1 text-sm md:text-base hover:border-b-2 border-blue-500 dark:border-blue-400 rounded-b-md transition-all">
        Giới thiệu
      </button>
      {/* Ô Search */}
      <div className="relative ml-auto mr-4">
        <input
          type="text"
          ref={searchRef}
          className={`
            bg-white dark:bg-gray-600 h-9 md:h-10 px-4 pr-9 rounded-full text-sm
            focus:outline-none transition-all duration-300 ease-in-out
            border border-transparent focus:border-blue-500
            ${isFocused ? "w-40 md:w-56" : "w-28 md:w-32"}
          `}
          placeholder="Search..."
          onFocus={() => setIsFocused(true)}
        />
        <button
          type="submit"
          className="absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-500 dark:text-gray-400"
        >
          <svg
            className="h-4 w-4 fill-current"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 20 20"
          >
            <path d="M12.9 14.32a8 8 0 1 1 1.41-1.41l5.35 5.33-1.42 1.42-5.33-5.34zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z" />
          </svg>
        </button>
      </div>
      {/* User */}
      <div className="flex items-center">
        {!showLogin && (
          <button
            onClick={() => setShowLogin(true)}
            className="rounded-full p-2 hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors"
            aria-label="User login"
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
              strokeWidth={1.5}
              stroke="currentColor"
              className="w-5 h-5 md:w-6 md:h-6"
            >
              <path
                strokeLinecap="round"
                strokeLinejoin="round"
                d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"
              />
            </svg>
          </button>
        )}
        {showLogin && <Login onClose={() => setShowLogin(false)} />}
      </div>
    </header>
  );
}
