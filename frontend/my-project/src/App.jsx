import { useState } from "react";
import reactLogo from "./assets/react.svg";
import viteLogo from "/vite.svg";
import "./App.css";
import { Home } from "./components/Home.jsx";
import Cart from "./components/cart/cart.jsx";
import { BrowserRouter, Routes, Route } from "react-router-dom";
export default function App() {
  return (
    // <div className="fixed top-0 left-0 right-0 z-50">
    <BrowserRouter>
      <Home />
      <div className="bg-[#E0F2F7]">
        <Routes>
          <Route path="/" element={<Cart />} />
        </Routes>
      </div>
    </BrowserRouter>
    // </div>
  );
}
