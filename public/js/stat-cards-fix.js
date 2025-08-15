// Stat Cards Fix JavaScript - Inventaris Sekolahku

document.addEventListener('DOMContentLoaded', function() {
    console.log('Stat Cards Fix loaded!');

    // Function to fix statistic cards
    function fixStatCards() {
        const statCards = document.querySelectorAll('.stat-card');

        statCards.forEach((card, index) => {
            // Get elements
            const cardBody = card.querySelector('.card-body');
            const cardHeader = card.querySelector('.card-header h4');
            const cardIcon = card.querySelector('.card-icon');
            const cardWrap = card.querySelector('.card-wrap');

            if (cardBody) {
                // Ensure card body (angka) is visible and positioned correctly
                cardBody.style.setProperty('position', 'relative', 'important');
                cardBody.style.setProperty('z-index', '10', 'important');
                cardBody.style.setProperty('background', 'white', 'important');
                cardBody.style.setProperty('padding', '0', 'important');
                cardBody.style.setProperty('margin', '0', 'important');
                cardBody.style.setProperty('line-height', '1.2', 'important');
                cardBody.style.setProperty('visibility', 'visible', 'important');
                cardBody.style.setProperty('opacity', '1', 'important');
                cardBody.style.setProperty('display', 'block', 'important');
            }

            if (cardHeader) {
                // Ensure card header (judul) is visible
                cardHeader.style.setProperty('position', 'relative', 'important');
                cardHeader.style.setProperty('z-index', '10', 'important');
                cardHeader.style.setProperty('background', 'white', 'important');
                cardHeader.style.setProperty('padding', '0', 'important');
                cardHeader.style.setProperty('margin', '0 0 8px 0', 'important');
                cardHeader.style.setProperty('line-height', '1.2', 'important');
                cardHeader.style.setProperty('visibility', 'visible', 'important');
                cardHeader.style.setProperty('opacity', '1', 'important');
                cardHeader.style.setProperty('display', 'block', 'important');
            }

            if (cardIcon) {
                // Position icon correctly
                cardIcon.style.setProperty('position', 'absolute', 'important');
                cardIcon.style.setProperty('top', '18px', 'important');
                cardIcon.style.setProperty('right', '18px', 'important');
                cardIcon.style.setProperty('width', '42px', 'important');
                cardIcon.style.setProperty('height', '42px', 'important');
                cardIcon.style.setProperty('font-size', '16px', 'important');
                cardIcon.style.setProperty('z-index', '5', 'important');
            }

            if (cardWrap) {
                // Ensure card wrap has correct spacing
                cardWrap.style.setProperty('padding', '18px 20px', 'important');
                cardWrap.style.setProperty('padding-top', '12px', 'important');
                cardWrap.style.setProperty('height', '100%', 'important');
                cardWrap.style.setProperty('display', 'flex', 'important');
                cardWrap.style.setProperty('flex-direction', 'column', 'important');
                cardWrap.style.setProperty('justify-content', 'flex-start', 'important');
                cardWrap.style.setProperty('background', 'white', 'important');
                cardWrap.style.setProperty('position', 'relative', 'important');
                cardWrap.style.setProperty('z-index', '10', 'important');
            }

            console.log('Fixed stat card', index + 1);
        });
    }

    // Apply fixes immediately
    fixStatCards();

    // Apply fixes after delays to ensure everything is loaded
    setTimeout(fixStatCards, 100);
    setTimeout(fixStatCards, 500);
    setTimeout(fixStatCards, 1000);

    // Apply fixes on window resize
    window.addEventListener('resize', fixStatCards);

    // Monitor for changes
    const observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            if (mutation.type === 'childList') {
                setTimeout(fixStatCards, 100);
            }
        });
    });

    // Start observing
    observer.observe(document.body, {
        childList: true,
        subtree: true
    });

    console.log('Stat Cards Fix monitoring started!');
});