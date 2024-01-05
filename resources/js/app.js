import './bootstrap';

// Funktion, um den bevorzugten Farbmodus des Benutzers zu speichern
function setPreferredColorMode(mode) {
    localStorage.setItem('preferredColorMode', mode);
}

// Funktion, um den bevorzugten Farbmodus des Benutzers abzurufen
function getPreferredColorMode() {
    if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
        return "Light";
    }
    else {
        return "Dark";
    }

}

// Funktion, um den Farbmodus des Benutzers zu überprüfen und das Favicon entsprechend zu setzen
function setFavicon() {
    var colorMode = getPreferredColorMode();
    var faviconPath = 'images/favicon/Icon' + colorMode + '192.png';
    // Setze das Favicon
    $('link[rel="icon"]').attr('href', faviconPath);
}

$('#languageForm').on('submit', function (e) {

    e.preventDefault();
    let language = $('#language').val();
    let view = $('#routeBasename').val();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
    });

    $.ajax({
        url: '/change-language',
        method: 'POST',
        data: {
            language: language,
            view: view
        },
        success: function (data) {
            if (data.redirect) {
                document.cookie = 'language=' + data.cookie + '; path=/; expires=' + new Date(new Date().getTime() + 999999 * 1000).toUTCString();
                window.location.href = data.redirect;
            } else {
                location.reload(true);
            }
        },
        error: function () {
            // Handle errors if necessary
        }
    });
});

$(function () {
    setFavicon();
});

$("#username").on("keypress",function(event){
    if (event.which === 13) {
        $("#btnAddPlayer").trigger("click");
    }
  });
