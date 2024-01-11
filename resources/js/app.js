import './bootstrap';

document.addEventListener('DOMContentLoaded', function () {
    const toggleButton = document.getElementById('darkModeToggle');
    toggleButton.addEventListener('click', () => {
        document.body.classList.toggle('bg-light');
        document.body.classList.toggle('bg-dark');
        document.body.classList.toggle('text-light');
        document.body.classList.toggle('text-dark');

        // También puedes aplicar clases a elementos específicos
        const elementsToToggle = document.querySelectorAll('.container-fluid');
        elementsToToggle.forEach(element => {
            element.classList.toggle('bg-light');
            element.classList.toggle('bg-dark');
            element.classList.toggle('text-light');
            element.classList.toggle('text-dark');
        });
    });
});

