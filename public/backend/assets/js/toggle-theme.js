document.addEventListener('DOMContentLoaded', function() {
    const themeToggle = document.getElementById('theme-toggle');
    const currentTheme = localStorage.getItem('theme') || 'clair';

    if (currentTheme === 'sombre') {
      document.body.classList.add('theme-sombre');
    }

    themeToggle.addEventListener('click', function() {
      document.body.classList.toggle('theme-sombre');
      const theme = document.body.classList.contains('theme-sombre') ? 'sombre' : 'clair';
      localStorage.setItem('theme', theme);
    });
  });
