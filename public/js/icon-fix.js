// Icon Fix JavaScript - Inventaris Sekolahku

document.addEventListener('DOMContentLoaded', function() {
    console.log('Icon Fix loaded!');

    // Function to fix icons
    function fixIcons() {
        const statCards = document.querySelectorAll('.stat-card');

        statCards.forEach((card, index) => {
            const icon = card.querySelector('.card-icon');

            if (icon) {
                // Pastikan icon memiliki style yang benar
                icon.style.setProperty('position', 'absolute', 'important');
                icon.style.setProperty('top', '18px', 'important');
                icon.style.setProperty('right', '18px', 'important');
                icon.style.setProperty('width', '42px', 'important');
                icon.style.setProperty('height', '42px', 'important');
                icon.style.setProperty('font-size', '16px', 'important');
                icon.style.setProperty('z-index', '5', 'important');
                icon.style.setProperty('border-radius', '50%', 'important');
                icon.style.setProperty('display', 'flex', 'important');
                icon.style.setProperty('align-items', 'center', 'important');
                icon.style.setProperty('justify-content', 'center', 'important');
                icon.style.setProperty('color', 'white', 'important');
                icon.style.setProperty('box-shadow', '0 4px 15px rgba(0, 0, 0, 0.2)', 'important');

                // Set background berdasarkan class card
                if (card.classList.contains('total')) {
                    icon.style.setProperty('background', 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)', 'important');
                } else if (card.classList.contains('good')) {
                    icon.style.setProperty('background', 'linear-gradient(135deg, #4facfe 0%, #00f2fe 100%)', 'important');
                } else if (card.classList.contains('warning')) {
                    icon.style.setProperty('background', 'linear-gradient(135deg, #fa709a 0%, #fee140 100%)', 'important');
                } else if (card.classList.contains('danger')) {
                    icon.style.setProperty('background', 'linear-gradient(135deg, #ff9a9e 0%, #fecfef 100%)', 'important');
                }

                console.log('Fixed icon for card', index + 1);
            }
        });
    }

    // Apply fixes immediately
    fixIcons();

    // Apply fixes after delays
    setTimeout(fixIcons, 100);
    setTimeout(fixIcons, 500);
    setTimeout(fixIcons, 1000);

    // Apply fixes on window resize
    window.addEventListener('resize', fixIcons);

    // Monitor for changes
    const observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            if (mutation.type === 'childList') {
                setTimeout(fixIcons, 100);
            }
        });
    });

    // Start observing
    observer.observe(document.body, {
        childList: true,
        subtree: true
    });

    console.log('Icon Fix monitoring started!');
});