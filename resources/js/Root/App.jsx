import React from "react";
import {Routes, Route, BrowserRouter, Navigate} from "react-router-dom";
import Login from '../Pages/Auth/Login';
import Dashboard from '../Pages/Dashboard';
import Register from '../Pages/Auth/Register';
import MyMovies from '../Pages/MyMovies';
import { Provider } from 'react-redux';
import PageNotFound from "../Pages/PageNotFound";
import store from "../store";
import TokenService from "../services/token";

export default function App() {
    return (
        <Provider store={store}>
            <BrowserRouter>
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
            </BrowserRouter>
        </Provider>
    );
}

function RequireAuth({ children, redirectTo }) {
    let isAuthenticated = TokenService.getIsLoggedIn();
    return isAuthenticated ? children : <Navigate to={ redirectTo } />;
}
