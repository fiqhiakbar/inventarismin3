// Chart Helper JavaScript - Inventaris Sekolahku

document.addEventListener('DOMContentLoaded', function() {
    console.log('Chart Helper loaded!');

    // Function to ensure charts are visible
    function ensureChartsVisible() {
        // Find all chart elements
        const chartElements = document.querySelectorAll('[id*="chart"]');
        const canvasElements = document.querySelectorAll('canvas');

        console.log('Found', chartElements.length, 'chart elements and', canvasElements.length, 'canvas elements');

        // Make sure chart elements are visible
        chartElements.forEach((chart, index) => {
            chart.style.display = 'block';
            chart.style.visibility = 'visible';
            chart.style.opacity = '1';
            chart.style.background = 'white';
            console.log('Fixed chart element', index + 1);
        });

        // Make sure canvas elements are visible
        canvasElements.forEach((canvas, index) => {
            canvas.style.display = 'block';
            canvas.style.visibility = 'visible';
            canvas.style.opacity = '1';
            canvas.style.background = 'white';
            console.log('Fixed canvas element', index + 1);
        });
    }

    // Apply fixes immediately
    ensureChartsVisible();

    // Apply fixes after a delay to ensure charts are loaded
    setTimeout(ensureChartsVisible, 1000);
    setTimeout(ensureChartsVisible, 2000);

    // Apply fixes when window resizes
    window.addEventListener('resize', ensureChartsVisible);

    // Monitor for new chart elements
    const observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            if (mutation.type === 'childList') {
                setTimeout(ensureChartsVisible, 100);
            }
        });
    });

    // Start observing
    observer.observe(document.body, {
        childList: true,
        subtree: true
    });

    console.log('Chart Helper monitoring started!');
});