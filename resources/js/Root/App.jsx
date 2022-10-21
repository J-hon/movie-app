import React from "react";
import {Routes, Route, BrowserRouter, Navigate} from "react-router-dom";
import Login from '../Pages/Auth/Login';
import Dashboard from '../Pages/Dashboard';
import Register from '../Pages/Auth/Register';
import MyMovies from '../Pages/MyMovies';
import PageNotFound from "../Pages/PageNotFound";
import TokenService from "../services/token";
import {ToastContainer} from "react-toastify";

export default function App() {
    return (
        <>
            <Routes>
                <Route path="/" index element={<Login />} />
                <Route path="/register" element={<Register />} />
                <Route path="*" element={<PageNotFound />} />
                <Route
                    path="/dashboard"
                    element={
                        <RequireAuth redirectTo="/">
                            <Dashboard />
                        </RequireAuth>
                    }
                />
                <Route
                    path="/my-movies"
                    element={
                        <RequireAuth redirectTo="/">
                            <MyMovies />
                        </RequireAuth>
                    }
                />
            </Routes>
            <ToastContainer
                position="bottom-right"
                autoClose={5000}
                hideProgressBar={false}
                newestOnTop={false}
                closeOnClick
                rtl={false}
                pauseOnFocusLoss
                draggable
                pauseOnHover
                theme="light"
            />
        </>
    );
}

function RequireAuth({ children, redirectTo }) {
    let isAuthenticated = TokenService.getIsLoggedIn();
    return isAuthenticated ? children : <Navigate to={ redirectTo } />;
}
