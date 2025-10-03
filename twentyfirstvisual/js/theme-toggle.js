document.addEventListener('DOMContentLoaded', () => {
    const toggleBtn = document.getElementById('theme-toggle');
    const icon = toggleBtn.querySelector('.material-icons');
    const body = document.body;

    // Load saved theme
    const savedTheme = localStorage.getItem('theme') || 'light';
    body.dataset.theme = savedTheme;
    icon.textContent = savedTheme === 'dark' ? 'light_mode' : 'dark_mode';

    toggleBtn.addEventListener('click', () => {
        const newTheme = body.dataset.theme === 'dark' ? 'light' : 'dark';
        body.dataset.theme = newTheme;
        localStorage.setItem('theme', newTheme);
        icon.textContent = newTheme === 'dark' ? 'light_mode' : 'dark_mode';
    });
});
