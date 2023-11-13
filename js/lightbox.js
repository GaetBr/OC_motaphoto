const fullscreenImg = document.querySelectorAll('.fullscreen-img');
const lightbox = document.querySelector('.lightbox');
const lightboxClose = document.querySelector('.lightbox_close');

const openLightbox = () => {
  lightbox.style.display = 'flex'; // Show the lightbox as flex
  document.body.classList.add('lightbox-scroll-lock'); // Add the class to hide scrolling
};

const closeLightbox = () => {
  lightbox.style.display = 'none'; // Hide the lightbox
  document.body.classList.remove('lightbox-scroll-lock'); // Remove the class to restore scrolling
};

// Change this part to iterate through each fullscreenImg element
fullscreenImg.forEach((img) => {
  img.addEventListener('click', () => {
    openLightbox();
  });
});

lightboxClose.addEventListener('click', () => {
  closeLightbox();
});

window.addEventListener('keydown', (event) => {
  if (event.key === 'Escape') {
    closeLightbox();
  }
});