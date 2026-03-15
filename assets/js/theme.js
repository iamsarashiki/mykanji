function toggleTheme() {
    let theme = document.getElementById('theme-style');
    if (theme.getAttribute('href') === 'assets/css/light.css') {
        theme.setAttribute('href', 'assets/css/dark.css');
        localStorage.setItem('theme', 'dark');
    } else {
        theme.setAttribute('href', 'assets/css/light.css');
        localStorage.setItem('theme', 'light');
    }
}
window.onload = function() {
    let savedTheme = localStorage.getItem('theme') || 'light';
    document.getElementById('theme-style').setAttribute('href', `assets/css/${savedTheme}.css`);
}
