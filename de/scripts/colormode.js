
function mode() {
    input = document.getElementById('flexSwitchCheckDefault');
    if (input.checked == false) {
        document.documentElement.setAttribute('data-bs-theme', 'dark');
    }
    else {
        document.documentElement.setAttribute('data-bs-theme', 'light');
    }
}