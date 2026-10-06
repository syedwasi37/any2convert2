<script>
    (function () {
        let isDark = false;
        try { isDark = localStorage.getItem('theme') === 'dark'; } catch (_) {}
        document.documentElement.classList.toggle('dark', isDark);

        window.toggleDarkMode = function () {
            const nextIsDark = document.documentElement.classList.toggle('dark');
            try { localStorage.setItem('theme', nextIsDark ? 'dark' : 'light'); } catch (_) {}
            const moon = document.getElementById('iconMoon');
            const sun = document.getElementById('iconSun');
            if (moon) moon.style.display = nextIsDark ? 'none' : '';
            if (sun) sun.style.display = nextIsDark ? '' : 'none';
        };

        document.addEventListener('DOMContentLoaded', function () {
            const dark = document.documentElement.classList.contains('dark');
            const moon = document.getElementById('iconMoon');
            const sun = document.getElementById('iconSun');
            if (moon) moon.style.display = dark ? 'none' : '';
            if (sun) sun.style.display = dark ? '' : 'none';
        }, { once: true });
    })();
</script>
