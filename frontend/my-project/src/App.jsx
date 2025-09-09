import { useState } from "react";
import reactLogo from "./assets/react.svg";
import viteLogo from "/vite.svg";
import "./App.css";
import { Home } from "./components/Home.jsx";
import Cart from "./components/cart/cart.jsx";
import { BrowserRouter, Routes, Route } from "react-router-dom";
import Product from "./components/products/product.jsx";
export default function App() {
  return (
    <BrowserRouter>
      <Home />
      <div className="bg-[#E0F2F7]">
        <Product />
        <Routes>
          <Route path="/" element={<Cart />} />
        </Routes>
      </div>
    </BrowserRouter>
  );
}
