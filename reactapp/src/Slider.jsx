import React, { useState } from 'react';
import './Slider.css';

const Slider = () => {
  const images = [
    { src: 'https://s3proxygw.cineplexx.at/cms-live/asset/_default_upload_bucket/CBC_Thursday_4_1206x504_2.jpg', alt: 'Image 1' },
    { src: 'https://s3proxygw.cineplexx.at/cms-live/asset/_default_upload_bucket/Newsletter_1206x504_SRB_1.jpg', alt: 'Image 2' },
  
  ];

  const [current, setCurrent] = useState(0);

  const nextSlide = () => {
    setCurrent(current === images.length - 1 ? 0 : current + 1);
  };

  const prevSlide = () => {
    setCurrent(current === 0 ? images.length - 1 : current - 1);
  };

  return (
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
  );
};

export default Slider;
