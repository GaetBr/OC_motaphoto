$(document).ready(function () {
  // Get references to the lightbox and close button
  var lightbox = document.querySelector('.lightbox');
  var closeLightbox = document.querySelector('.lightbox_close');

  // Event listener for clicking on a fullscreen image
  $('body').on('click', '.fullscreen-img', function (e) {
    e.preventDefault();
    // Get data attributes of the clicked image
    let imageSrc = $(this).data('image');
    let imageRef = $(this).data('ref');
    let imageCat = $(this).data('cat');

    if (imageSrc) {
      // Get references to elements in the lightbox
      let lightboxImage = lightbox.querySelector('.lightbox_img');
      let lightboxRef = lightbox.querySelector('.lightbox_ref');
      let lightboxCat = lightbox.querySelector('.lightbox_cat');

      // Set the image source, reference, and category in the lightbox
      lightboxImage.setAttribute('src', imageSrc);
      lightboxImage.innerHTML = '';
      lightboxImage.innerHTML = '<img src="' + imageSrc + '" alt="Lightbox Image">';
      lightboxRef.textContent = imageRef;
      lightboxCat.textContent = imageCat;

      // Display the lightbox
      lightbox.style.display = 'block';

      // Set the current index for navigation
      let index = $('.fullscreen-img').index(this);
      lightbox.setAttribute('data-current-index', index);

      // Update arrow visibility
      updateArrowVisibility(index);
    } else {
      console.error('Image source is null or undefined');
    }
  });

  // Event listener for closing the lightbox
  closeLightbox.onclick = function () {
    closeLightboxHandler();
  };

  // Event listener for clicking outside the lightbox to close it
  window.onclick = function (event) {
    if (event.target == lightbox) {
      closeLightboxHandler();
    }
  };

  // Function to close the lightbox
  function closeLightboxHandler() {
    lightbox.style.display = 'none';
  }

  // Event listener for pressing the 'Escape' key to close the lightbox
  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') {
      closeLightboxHandler();
    }
  });
  
  // Event listener for clicking the left arrow for navigation
  lightbox.querySelector('.arrowNavL').addEventListener('click', function (e) {
    e.stopPropagation();
    var currentIndex = parseInt(lightbox.getAttribute('data-current-index'));
    // Method 1: Infinite loop
    var newIndex = (currentIndex - 1 + $('.fullscreen-img').length) % $('.fullscreen-img').length;
    // Method 2: Arrows disappear
    // var newIndex = currentIndex - 1;
    if (newIndex >= 0) {
      var previousButton = $('.fullscreen-img').eq(newIndex)[0];
      previousButton.click();
      lightbox.setAttribute('data-current-index', newIndex);
      // Update arrow visibility
      updateArrowVisibility(newIndex);
    }
  });
  
  // Event listener for clicking the right arrow for navigation
  lightbox.querySelector('.arrowNavR').addEventListener('click', function (e) {
    e.stopPropagation();
    var currentIndex = parseInt(lightbox.getAttribute('data-current-index'));
    // Method 1: Infinite loop
    var newIndex = (currentIndex + 1) % $('.fullscreen-img').length;
    // Method 2: Arrows disappear
    // var newIndex = currentIndex + 1;
    if (newIndex < $('.fullscreen-img').length) {
      var nextButton = $('.fullscreen-img').eq(newIndex)[0];
      nextButton.click();
      lightbox.setAttribute('data-current-index', newIndex);
      // Update arrow visibility
      updateArrowVisibility(newIndex);
    }
  });

  // Method 2 : Delet this if you choose Infinite loop
  // Function to update arrow visibility based on the current index
  /*function updateArrowVisibility(index) {
    var arrowNavL = lightbox.querySelector('.arrowNavL');
    var arrowNavR = lightbox.querySelector('.arrowNavR');

    if (index === 0) {
      // Hide left arrow when at the first image
      arrowNavL.classList.add('hidden');
    } else {
      arrowNavL.classList.remove('hidden');
    }

    if (index === $('.fullscreen-img').length - 1) {
      // Hide right arrow when at the last image
      arrowNavR.classList.add('hidden');
    } else {
      arrowNavR.classList.remove('hidden');
    }
  }*/
});