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
    else{
        return "Dark";
    }

}

// Funktion, um den Farbmodus des Benutzers zu überprüfen und das Favicon entsprechend zu setzen
function setFavicon() {
    var colorMode = getPreferredColorMode();
    console.log(colorMode);
    var faviconPath = 'images/favicon/Icon' + colorMode + '192.png';
    // Setze das Favicon
    $('link[rel="icon"]').attr('href', faviconPath);
}



$(function() {
    setFavicon();
});
