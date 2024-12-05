import { useState, useEffect } from 'react';
import axios from 'axios';

const useProjekcije = () => {
  const [projekcije, setProjekcije] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  useEffect(() => {
    const fetchProjekcije = async () => {
      const token = sessionStorage.getItem('auth_token');

      try {
        const response = await axios.get('http://127.0.0.1:8000/api/projekcije', {
          headers: {
            Authorization: `Bearer ${token}`,   
          },
        });
        setProjekcije(response.data.data);  
        setLoading(false);
      } catch (err) {
        setError('Failed to fetch projekcije');
        setLoading(false);
      }
    };

    fetchProjekcije();
  }, []);

  return { projekcije, setProjekcije, loading, error };
};

export default useProjekcije;
