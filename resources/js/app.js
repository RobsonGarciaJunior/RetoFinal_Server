import './bootstrap';

document.addEventListener('DOMContentLoaded', function () {

    const lightToggleButton = document.getElementById('light_mode');

    const darkToggleButton = document.getElementById('dark_mode');

    const htmlElement = document.documentElement;

    const savedTheme = localStorage.getItem('theme');

    // Establecer el tema según el estado almacenado (si existe)
    if (savedTheme) {
        htmlElement.setAttribute('data-bs-theme', savedTheme);
        updateThemeClasses(savedTheme);
    }
    lightToggleButton.addEventListener('click', () => {
        const theme = 'light';
        document.getElementById('modeDropDown').innerHTML = '<i class="bi bi-sun-fill">';
        htmlElement.setAttribute('data-bs-theme', theme);
        localStorage.setItem('theme', theme);
        updateThemeClasses(theme);
    });

    darkToggleButton.addEventListener('click', () => {
        const theme = 'dark';
        document.getElementById('modeDropDown').innerHTML = '<i class="bi bi-moon-fill">';
        htmlElement.setAttribute('data-bs-theme', theme);
        localStorage.setItem('theme', theme);
        updateThemeClasses(theme);
    });
});

function updateThemeClasses(theme) {
    const elementsToToggle = document.querySelectorAll('.container-fluid');
    elementsToToggle.forEach(element => {
        element.classList.remove('bg-light', 'text-dark', 'bg-dark', 'text-light');
        element.classList.add('bg-' + theme, 'text-' + (theme === 'dark' ? 'light' : 'dark'));
    });
    // Selecciona el elemento i dentro de modeDropDown
    const iconElement = document.getElementById('modeDropDown');

    // Cambia el contenido del elemento i según el tema
    if (theme === 'dark') {
        iconElement.innerHTML = '<i class="bi bi-moon-fill">';
    } else {
        iconElement.innerHTML = '<i class="bi bi-sun-fill">';
    }
}
