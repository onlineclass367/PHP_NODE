import React from 'react'
import {Outlet, useLocation} from 'react-router-dom'
import Header from './Header'
import Footer from './Footer'

const Layout = () => {
    const location = useLocation();
    return (
        <>
            <Header/>
                <Outlet/>
            {location.pathname !== '/chat' && <Footer/>}
        </>
      )
}

export default Layout