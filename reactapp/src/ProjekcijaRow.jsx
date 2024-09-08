import React from 'react';
 

const ProjekcijaRow = ({ projekcija }) => {
  return (
    <tr>
      <td>{projekcija.id}</td>
      <td>{projekcija.film.naziv}</td>
      <td>{projekcija.sala.naziv}</td>
      <td>{projekcija.datum_vreme}</td>
      <td>{projekcija.cena} RSD</td>
      <td>{projekcija.broj_slobodnih_mesta}</td>
    </tr>
  );
};

export default ProjekcijaRow;
