// Pie Chart Fix JavaScript - Inventaris Sekolahku

document.addEventListener('DOMContentLoaded', function() {
    console.log('Pie Chart Fix loaded!');

    // Function to fix pie chart text colors only
    function fixPieChartColors() {
        // Find only pie chart elements
        const pieCharts = document.querySelectorAll('.apexcharts-pie-series');
        const pieLabels = document.querySelectorAll('.apexcharts-pie-label text');

        console.log('Found', pieCharts.length, 'pie chart series and', pieLabels.length, 'pie labels');

        // Fix only pie chart labels
        pieLabels.forEach((label, index) => {
            // Set white color only for pie chart percentage numbers
            label.style.setProperty('fill', 'white', 'important');
            label.style.setProperty('color', 'white', 'important');
            label.style.setProperty('font-weight', '700', 'important');
            label.style.setProperty('font-size', '16px', 'important');

            console.log('Fixed pie chart label', index + 1, ':', label.textContent);
        });

        // Fix pie chart series text
        pieCharts.forEach((series, index) => {
            const textElements = series.querySelectorAll('text');
            textElements.forEach(text => {
                // Only fix text that contains percentage or numbers
                if (text.textContent && (text.textContent.includes('%') || /^\d+\.?\d*$/.test(text.textContent.trim()))) {
                    text.style.setProperty('fill', 'white', 'important');
                    text.style.setProperty('color', 'white', 'important');
                    text.style.setProperty('font-weight', '700', 'important');
                    text.style.setProperty('font-size', '16px', 'important');

                    console.log('Fixed pie chart series text', index + 1, ':', text.textContent);
                }
            });
        });

        // Fix data labels on pie charts only
        const dataLabels = document.querySelectorAll('.apexcharts-datalabel-label, .apexcharts-datalabel-value');
        dataLabels.forEach((label, index) => {
            // Only fix if it's inside a pie chart
            if (label.closest('.apexcharts-pie-series') || label.closest('.apexcharts-pie-label')) {
                label.style.setProperty('fill', 'white', 'important');
                label.style.setProperty('color', 'white', 'important');
                label.style.setProperty('font-weight', '600', 'important');
                label.style.setProperty('font-size', '14px', 'important');

                console.log('Fixed pie chart data label', index + 1, ':', label.textContent);
            }
        });
    }

    // Apply fixes immediately
    fixPieChartColors();

    // Apply fixes after delays to ensure charts are rendered
    setTimeout(fixPieChartColors, 1000);
    setTimeout(fixPieChartColors, 2000);
    setTimeout(fixPieChartColors, 3000);

    // Apply fixes on window resize
    window.addEventListener('resize', () => {
        setTimeout(fixPieChartColors, 100);
    });

    // Monitor for new chart elements
    const observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            if (mutation.type === 'childList') {
                setTimeout(fixPieChartColors, 100);
            }
        });
    });

    // Start observing
    observer.observe(document.body, {
        childList: true,
        subtree: true
    });

    // Continuous monitoring for pie charts only
    setInterval(fixPieChartColors, 5000);

    console.log('Pie Chart Fix monitoring started!');
});