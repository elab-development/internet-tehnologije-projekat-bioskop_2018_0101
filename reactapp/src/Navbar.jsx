import React from 'react';
import './Navbar.css';

const Navbar = () => {
  return (
    <nav className="navbar">
      <div className="navbar-logo">
        <h1>CINEPLEXX</h1>
      </div>
      <div className="navbar-links">
        <a href="movies">FILMOVI</a>
 
      </div>
      <div className="navbar-actions">
        
        <a href="login" className="login-icon">&#x1F464; PRIJAVI SE</a>
        <a href="register" className="register-btn">REGISTRUJ SE</a>
      </div>
    </nav>
  );
};

export default Navbar;
