/*****************************************************************************************/
/*****************                MENU BURGER                     ************************/
/*****************************************************************************************/
// Function to handle the opening of the menu and smooth scrolling to the selected section
function handleMenuOpen() {
  // Iterate through all links inside the side navigation menu
  document.querySelectorAll("#mySidenav a").forEach((link) => {
    // Add a click event listener to each link
    link.addEventListener("click", function (event) {
      // Get the href attribute of the clicked link
      const linkHref = this.getAttribute("href");

      // Check if the link does not start with "http" or "https" (internal link)
      if (!linkHref.startsWith("http") && !linkHref.startsWith("https")) {
        event.preventDefault(); // Prevent the default link behavior 
        closeNav();
        burgerIcon.classList.remove("active"); // Remove the active class from the burger icon

        // Extract the target element's id from the href
        const targetId = linkHref.substring(1);
        const targetElement = document.getElementById(targetId);

        // If the target element exists, scroll to it smoothly
        if (targetElement) {
          window.scrollTo({
            top: targetElement.offsetTop,
            behavior: "smooth",
          });
        }
      }
    });
  }
)}

  // Get references to relevant elements
  var sidenav = document.getElementById("mySidenav");
  var openBtn = document.getElementById("openBtn");
  var burgerIcon = document.querySelector(".burger-icon");
  
  // Event listener for the burger icon click
  openBtn.onclick = function() {
    // Check if the side navigation menu is active or not
    if (sidenav.classList.contains("active")) {
      closeNav();
      burgerIcon.classList.remove("active"); // Remove the active class from the burger icon
    } else {
      openNav();
      burgerIcon.classList.add("active"); // Add the active class to the burger icon
      handleMenuOpen(); // Attach click event listeners to menu links for smooth scrolling
    }
  };
  
  // Function to open the side navigation menu
  function openNav() {
    document.body.style.overflow = "hidden"; // Disable body scrolling
    sidenav.style.visibility = "visible"; // Make the side navigation menu visible
    sidenav.style.opacity = "1";
    sidenav.classList.add("active"); // Add the active class to the side navigation menu
  }
  
  function closeNav() {
    document.body.style.overflow = "visible"; // Enable body scrolling
    sidenav.style.visibility = "hidden"; // Hide the side navigation menu
    sidenav.style.opacity = "0";
    sidenav.classList.remove("active"); // Remove the active class from the side navigation menu
  }

/*****************************************************************************************/
/***************                       MODAL                         *********************/
/*****************************************************************************************/
// Wait for the DOM content to be fully loaded before executing the script
document.addEventListener("DOMContentLoaded", function() {
  // Get references to the modal and its content
  var modal = document.getElementById('myModal');
  var modalContent = document.querySelector('.modal-content');
  // Get all elements with the class "contact-link"
  var contactLinks = document.querySelectorAll(".contact-link");

  // Function to open the modal
  function openModal() {
    modal.style.display = "flex";
  }

  // Function to close the modal
  function closeModal() {
    modal.style.display = "none";
  }

  // Add click event listeners to all elements with the class "contact-link"
  contactLinks.forEach(function(contactLink) {
    contactLink.addEventListener('click', function(event) {
      event.preventDefault(); // Prevent the default link behavior
      openModal(); // Call the function to open the modal
    });
  });

  // Event listener for the 'Escape' key to close the modal
  window.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
      closeModal(); // Call the function to close the modal
    }
  });

  // Event listener for mouseup outside the modal content to close the modal
  document.addEventListener('mouseup', function(event) {
    if (!modalContent.contains(event.target)) {
      closeModal();
    }
  });
});

/*****************************************************************************************/
/***************                 MODAL AVEC JQUERY                   *********************/
/*****************************************************************************************/
// Ensure the document is fully loaded before executing the script
jQuery(document).ready(function($) {
  // Event listener for the click on the element with id 'contactBTN'
  $('#contactBTN').on('click', function() {
    // Set the value of the input with name 'your-text' to the value of 'refPhoto'
    $('#myModal input[name="your-text"]').val(refPhoto);
     // Alternatively, if the 'REF.PHOTO' field is a text input, use the following code to make it readonly
    // $('#myModal input[name="your-text"]').val(refPhoto).attr('readonly', true);
    $('#myModal').css('display', 'flex');
  });
});


