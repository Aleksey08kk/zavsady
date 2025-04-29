$('img[data-enlargeable]').addClass('img-enlargeable').click(function() {
    var src = $(this).attr('src');
    var modal;
  
    function removeModal() {
      modal.remove();
      $('body').off('keyup.modal-close');
    }
    modal = $('<div>').css({
      background: 'RGBA(0,0,0,.5) url(' + src + ') no-repeat center',
      backgroundSize: 'contain',
      width: '100%',
      height: '100%',
      position: 'fixed',
      zIndex: '10000',
      top: '0',
      left: '0',
      cursor: 'zoom-out'
    }).click(function() {
      removeModal();
    }).appendTo('body');
    //handling ESC
    $('body').on('keyup.modal-close', function(e) {
      if (e.key === 'Escape') {
        removeModal();
      }
    });
  });
  

/*------------------------------------------------------------------*/
const mobileMenu = document.getElementById('mobile-menu');
const menuExit = document.getElementById('menu-exit');
const navLinks = document.querySelector('.nav-links');
const bar = document.querySelector('.menu-toggle');
const exit = document.querySelector('.exit');

mobileMenu.addEventListener('click', () => {
  navLinks.classList.toggle('active');
  bar.style.display = 'none'; // Скрываем bar при открытии меню
  exit.style.visibility = 'visible'; // Показываем exit
});

menuExit.addEventListener('click', () => {
  exit.style.visibility = 'hidden'; // Скрываем exit
  navLinks.classList.remove('active'); // Убираем класс active у navLinks
  bar.style.display = 'flex'; // Показываем bar при закрытии меню
});

