import React from 'react';
import Header from '../components/Header';

export default function Auth({children}) {
    return (
        <>
            <Header />
            <main>
                { children }
            </main>
        </>
    )
}