/*****************************************************************************************/
/***************         AJAX AVEC JQUERY LOAD MORE ( HOME )        *********************/
/*****************************************************************************************/
jQuery(function ($) {
  var page = 2; // Initial page number
  var loading = false; // Variable to track if an AJAX request is in progress
  var noMorePhotos = false; // Variable to track if no more photos to load

   // Event listener for the 'Load More' button with id 'ajax-LoadMore'
  $('#ajax-LoadMore').on('click', function () {
    var button = $(this);

    // Check if no AJAX request is currently loading and there are more photos to load
    if (!loading && !noMorePhotos) {
      loading = true;
      // Get the current values of the filters
      var categoryFilter = $('#category-filter').val();
      var formatFilter = $('#format-filter').val();
      var yearFilter = $('#year-filter').val();
      var orderBy = $('#order-by').val();

      // AJAX request to load more photos
      $.ajax({
        type: 'POST',
        url: ajax_params.ajaxurl,
        data: {
          action: 'load_more_photos',
          page: page,
          category: categoryFilter, 
          format: formatFilter,
          year: yearFilter,
          order_by: orderBy,
        },
        success: function (response) {
          if (response) {
            // Parse the JSON response
            var data = $.parseJSON(response);

            // Check if there are images to append
            if (data.html) {
              $('#photo-catalog .row').append(data.html);
              page++;

              // Hide the button if all images have been loaded
              if (page > data.total_pages) {
                noMorePhotos = true;
                button.hide();
              }
            } else {
              noMorePhotos = true;
              button.hide(); // Hide the button if there are no more photos to load
            }
          }
          loading = false;
        }
      });
    }
  });
});

/*****************************************************************************************/
/*************** AJAX AVEC JQUERY FILTRES ( HOME ) **************************************/
/*****************************************************************************************/
// jQuery function to trigger the application of filters
jQuery(function ($) {  
  function applyFilters() {
    // Get the current values of the filters
    var categoryFilter = $('#category-filter').val();
    var formatFilter = $('#format-filter').val();
    var yearFilter = $('#year-filter').val();
    var orderBy = $('#order-by').val();
    
    // AJAX request to filter and sort photos based on selected filters
    $.ajax({
      type: 'POST',
      url: ajax_params.ajaxurl,
      data: {
        action: 'filter_and_sort_photos',
        category: categoryFilter,
        format: formatFilter,
        year: yearFilter,
        order_by: orderBy,
      },
      success: function (response) {
        // Show or hide the 'No Photos' message based on the response
        if (response.trim() === '') {
          $('#no-photos-message').show();
        } else {
          $('#no-photos-message').hide();
        }
  
        $('#photo-catalog .row').html(response);  
      }
    });
  }

  // Apply filters when the category selection changes
  $('#category-filter').on('change', function () {
      applyFilters();
  });

  // Apply filters when the format selection changes
  $('#format-filter').on('change', function () {
      applyFilters();
  });

  // Apply filters when the year selection changes
  $('#year-filter').on('change', function () {
      applyFilters();
  });

  // Apply filters when the order selection changes
  $('#order-by').on('change', function () {
      applyFilters();
  });

  // Apply filters on page load
  applyFilters();

  /************************** RESET FILTER *****************************/
  /*
  // Event handler for the filter reset button
  $('#reset-filters').on('click', function () {
    // Reset filter selector values to their initial state
    $('#category-filter').val('');
    $('#format-filter').val('');
    $('#year-filter').val('');

    // Reset custom selects
    resetCustomSelects();

    // Trigger the application of filters after resetting
    resetFilters();

  });

  // Function to trigger the reset of custom selects
  function resetCustomSelects() {
    var customSelects = document.getElementsByClassName("custom-select");
    for (var i = 0; i < customSelects.length; i++) {
        var selectedDiv = customSelects[i].getElementsByClassName("select-selected")[0];
        selectedDiv.innerHTML = '';
        selectedDiv.innerHTML = document.getElementById(customSelects[i].getElementsByTagName("select")[0].id).options[0].innerHTML;
    }
  }
  // Function to trigger the reset of filters
  function resetFilters() {
    var categoryFilter = $('#category-filter').val();
    var formatFilter = $('#format-filter').val();
    var yearFilter = $('#year-filter').val();
    var orderBy = $('#order-by').val();

    // AJAX request to reset and apply filters
    $.ajax({
      type: 'POST',
      url: ajax_params.ajaxurl,
      data: {
        action: 'filter_and_sort_photos',
        category: categoryFilter,
        format: formatFilter,
        year: yearFilter,
        order_by: orderBy,
      },
      success: function (response) {
        // Show or hide the 'No Photos' message based on the response
        if (response.trim() === '') {
          $('#no-photos-message').show();
        } else {
          $('#no-photos-message').hide();
        }

        // Update the photo section
        $('#photo-catalog .row').html(response);
      }
    });
  }*/
});

