import React from 'react';
import { Link, useNavigate } from 'react-router-dom';
import axios from 'axios';
import './Navbar.css';

const Navbar = ({ token, setToken }) => {
  const navigate = useNavigate();

  const handleLogout = async () => {
    try {
      const token = sessionStorage.getItem('auth_token');
      await axios.post('http://127.0.0.1:8000/api/logout', {}, {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      });
      sessionStorage.removeItem('auth_token');
      setToken(null);
      navigate('/');
    } catch (error) {
      console.error('Failed to logout:', error);
    }
  };

  return (
    <nav className="navbar">
      <div className="navbar-logo">
        <h1>Cineplex</h1>
      </div>
      <div className="navbar-links">
        <Link to="/">Home</Link>
        {token ? (
          <>
          <Link to="/dodajProjekciju">Dodaj projekciju</Link>
            <Link to="/projekcije">Projekcije</Link>
            <button className="logout-btn" onClick={handleLogout}>Logout</button>
          </>
        ) : (
          <>
            <Link to="/login">Login</Link>
            <Link to="/register">Register</Link>
          </>
        )}
      </div>
    </nav>
  );
};

export default Navbar;
