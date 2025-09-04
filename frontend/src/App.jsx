import { useState } from "react";
import reactLogo from "./assets/react.svg";
import viteLogo from "/vite.svg";
import "./App.css";
import { Home } from "./components/Home.jsx";
import { Cart } from "./components/cart/cart.jsx";
export default function App() {
  return (
    <div className="fixed top-0 left-0 right-0 z-50">
      <Home />
      <Cart />
    </div>
  );
}
