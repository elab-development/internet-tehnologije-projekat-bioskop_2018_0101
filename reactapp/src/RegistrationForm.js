import React, { useState } from 'react';
import axios from 'axios';
import { useNavigate } from 'react-router-dom';  
import InputField from './InputField'; // Uvozimo reusable komponentu
import './RegisterForm.css';  

const RegisterForm = () => {
  const [formData, setFormData] = useState({
    name: '',
    email: '',
    password: '',
    password_confirmation: ''
  });
  const [error, setError] = useState(null);
  const navigate = useNavigate();  

  const handleChange = (e) => {
    setFormData({
      ...formData,
      [e.target.name]: e.target.value
    });
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    try {
      const response = await axios.post('http://127.0.0.1:8000/api/register', formData);
      
      
      navigate('/login');
    } catch (err) {
      setError('Registration failed. Please check your input.');
    }
  };

  return (
    <div className="register-container">
      <div className="register-form-section">
        <h1>Register</h1>
        {error && <p className="error-message">{error}</p>}
        <form onSubmit={handleSubmit}>
          <InputField
            label="Name:"
            type="text"
            name="name"
            value={formData.name}
            onChange={handleChange}
            required
          />
          <InputField
            label="Email:"
            type="email"
            name="email"
            value={formData.email}
            onChange={handleChange}
            required
          />
          <InputField
            label="Password:"
            type="password"
            name="password"
            value={formData.password}
            onChange={handleChange}
            required
          />
          <InputField
            label="Confirm Password:"
            type="password"
            name="password_confirmation"
            value={formData.password_confirmation}
            onChange={handleChange}
            required
          />
          <button type="submit" className="action-button">
            Register
          </button>
        </form>
      </div>
    </div>
  );
};

export default RegisterForm;
