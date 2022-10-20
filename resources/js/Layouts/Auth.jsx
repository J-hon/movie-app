import React from 'react';
import Header from '../Components/Header';

export default function Auth({children}) {
    return (
        <>
            <Header />
            <div className="flex h-screen overflow-hidden">
                <main>
                    <div className="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-6xl mx-auto">
                        { children }
                    </div>
                </main>
            </div>
        </>
    )
}
