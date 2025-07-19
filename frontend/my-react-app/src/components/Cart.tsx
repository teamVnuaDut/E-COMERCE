import React from 'react';
import { useCartStore } from '../store/cartStore';
import { Trash2, Plus, Minus } from 'lucide-react';

export const Cart: React.FC = () => {
  const { items, removeItem, updateQuantity, getTotal, getItemCount } = useCartStore();

  if (items.length === 0) {
    return (
      <div className="p-4 text-center">
        <p className="text-gray-500">Giỏ hàng trống</p>
      </div>
    );
  }

  return (
    <div className="p-4">
      <h2 className="text-xl font-bold mb-4">Giỏ hàng ({getItemCount()} sản phẩm)</h2>
      
      <div className="space-y-4">
        {items.map((item) => (
          <div key={item.id} className="flex items-center justify-between p-4 border rounded-lg">
            <div className="flex items-center space-x-4">
              {item.image && (
                <img 
                  src={item.image} 
                  alt={item.name} 
                  className="w-16 h-16 object-cover rounded"
                />
              )}
              <div>
                <h3 className="font-semibold">{item.name}</h3>
                <p className="text-gray-600">{item.price.toLocaleString('vi-VN')} VNĐ</p>
              </div>
            </div>
            
            <div className="flex items-center space-x-2">
              <button
                onClick={() => updateQuantity(item.id, Math.max(0, item.quantity - 1))}
                className="p-1 rounded hover:bg-gray-100"
              >
                <Minus size={16} />
              </button>
              
              <span className="w-8 text-center">{item.quantity}</span>
              
              <button
                onClick={() => updateQuantity(item.id, item.quantity + 1)}
                className="p-1 rounded hover:bg-gray-100"
              >
                <Plus size={16} />
              </button>
              
              <button
                onClick={() => removeItem(item.id)}
                className="p-1 rounded hover:bg-red-100 text-red-600"
              >
                <Trash2 size={16} />
              </button>
            </div>
          </div>
        ))}
      </div>
      
      <div className="mt-6 pt-4 border-t">
        <div className="flex justify-between items-center mb-4">
          <span className="text-lg font-semibold">Tổng cộng:</span>
          <span className="text-xl font-bold">
            {getTotal().toLocaleString('vi-VN')} VNĐ
          </span>
        </div>
        
        <button className="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition-colors">
          Thanh toán
        </button>
      </div>
    </div>
  );
}; 