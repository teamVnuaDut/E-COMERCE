import React from 'react';
import { useCartStore } from '../store/cartStore';
import { ShoppingCart } from 'lucide-react';

interface ProductProps {
  id: number;
  name: string;
  price: number;
  image?: string;
  description?: string;
}

export const Product: React.FC<ProductProps> = ({ id, name, price, image, description }) => {
  const { addItem } = useCartStore();

  const handleAddToCart = () => {
    addItem({
      id,
      name,
      price,
      image,
    });
  };

  return (
    <div className="border rounded-lg p-4 hover:shadow-lg transition-shadow">
      {image && (
        <img 
          src={image} 
          alt={name} 
          className="w-full h-48 object-cover rounded-lg mb-4"
        />
      )}
      
      <h3 className="text-lg font-semibold mb-2">{name}</h3>
      
      {description && (
        <p className="text-gray-600 text-sm mb-3">{description}</p>
      )}
      
      <div className="flex items-center justify-between">
        <span className="text-xl font-bold text-blue-600">
          {price.toLocaleString('vi-VN')} VNĐ
        </span>
        
        <button
          onClick={handleAddToCart}
          className="flex items-center space-x-2 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors"
        >
          <ShoppingCart size={16} />
          <span>Thêm vào giỏ</span>
        </button>
      </div>
    </div>
  );
}; 