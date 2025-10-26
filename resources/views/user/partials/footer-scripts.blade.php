<script>
    const toggle = document.getElementById('theme-toggle');
    const html = document.documentElement;

    if (localStorage.theme === 'dark' ||
        (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        html.classList.add('dark');
        toggle.textContent = '🌙';
    } else {
        html.classList.remove('dark');
        toggle.textContent = '🌞';
    }

    toggle.addEventListener('click', () => {
        html.classList.toggle('dark');
        const isDark = html.classList.contains('dark');
        toggle.textContent = isDark ? '🌙' : '🌞';
        localStorage.theme = isDark ? 'dark' : 'light';
    });
</script>