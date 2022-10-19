import React from 'react';
import { Link, BrowserRouter as Router } from 'react-router-dom';

export default function Header(){
    return (
        <>
            <Router>
                <nav className="bg-gray-800">
                    <div className="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                        <div className="flex h-16 justify-between">
                            <div className="flex">
                                <div className="hidden md:ml-6 md:flex md:items-center md:space-x-4">
                                    <Link to="/dashboard" className="text-white px-3 py-2 rounded-md text-sm font-medium">Dashboard</Link>
                                </div>
                            </div>

                            <div className="flex items-center">
                                <div className="hidden md:ml-4 md:flex md:flex-shrink-0 md:items-center">
                                    <div className="relative ml-3">
                                        <div>
                                            <button type="button" className="w-10 h-10 bg-gray-100 rounded-full flex justify-center items-center" aria-expanded="false" aria-haspopup="true">
                                                <span className="text-2xl">Initials</span>
                                            </button>
                                        </div>

                                        <div className="absolute left-0 right-2 z-10 mt-2 w-48 origin-top-left rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabIndex="-1">
                                            <a href="#" className="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabIndex="-1" id="user-menu-item-1">Settings</a>
                                            <a href="#" className="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabIndex="-1" id="user-menu-item-2">Sign out</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
            </Router>
        </>

    );
}