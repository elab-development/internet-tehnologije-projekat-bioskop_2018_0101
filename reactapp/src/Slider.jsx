import React, { useState, useEffect } from 'react';
import axios from 'axios';
import './Slider.css';

const Slider = () => {
  const images = [
    { src: 'https://s3proxygw.cineplexx.at/cms-live/asset/_default_upload_bucket/CBC_Thursday_4_1206x504_2.jpg', alt: 'Image 1' },
    { src: 'https://s3proxygw.cineplexx.at/cms-live/asset/_default_upload_bucket/Newsletter_1206x504_SRB_1.jpg', alt: 'Image 2' },
  ];

  const [current, setCurrent] = useState(0);
  const [movies, setMovies] = useState([]); // State za filmove
  const [loading, setLoading] = useState(true); // State za učitavanje
  const [error, setError] = useState(null); // State za greške
  const [searchTerm, setSearchTerm] = useState(''); // State za pretragu
  const [sortOrder, setSortOrder] = useState('desc'); // State za sortiranje

  // Funkcije za navigaciju slajderom
  const nextSlide = () => {
    setCurrent(current === images.length - 1 ? 0 : current + 1);
  };

  const prevSlide = () => {
    setCurrent(current === 0 ? images.length - 1 : current - 1);
  };

  // Učitaj filmove sa TMDb API-ja
  useEffect(() => {
    const fetchMovies = async () => {
      const API_KEY = '2fac0dc5c983b5bcf0fcd216df95eb2d';  
      const url = `https://api.themoviedb.org/3/movie/popular?api_key=${API_KEY}&language=en-US&page=1`;

      try {
        const response = await axios.get(url);
        setMovies(response.data.results); // Postavi podatke o filmovima
        setLoading(false); // Zaustavi učitavanje
      } catch (err) {
        setError('Nije moguće učitati filmove');
        setLoading(false); // Zaustavi učitavanje
      }
    };

    fetchMovies();
  }, []);

  // Funkcija za filtriranje filmova po nazivu
  const filteredMovies = movies
    .filter((movie) => movie.title.toLowerCase().includes(searchTerm.toLowerCase())) // Pretraga po nazivu
    .sort((a, b) => sortOrder === 'asc' ? a.vote_average - b.vote_average : b.vote_average - a.vote_average); // Sortiranje po oceni

  return (
    <div className="slider-container">
      {/* Slajder */}
      <div className="slider">
        <button className="left-arrow" onClick={prevSlide}>
          &#10094;
        </button>
        <div className="image-container">
          <img src={images[current].src} alt={images[current].alt} className="slider-image" />
        </div>
        <button className="right-arrow" onClick={nextSlide}>
          &#10095;
        </button>
      </div>

      {/* Pretraga i sortiranje */}
      <div className="filter-section">
        <input
          type="text"
          placeholder="Pretraži filmove..."
          value={searchTerm}
          onChange={(e) => setSearchTerm(e.target.value)}
          className="search-input"
        />
        <select onChange={(e) => setSortOrder(e.target.value)} className="sort-select">
          <option value="desc">Sortiraj po oceni: Najviša</option>
          <option value="asc">Sortiraj po oceni: Najniža</option>
        </select>
      </div>

      {/* Prikaz filmova */}
      <div className="movies-section">
        <h2>Popularni Filmovi</h2>
        {loading && <p>Učitavanje filmova...</p>}
        {error && <p>{error}</p>}
        <div className="movies-grid">
          {filteredMovies.map((movie) => (
            <div key={movie.id} className="movie-card">
              <img
                src={`https://image.tmdb.org/t/p/w500/${movie.poster_path}`}
                alt={movie.title}
                className="movie-poster"
              />
              <h3>{movie.title}</h3>
              <p>Ocena: {movie.vote_average}</p>
            </div>
          ))}
        </div>
      </div>
    </div>
  );
};

export default Slider;
