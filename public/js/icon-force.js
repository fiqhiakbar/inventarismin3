// Icon Force JavaScript - Inventaris Sekolahku

document.addEventListener('DOMContentLoaded', function() {
    console.log('Icon Force loaded!');

    // Function to force show icons
    function forceShowIcons() {
        const statCards = document.querySelectorAll('.stat-card');

        statCards.forEach((card, index) => {
            const icon = card.querySelector('.card-icon');
            const iconI = card.querySelector('.card-icon i');

            if (icon) {
                // Force icon container visibility
                icon.style.setProperty('display', 'flex', 'important');
                icon.style.setProperty('visibility', 'visible', 'important');
                icon.style.setProperty('opacity', '1', 'important');
                icon.style.setProperty('position', 'absolute', 'important');
                icon.style.setProperty('top', '18px', 'important');
                icon.style.setProperty('right', '18px', 'important');
                icon.style.setProperty('width', '42px', 'important');
                icon.style.setProperty('height', '42px', 'important');
                icon.style.setProperty('border-radius', '50%', 'important');
                icon.style.setProperty('align-items', 'center', 'important');
                icon.style.setProperty('justify-content', 'center', 'important');
                icon.style.setProperty('z-index', '999', 'important');

                // Set background color based on card class
                if (card.classList.contains('total')) {
                    icon.style.setProperty('background', 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)', 'important');
                } else if (card.classList.contains('good')) {
                    icon.style.setProperty('background', 'linear-gradient(135deg, #4facfe 0%, #00f2fe 100%)', 'important');
                } else if (card.classList.contains('warning')) {
                    icon.style.setProperty('background', 'linear-gradient(135deg, #fa709a 0%, #fee140 100%)', 'important');
                } else if (card.classList.contains('danger')) {
                    icon.style.setProperty('background', 'linear-gradient(135deg, #ff9a9e 0%, #fecfef 100%)', 'important');
                }

                console.log('Forced icon container for card', index + 1);
            }

            if (iconI) {
                // Force FontAwesome icon visibility
                iconI.style.setProperty('display', 'block', 'important');
                iconI.style.setProperty('visibility', 'visible', 'important');
                iconI.style.setProperty('opacity', '1', 'important');
                iconI.style.setProperty('color', 'white', 'important');
                iconI.style.setProperty('font-size', '18px', 'important');
                iconI.style.setProperty('font-family', '"Font Awesome 5 Free"', 'important');
                iconI.style.setProperty('font-weight', '900', 'important');

                console.log('Forced FontAwesome icon for card', index + 1);
            }

            // Ensure card has proper positioning
            card.style.setProperty('position', 'relative', 'important');
            card.style.setProperty('overflow', 'visible', 'important');
        });
    }

    // Apply fixes immediately
    forceShowIcons();

    // Apply fixes multiple times
    setTimeout(forceShowIcons, 100);
    setTimeout(forceShowIcons, 300);
    setTimeout(forceShowIcons, 500);
    setTimeout(forceShowIcons, 1000);
    setTimeout(forceShowIcons, 2000);

    // Apply fixes on window resize
    window.addEventListener('resize', forceShowIcons);

    // Apply fixes on scroll
    window.addEventListener('scroll', forceShowIcons);

    // Monitor for changes
    const observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            if (mutation.type === 'childList') {
                setTimeout(forceShowIcons, 100);
            }
        });
    });

    // Start observing
    observer.observe(document.body, {
        childList: true,
        subtree: true
    });

    // Continuous monitoring
    setInterval(forceShowIcons, 3000);

    console.log('Icon Force monitoring started!');
});