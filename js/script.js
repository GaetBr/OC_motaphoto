// Fonction pour gérer l'ouverture du menu burger et déclencher l'animation des liens
function handleMenuOpen() {
    
    // Ajoute un gestionnaire d'événements pour chaque lien du menu
    document.querySelectorAll("#mySidenav a").forEach((link) => {
      link.addEventListener("click", function(event) {
        event.preventDefault(); // Empêche le comportement par défaut du lien
        closeNav(); // Ferme le menu
        burgerIcon.classList.remove("active");
        
        // Navigue vers la cible du lien avec une animation ou une transition si nécessaire
        const targetId = this.getAttribute("href").substring(1);
        const targetElement = document.getElementById(targetId);
        
        if (targetElement) {
          window.scrollTo({
            top: targetElement.offsetTop,
            behavior: "smooth"
          });
        }
      });
    });
  }
  
  var sidenav = document.getElementById("mySidenav");
  var openBtn = document.getElementById("openBtn");
  var burgerIcon = document.querySelector(".burger-icon");
  
  openBtn.onclick = function() {
    if (sidenav.classList.contains("active")) {
      closeNav();
      burgerIcon.classList.remove("active");
    } else {
      openNav();
      burgerIcon.classList.add("active");
      handleMenuOpen();
    }
  };
  
  function openNav() {
    sidenav.style.visibility = "visible";
    sidenav.style.opacity = "1";
    sidenav.classList.add("active");
  }
  
  function closeNav() {
    sidenav.style.visibility = "hidden";
    sidenav.style.opacity = "0";
    sidenav.classList.remove("active");
  }