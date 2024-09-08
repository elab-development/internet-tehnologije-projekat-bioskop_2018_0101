import React, { useState } from 'react';
import useProjekcije from './useProjekcije';
import ProjekcijaRow from './ProjekcijaRow'; // Uvozimo novu komponentu
import './AdminProjekcije.css';

const AdminProjekcije = () => {
  const { projekcije, loading, error } = useProjekcije();
  const [currentPage, setCurrentPage] = useState(1);
  const [itemsPerPage] = useState(5); // Koliko projekcija prikazati po stranici
  const [searchTerm, setSearchTerm] = useState(""); // State za pretragu

  const handleSearch = (event) => {
    setSearchTerm(event.target.value);
    setCurrentPage(1); // Resetujemo paginaciju kada pretražujemo
  };

  // Filtriranje projekcija na osnovu pretrage (po nazivu filma ili sale)
  const filteredProjekcije = projekcije.filter((projekcija) => {
    return (
      projekcija.film.naziv.toLowerCase().includes(searchTerm.toLowerCase()) ||
      projekcija.sala.naziv.toLowerCase().includes(searchTerm.toLowerCase())
    );
  });

  // Paginacija: izračunavanje trenutne stranice
  const indexOfLastItem = currentPage * itemsPerPage;
  const indexOfFirstItem = indexOfLastItem - itemsPerPage;
  const currentProjekcije = filteredProjekcije.slice(indexOfFirstItem, indexOfLastItem);

  const totalPages = Math.ceil(filteredProjekcije.length / itemsPerPage);

  const handleNextPage = () => {
    if (currentPage < totalPages) {
      setCurrentPage(currentPage + 1);
    }
  };

  const handlePreviousPage = () => {
    if (currentPage > 1) {
      setCurrentPage(currentPage - 1);
    }
  };

  if (loading) return <p>Loading projekcije...</p>;
  if (error) return <p>{error}</p>;

  return (
    <div className="admin-projekcije-container">
      <h1>Projekcije</h1>

      {/* Filter */}
      <input
        type="text"
        placeholder="Pretraga po nazivu filma ili sale..."
        value={searchTerm}
        onChange={handleSearch}
        className="search-input"
      />

      {/* Tabela sa projekcijama */}
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
          {currentProjekcije.map((projekcija) => (
            <ProjekcijaRow key={projekcija.id} projekcija={projekcija} />  // Koristimo reusable komponentu
          ))}
        </tbody>
      </table>

      {/* Paginacija */}
      <div className="pagination-controls">
        <button onClick={handlePreviousPage} disabled={currentPage === 1}>
          Prethodna
        </button>
        <span>
          Stranica {currentPage} od {totalPages}
        </span>
        <button onClick={handleNextPage} disabled={currentPage === totalPages}>
          Sledeća
        </button>
      </div>
    </div>
  );
};

export default AdminProjekcije;
