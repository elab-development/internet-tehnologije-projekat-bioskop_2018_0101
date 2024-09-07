import { useState, useEffect } from 'react';
import axios from 'axios';

const useFilmove = () => {
  const [filmove, setFilmove] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  useEffect(() => {
    const fetchFilmove = async () => {
      const token = sessionStorage.getItem('auth_token');

      try {
        const response = await axios.get('http://127.0.0.1:8000/api/films', {
          headers: {
            Authorization: `Bearer ${token}`,  
          },
        });
        setFilmove(response.data.data);  
        setLoading(false);
      } catch (err) {
        setError('Failed to fetch filmove');
        setLoading(false);
      }
    };

    fetchFilmove();
  }, []);

  return { filmove, setFilmove, loading, error };
};

export default useFilmove;
