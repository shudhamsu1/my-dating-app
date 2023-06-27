import './bootstrap';


// owlCarousel part 
$('.testi10').owlCarousel({
    loop: true,
    margin: 30,
    nav: false,
    dots: false,
    autoplay: true,
    responsiveClass: true,
    responsive: {
      0: {
        items: 1

      },
      1650: {
        items: 1
      }
    }
  })

  // model section
  document.addEventListener("DOMContentLoaded", function() {
    var myModal = new bootstrap.Modal(document.getElementById('signupModal'), {
      keyboard: false
    });
  });
  
 
