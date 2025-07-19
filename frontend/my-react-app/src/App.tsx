import { useState } from 'react'
import { Product } from './components/Product'
import { Cart } from './components/Cart'
import { ShoppingCart } from 'lucide-react'
import { AuthProvider } from './contexts/AuthContext.tsx'
import './App.css'

function App() {
  const [showCart, setShowCart] = useState(false)

  const products = [
    {
      id: 1,
      name: "Sản phẩm 1",
      price: 150000,
      description: "Mô tả sản phẩm 1",
      image: "https://via.placeholder.com/300x200"
    },
    {
      id: 2,
      name: "Sản phẩm 2", 
      price: 250000,
      description: "Mô tả sản phẩm 2",
      image: "https://via.placeholder.com/300x200"
    },
    {
      id: 3,
      name: "Sản phẩm 3",
      price: 350000,
      description: "Mô tả sản phẩm 3",
      image: "https://via.placeholder.com/300x200"
    }
  ]

  return (
    <AuthProvider>
      <div className="min-h-screen bg-gray-50">
        {/* Header */}
        <header className="bg-white shadow-sm border-b">
          <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div className="flex justify-between items-center h-16">
              <h1 className="text-xl font-bold text-gray-900">E-Commerce Store</h1>
              <button
                onClick={() => setShowCart(!showCart)}
                className="flex items-center space-x-2 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors"
              >
                <ShoppingCart size={20} />
                <span>Giỏ hàng</span>
              </button>
            </div>
          </div>
        </header>

        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
          {showCart ? (
            <Cart />
          ) : (
            <div>
              <h2 className="text-2xl font-bold mb-6">Sản phẩm</h2>
              <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                {products.map((product) => (
                  <Product key={product.id} {...product} />
                ))}
              </div>
            </div>
          )}
        </div>
      </div>
    </AuthProvider>
  )
}

export default App
