import React, { useState, useEffect } from 'react';
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import Navbar from './Navbar';
import Slider from './Slider';
import AdminProjekcije from './AdminProjekcije';
import LoginForm from './LoginForm';
import RegisterForm from './RegistrationForm';
import './App.css';

function App() {
  const [token, setToken] = useState(null);

 
  useEffect(() => {
    const savedToken = sessionStorage.getItem('auth_token');
    if (savedToken) {
      setToken(savedToken);
    }
  }, []);

  return (
    <Router>
      <div className="App">
        <Navbar token={token} setToken={setToken} />
        <Routes>
          <Route path="/" element={<Slider />} />
          <Route path="/projekcije" element={token ? <AdminProjekcije /> : <Slider />} />
          <Route path="/register" element={<RegisterForm />} />
          <Route path="/login" element={<LoginForm setToken={setToken} />} />
        </Routes>
      </div>
    </Router>
  );
}

export default App;
