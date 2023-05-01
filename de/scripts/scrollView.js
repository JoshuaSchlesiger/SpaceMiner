document.addEventListener('DOMContentLoaded', function() {
    setTimeout(function(){
        const y = document.getElementById( 'yourJob' ).getBoundingClientRect().top + window.scrollY;
        window.scroll({
            top: y - 90,
            behavior: 'instant'
          });
    }, 0);
}, false);