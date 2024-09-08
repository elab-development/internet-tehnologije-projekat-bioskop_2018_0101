import React, { useState } from 'react';
import useSale from './useSale';  // Korisnička kuka za dohvaćanje sala
import useFilmove from './useFilmove';  // Korisnička kuka za dohvaćanje filmova
import axios from 'axios';
import './DodajProjekciju.css';

const DodajProjekciju = () => {
  const { sale, loading: loadingSale, error: errorSale } = useSale();
  const { filmove, loading: loadingFilmovi, error: errorFilmovi } = useFilmove();
  const [projekcija, setProjekcija] = useState({
    film_id: '',
    sala_id: '',
    datum_vreme: '',
    cena: '',
    broj_slobodnih_mesta: '',
  });
  const [error, setError] = useState(null);
  const [successMessage, setSuccessMessage] = useState(null);

  const handleChange = (e) => {
    setProjekcija({
      ...projekcija,
      [e.target.name]: e.target.value,
    });
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    const token = sessionStorage.getItem('auth_token');

    try {
      const response = await axios.post('http://127.0.0.1:8000/api/projekcije', projekcija, {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      });
      setSuccessMessage('Projekcija uspešno kreirana!');
      setProjekcija({
        film_id: '',
        sala_id: '',
        datum_vreme: '',
        cena: '',
        broj_slobodnih_mesta: '',
      });
      setError(null);
    } catch (err) {
      setError('Greška prilikom kreiranja projekcije. Molimo proverite unos.');
    }
  };

  if (loadingSale || loadingFilmovi) return <p>Učitavanje...</p>;
  if (errorSale || errorFilmovi) return <p>Greška prilikom učitavanja podataka.</p>;

  return (
    <div className="dodaj-projekciju-container">
      <h1>Kreiraj Novu Projekciju</h1>

      {error && <p className="error-message">{error}</p>}
      {successMessage && <p className="success-message">{successMessage}</p>}

      <form onSubmit={handleSubmit} className="dodaj-projekciju-form">
        <div className="form-group">
          <label>Film:</label>
          <select name="film_id" value={projekcija.film_id} onChange={handleChange} required>
            <option value="">Izaberite film</option>
            {filmove.map((film) => (
              <option key={film.id} value={film.id}>
                {film.naziv}
              </option>
            ))}
          </select>
        </div>

        <div className="form-group">
          <label>Sala:</label>
          <select name="sala_id" value={projekcija.sala_id} onChange={handleChange} required>
            <option value="">Izaberite salu</option>
            {sale.map((sala) => (
              <option key={sala.id} value={sala.id}>
                {sala.naziv}
              </option>
            ))}
          </select>
        </div>

        <div className="form-group">
          <label>Datum i vreme:</label>
          <input
            type="datetime-local"
            name="datum_vreme"
            value={projekcija.datum_vreme}
            onChange={handleChange}
            required
          />
        </div>

        <div className="form-group">
          <label>Cena:</label>
          <input
            type="number"
            name="cena"
            value={projekcija.cena}
            onChange={handleChange}
            required
          />
        </div>

        <div className="form-group">
          <label>Broj slobodnih mesta:</label>
          <input
            type="number"
            name="broj_slobodnih_mesta"
            value={projekcija.broj_slobodnih_mesta}
            onChange={handleChange}
            required
          />
        </div>

        <button type="submit" className="action-button">Kreiraj Projekciju</button>
      </form>
    </div>
  );
};

export default DodajProjekciju;
