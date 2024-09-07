import React from 'react';
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';  
import Navbar from './Navbar';
import Slider from './Slider';
import AdminProjekcije from './AdminProjekcije';
import LoginForm from './LoginForm';  
import './App.css';

function App() {
  return (
    <Router>
      <div className="App">
        <Navbar />
        <Routes>
         
          <Route path="/" element={<Slider />} />

        
          <Route path="/projekcije" element={<AdminProjekcije />} />

         
          <Route path="/login" element={<LoginForm />} />
          
         
        </Routes>
      </div>
    </Router>
  );
}

export default App;
