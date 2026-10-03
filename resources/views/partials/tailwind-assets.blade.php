@if (file_exists(public_path('hot')) || file_exists(public_path('build/manifest.json')))
    @vite('resources/css/app.css')
@else
    <script>
        tailwind.config = { darkMode: 'class' };
    </script>
    <script src="https://cdn.tailwindcss.com"></script>
@endif
