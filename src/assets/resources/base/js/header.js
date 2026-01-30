//   EFFETTO SHRINK HEADER
$(window).ready(function(){
  $('#headerFixed').css('position','fixed');
  var marginHeader = $('#headerFixed').outerHeight();
  $('#bk-page').css('margin-top',marginHeader);

  $('#headerContent').css('position','fixed');
  var marginHeader = $('#headerContent').outerHeight();
  $('#bk-page').css('margin-top',marginHeader);
 
});

$(window).on("scroll", function () {
  var headerHeight = $('#headerContent').outerHeight();

  if ($(window).scrollTop() > $('#headerContent').outerHeight()) { 
    $("body").addClass("shrink");
    $('#bk-page > #sidebarLeftRedattore > .sidebar-nav.affix-top').css('top', Number(headerHeight) + (Number(20)));

  } else {
    $("body").removeClass("shrink");
    var marginHeader = $('#headerContent').outerHeight();
    $('#bk-page').css('margin-top',marginHeader);
    
    
  }
  if ($(window).scrollTop() > $('#headerFixed').outerHeight()) { 
    
    $("body").addClass("shrink");
    $('#bk-page > #sidebarLeftRedattore > .sidebar-nav.affix-top').css('top', Number(headerHeight) + (Number(20)));

  } else {
    $("body").removeClass("shrink");
    $('#bk-page > #sidebarLeftRedattore > .sidebar-nav.affix-top').css('top', Number(headerHeight) + (Number(20)));

  
  } 
});
// PUSH UP ASSISTANNCE
$(window).on("scroll", function () {
  if
    ($(window).scrollTop() >= 99) {
    $(".bi-assistance").addClass("push-up");
  }
  else {
    $(".bi-assistance").removeClass("push-up");
  }
});

// PUSH UP GUIDE
$(window).on("scroll", function () {
  if
    ($(window).scrollTop() >= 99) {
    $(".bi-guide").addClass("push-up");
  }
  else {
    $(".bi-guide").removeClass("push-up");
  }
});

// BACK TO TOP

$(function() {
  const $backToTopElements = $('a[data-attribute*="back-to-top"]')
  $(window).on('scroll', function() {
    $backToTopElements.toggleClass(
      'back-to-top-show',
      $backToTopElements.length && $(this).scrollTop() >= 100
    )
  })

  $backToTopElements.on('click', function() {
    $('body,html').animate({ scrollTop: 0 }, 800)
  })
})


//TOGGLE SIDEBAR REDATTORE
function toggleSidebar() {
  var element = document.getElementById("sidebarLeftRedattore");
  element.classList.toggle("sidebar-small");
}


// TOGGLE SIDEBAR RL2023
// Seleziona il pulsante e il menu
// const btnHamburger = document.querySelector('.btn-hamburger-menu-rl_2023');
// const sidebarMenu = document.querySelector('#sidebar-menu-hamburger-rl_2023');

// // Aggiungi l'evento di click sul pulsante
// btnHamburger.addEventListener('click', () => {
//     // Alterna display del menu
//     if (sidebarMenu.style.display === 'block') {
//         sidebarMenu.style.display = 'none';
//         btnHamburger.setAttribute('aria-expanded', 'false'); // Imposta aria-expanded a false
//     } else {
//         sidebarMenu.style.display = 'block';
//         btnHamburger.setAttribute('aria-expanded', 'true'); // Imposta aria-expanded a true
//     }
// });

document.addEventListener("DOMContentLoaded", () => {
  const toggleSidebarButton = document.querySelector('.btn-hamburger-menu-rl_2023');
  const sidebar = document.querySelector('#sidebar-menu-hamburger-rl_2023');

  // Se non esistono i selettori, interrompi l'esecuzione dello script
  if (!toggleSidebarButton || !sidebar) {
    return;
  }

  const focusableElements = sidebar.querySelectorAll('a, button, [tabindex]:not([tabindex="-1"])');
  const firstFocusableElement = focusableElements[0];
  const lastFocusableElement = focusableElements[focusableElements.length - 1];

  // Funzione per aprire la sidebar
  const openSidebar = () => {
    sidebar.setAttribute('aria-hidden', 'false');
    toggleSidebarButton.setAttribute('aria-expanded', 'true');
    firstFocusableElement?.focus();
  };

  // Funzione per chiudere la sidebar
  const closeSidebar = () => {
    sidebar.setAttribute('aria-hidden', 'true');
    toggleSidebarButton.setAttribute('aria-expanded', 'false');
    toggleSidebarButton.focus();
  };

  // Toggle apertura/chiusura
  toggleSidebarButton.addEventListener('click', () => {
    const isExpanded = toggleSidebarButton.getAttribute('aria-expanded') === 'true';
    if (isExpanded) {
      closeSidebar();
    } else {
      openSidebar();
    }
  });

  // Gestione del tasto Esc per chiudere la sidebar
  document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape' && sidebar.getAttribute('aria-hidden') === 'false') {
      closeSidebar();
    }
  });

  // Trappola del focus all'interno della sidebar
  sidebar.addEventListener('keydown', (event) => {
    if (event.key === 'Tab' && sidebar.getAttribute('aria-hidden') === 'false') {
      if (event.shiftKey) {
        // Tab indietro
        if (document.activeElement === firstFocusableElement) {
          event.preventDefault();
          lastFocusableElement.focus();
        }
      } else {
        // Tab avanti
        if (document.activeElement === lastFocusableElement) {
          event.preventDefault();
          firstFocusableElement.focus();
        }
      }
    }
  });
});