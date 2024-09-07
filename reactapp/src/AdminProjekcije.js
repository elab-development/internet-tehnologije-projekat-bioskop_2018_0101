import React from 'react';
import useProjekcije from './useProjekcije';
import './AdminProjekcije.css';

const AdminProjekcije = () => {
  const { projekcije, loading, error } = useProjekcije();

  if (loading) return <p>Loading projekcije...</p>;
  if (error) return <p>{error}</p>;

  return (
    <div className="admin-projekcije-container">
      <h1>Projekcije</h1>
      <table className="projekcije-table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Film</th>
            <th>Sala</th>
            <th>Datum i vreme</th>
            <th>Cena</th>
            <th>Broj slobodnih mesta</th>
          </tr>
        </thead>
        <tbody>
          {projekcije.map((projekcija) => (
            <tr key={projekcija.id}>
              <td>{projekcija.id}</td>
              <td>{projekcija.film.naziv}</td>
              <td>{projekcija.sala.naziv}</td>
              <td>{projekcija.datum_vreme}</td>
              <td>{projekcija.cena} RSD</td>
              <td>{projekcija.broj_slobodnih_mesta}</td>
            </tr>
          ))}
        </tbody>
      </table>
    </div>
  );
};

export default AdminProjekcije;
