import React from 'react';
import Navbar from './Navbar';
import Slider from './Slider';
import './App.css';
import AdminProjekcije from './AdminProjekcije';

function App() {
  return (
    <div className="App">
      <Navbar />
      <Slider />
      <AdminProjekcije />
    </div>
  );
}

export default App;
