import { BrowserRouter, Routes, Route } from "react-router-dom";
import { Home } from "./components/Home.jsx";
import Cart from "./components/Cart/Cart.jsx";
import Introduce from "./components/Introduce.jsx";
import Product from "./components/Cart/Product.jsx";
import Information from "./components/Cart/Information.jsx";

export default function App() {
  return (
    <BrowserRouter>
      <Home /> {/* luôn hiển thị, giống header */}

      <Routes>
        {/* ✅ Trang chủ có cả Introduce và Cart */}
        <Route
          path="/"
          element={
            <>
              <Introduce />
              <Cart />
            </>
          }
        />

        {/* ✅ Trang Product chỉ hiển thị Product */}
        <Route path="/Product" element={<Product />} />
        <Route path="/Product/:id" element={<Information />} />
      </Routes>
    </BrowserRouter>
  );
}
