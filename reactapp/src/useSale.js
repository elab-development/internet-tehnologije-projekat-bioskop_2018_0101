import { useState, useEffect } from 'react';
import axios from 'axios';

const useSale = () => {
  const [sale, setSale] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  useEffect(() => {
    const fetchSale = async () => {
      const token = sessionStorage.getItem('auth_token');

      try {
        const response = await axios.get('http://127.0.0.1:8000/api/sale', {
          headers: {
            Authorization: `Bearer ${token}`,  
          },
        });
        setSale(response.data.data);  
        setLoading(false);
      } catch (err) {
        setError('Failed to fetch sale');
        setLoading(false);
      }
    };

    fetchSale();
  }, []);

  return { sale, setSale, loading, error };
};

export default useSale;
