import React, { createContext, useState, useEffect } from 'react';
import type { ReactNode } from 'react';
import { authAPI } from '../services/api';

interface User {
    id: number;
    name: string;
    email: string;
    email_verified_at?: string;
    created_at: string;
    updated_at: string;
}

interface AuthContextType {
    user: User | null;
    token: string | null;
    loading: boolean;
    isAuthenticated: boolean;
    register: (userData: Record<string, unknown>) => Promise<{ success: boolean; message?: string; errors?: unknown }>;
    login: (credentials: Record<string, unknown>) => Promise<{ success: boolean; message?: string }>;
    logout: () => Promise<void>;
    updateUser: (userData: User) => void;
    refreshToken: () => Promise<{ success: boolean }>;
}

export const AuthContext = createContext<AuthContextType | undefined>(undefined);

export const AuthProvider = ({ children }: { children: ReactNode }) => {
    const [user, setUser] = useState(null);
    const [token, setToken] = useState(localStorage.getItem('auth_token'));
    const [loading, setLoading] = useState(true);

    // Kiểm tra token khi component mount
    useEffect(() => {
        const initAuth = async () => {
            const savedToken = localStorage.getItem('auth_token');
            const savedUser = localStorage.getItem('user');

            if (savedToken && savedUser) {
                try {
                    setToken(savedToken);
                    setUser(JSON.parse(savedUser));
                    
                    // Verify token với server
                    const response = await authAPI.getUser();
                    if (response.data.success) {
                        setUser(response.data.data.user);
                        localStorage.setItem('user', JSON.stringify(response.data.data.user));
                    } else {
                        // Token không hợp lệ
                        logout();
                    }
                } catch (error) {
                    console.error('Auth initialization error:', error);
                    logout();
                }
            }
            setLoading(false);
        };

        initAuth();
    }, []);

    // Đăng ký
    const register = async (userData) => {
        try {
            const response = await authAPI.register(userData);
            if (response.data.success) {
                const { user, token } = response.data.data;
                setUser(user);
                setToken(token);
                localStorage.setItem('auth_token', token);
                localStorage.setItem('user', JSON.stringify(user));
                return { success: true };
            }
        } catch (error) {
            return {
                success: false,
                message: error.response?.data?.message || 'Registration failed',
                errors: error.response?.data?.errors
            };
        }
    };

    // Đăng nhập
    const login = async (credentials) => {
        try {
            const response = await authAPI.login(credentials);
            if (response.data.success) {
                const { user, token } = response.data.data;
                setUser(user);
                setToken(token);
                localStorage.setItem('auth_token', token);
                localStorage.setItem('user', JSON.stringify(user));
                return { success: true };
            }
        } catch (error) {
            return {
                success: false,
                message: error.response?.data?.message || 'Login failed'
            };
        }
    };

    // Đăng xuất
    const logout = async () => {
        try {
            if (token) {
                await authAPI.logout();
            }
        } catch (error) {
            console.error('Logout error:', error);
        } finally {
            setUser(null);
            setToken(null);
            localStorage.removeItem('auth_token');
            localStorage.removeItem('user');
        }
    };

    // Cập nhật thông tin user
    const updateUser = (userData) => {
        setUser(userData);
        localStorage.setItem('user', JSON.stringify(userData));
    };

    // Làm mới token
    const refreshToken = async () => {
        try {
            const response = await authAPI.refresh();
            if (response.data.success) {
                const { token } = response.data.data;
                setToken(token);
                localStorage.setItem('auth_token', token);
                return { success: true };
            }
        } catch (error) {
            console.error('Token refresh error:', error);
            logout();
            return { success: false };
        }
    };

    const value = {
        user,
        token,
        loading,
        isAuthenticated: !!user && !!token,
        register,
        login,
        logout,
        updateUser,
        refreshToken,
    };

    return (
        <AuthContext.Provider value={value}>
            {children}
        </AuthContext.Provider>
    );
}; 