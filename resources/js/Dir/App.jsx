import React from "react";
import { BrowserRouter as Router, Routes, Route } from "react-router-dom";
import Login from '../Pages/Auth/Login';
import Dashboard from '../Pages/Dashboard';
import Register from '../Pages/Auth/Register';
import MyMovies from '../Pages/MyMovies';
import Auth from '../Layouts/Auth';

export default function App() {
    return (
        <>
            <Auth>
                <Router>
                    <Routes>
                        <Route exact path="/" component={<Login/>} />
                        <Route path="/dashboard" component={<Dashboard/>} />
                        <Route exact path="/register" component={<Register/>} />
                        <Route path="/my-movies" component={<MyMovies/>} />
                    </Routes>
                </Router>
            </Auth>
        </>
    );
};
