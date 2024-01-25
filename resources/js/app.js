import './bootstrap';

document.addEventListener('DOMContentLoaded', function () {

    const modeToggleButton = document.getElementById('modeToggleButton');
    const modeIcon = document.getElementById('modeIcon');
    const htmlElement = document.documentElement;
    const savedTheme = localStorage.getItem('theme');

    // Establecer el tema según el estado almacenado (si existe)
    if (savedTheme) {
        htmlElement.setAttribute('data-bs-theme', savedTheme);
        updateThemeClasses(savedTheme);
        updateIcon(savedTheme);
    }

    modeToggleButton.addEventListener('click', () => {
        const currentTheme = htmlElement.getAttribute('data-bs-theme');
        const newTheme = currentTheme === 'light' ? 'dark' : 'light';

        htmlElement.setAttribute('data-bs-theme', newTheme);
        localStorage.setItem('theme', newTheme);
        updateThemeClasses(newTheme);
        updateIcon(newTheme);
    });
});

function updateThemeClasses(theme) {
    const elementsToToggle = document.querySelectorAll('.container-fluid');
    elementsToToggle.forEach(element => {
        element.classList.remove('bg-light', 'text-dark', 'bg-dark', 'text-light');
        element.classList.add('bg-' + theme, 'text-' + (theme === 'dark' ? 'light' : 'dark'));
    });
}

function updateIcon(theme) {
    const iconElement = document.getElementById('modeIcon');
    iconElement.innerHTML = theme === 'dark' ? '<i class="bi bi-moon-fill"></i>' : '<i class="bi bi-sun-fill"></i>';
}