/********************* CUSTOM SELECT FOR FILTER *************************/
document.addEventListener("DOMContentLoaded", function () {
  var x, i, j, l, ll, selElmnt, a, b, c;

  // Look for any elements with the class "custom-select": 
  x = document.getElementsByClassName("custom-select");
  l = x.length;

  for (i = 0; i < l; i++) {
    selElmnt = x[i].getElementsByTagName("select")[0];
    ll = selElmnt.length;

    // For each element, create a new DIV that will act as the selected item:
    a = document.createElement("DIV");
    a.setAttribute("class", "select-selected");
    a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
    x[i].appendChild(a);

    // For each element, create a new DIV that will contain the option list: 
    b = document.createElement("DIV");
    b.setAttribute("class", "select-items select-hide");
    for (j = 1; j < ll; j++) {
      // For each option in the original select element, create a new DIV that will act as an option item: 
      c = document.createElement("DIV");
      c.innerHTML = selElmnt.options[j].innerHTML;
      c.addEventListener("click", function (e) {
        // When an item is clicked, update the original select box, and trigger the change event: 
        var y, i, k, s, h, sl, yl;
        s = this.parentNode.parentNode.getElementsByTagName("select")[0];
        sl = s.length;
        h = this.parentNode.previousSibling;
        for (i = 0; i < sl; i++) {
          if (s.options[i].innerHTML == this.innerHTML) {
            s.selectedIndex = i;
            h.innerHTML = this.innerHTML;
            y = this.parentNode.getElementsByClassName("same-as-selected");
            yl = y.length;
            for (k = 0; k < yl; k++) {
              y[k].removeAttribute("class");
            }
            this.setAttribute("class", "same-as-selected");

            // Trigger the change event on the select element
            var event = new Event("change");
            s.dispatchEvent(event);
            break;
          }
        }
        h.click();
      });
      b.appendChild(c);
    }
    x[i].appendChild(b);
    a.addEventListener("click", function (e) {
      // When the select box is clicked, close any other select boxes, and open/close the current select box: 
      e.stopPropagation();
      closeAllSelect(this);
      this.nextSibling.classList.toggle("select-hide");
      this.classList.toggle("select-arrow-active");
    });
  }

  function closeAllSelect(elmnt) {
    // A function that will close all select boxes in the document, except the current select box:
    var x, y, i, xl, yl, arrNo = [];
    x = document.getElementsByClassName("select-items");
    y = document.getElementsByClassName("select-selected");
    xl = x.length;
    yl = y.length;
    for (i = 0; i < yl; i++) {
      if (elmnt == y[i]) {
        arrNo.push(i);
      } else {
        y[i].classList.remove("select-arrow-active");
      }
    }
    for (i = 0; i < xl; i++) {
      if (arrNo.indexOf(i)) {
        x[i].classList.add("select-hide");
      }
    }
  }

  // If the user clicks anywhere outside the select box,then close all select boxes: 
  document.addEventListener("click", closeAllSelect);
});

/****************************** SWIPPER JS FOR FILTERS 425PX ***********************/
document.addEventListener("DOMContentLoaded", function () {
  if (window.innerWidth <= 425) {
    var mySwiper = new Swiper('.swiper-container', {
      slidesPerView: 2,
      spaceBetween: 50, // Space between select
      direction: 'horizontal',
    });
  }
});

/*****************************************************************************************/
/***************         AJAX AVEC JQUERY LOAD MORE (SINGLE)        *********************/
/*****************************************************************************************/
// jQuery function to handle AJAX load more functionality on the single page
jQuery(document).ready(function($) {
  // Event listener for the 'Load All Photos' button with id 'ajax-AllPhotos'
  $('#ajax-AllPhotos').on('click', function() {
    // Get the category ID from the data attribute
    var catID = $(this).data('catid');
    var data = {
      'action': 'get_related_photos',
      'cat_id': catID,
    };

    // AJAX request to get and load all related photos
    $.ajax({
      url: ajax_params.ajaxurl,
      type: 'GET',
      data: data,
      success: function(response) {
        // Clear the section of the current images
        $('#initial-photos .relatedPhoto-container').remove();

        // Append the new images
        $('#initial-photos').append(response);

        // Add a class to hide the button after loading all photos
        $('#ajax-AllPhotos').addClass('hidden');
      },
      error: function(error) {
        console.log(error);
      }
    });
  });
});
