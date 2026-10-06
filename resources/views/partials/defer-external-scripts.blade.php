<script>
    (function (sources) {
        if (!sources.length) return;

        function loadSources() {
            const append = () => sources.forEach(({ src, crossorigin }) => {
                if (document.querySelector(`script[src="${src}"]`)) return;
                const script = document.createElement('script');
                script.src = src;
                script.async = true;
                if (crossorigin) script.crossOrigin = crossorigin;
                document.head.appendChild(script);
            });

            if ('requestIdleCallback' in window) {
                window.requestIdleCallback(append, { timeout: 5000 });
            } else {
                window.setTimeout(append, 1500);
            }
        }

        if (document.readyState === 'complete') {
            loadSources();
        } else {
            window.addEventListener('load', loadSources, { once: true });
        }
    })(@json($sources));
</script>
