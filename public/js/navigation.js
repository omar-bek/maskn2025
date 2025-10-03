// Optimized Navigation JavaScript for Insha'at Platform

// Debounce function for better performance
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

// Throttle function for scroll events
function throttle(func, limit) {
    let inThrottle;
    return function() {
        const args = arguments;
        const context = this;
        if (!inThrottle) {
            func.apply(context, args);
            inThrottle = true;
            setTimeout(() => inThrottle = false, limit);
        }
    }
}

// Mobile menu functionality
function toggleMobileMenu() {
    const mobileMenu = document.getElementById('mobileMenu');
    const mobileMenuOverlay = document.getElementById('mobileMenuOverlay');
    const toggleButton = document.querySelector('.mobile-menu-toggle');
    const closeButton = document.querySelector('.mobile-menu-close');

    if (!mobileMenu || !mobileMenuOverlay || !toggleButton) {
        console.error('Mobile menu elements not found');
        return;
    }

    const isActive = mobileMenu.classList.contains('active');

    if (isActive) {
        // Close menu
        closeMobileMenu();
    } else {
        // Open menu
        openMobileMenu();
    }
}

function openMobileMenu() {
    const mobileMenu = document.getElementById('mobileMenu');
    const mobileMenuOverlay = document.getElementById('mobileMenuOverlay');
    const toggleButton = document.querySelector('.mobile-menu-toggle');

    console.log('Opening mobile menu...');
    console.log('Mobile menu element:', mobileMenu);
    console.log('Overlay element:', mobileMenuOverlay);
    console.log('Toggle button:', toggleButton);

    if (mobileMenu) {
        mobileMenu.classList.add('active');
        console.log('Added active class to mobile menu');
    }

    if (mobileMenuOverlay) {
        mobileMenuOverlay.classList.add('active');
        console.log('Added active class to overlay');
    }

    if (toggleButton) {
        toggleButton.setAttribute('aria-expanded', 'true');
        toggleButton.innerHTML = '<i class="fas fa-times"></i>';
    }

    document.body.style.overflow = 'hidden';

    // Force a reflow to ensure the changes are applied
    mobileMenu.offsetHeight;
}

function closeMobileMenu() {
    const mobileMenu = document.getElementById('mobileMenu');
    const mobileMenuOverlay = document.getElementById('mobileMenuOverlay');
    const toggleButton = document.querySelector('.mobile-menu-toggle');

    mobileMenu.classList.remove('active');
    mobileMenuOverlay.classList.remove('active');
    toggleButton.setAttribute('aria-expanded', 'false');
    document.body.style.overflow = '';
    toggleButton.innerHTML = '<i class="fas fa-bars"></i>';
}

// User dropdown functionality
function toggleUserDropdown() {
    const dropdown = document.getElementById('userDropdown');
    const dropdownButton = document.querySelector('[onclick="toggleUserDropdown()"]');
    const authDropdown = document.getElementById('authDropdown');
    const languageDropdown = document.getElementById('languageDropdown');

    if (!dropdown || !dropdownButton) return;

    // Close other dropdowns if open
    if (authDropdown && !authDropdown.classList.contains('hidden')) {
        authDropdown.classList.add('hidden');
        const authButton = document.querySelector('[onclick="toggleAuthDropdown()"]');
        if (authButton) authButton.setAttribute('aria-expanded', 'false');
    }

    if (languageDropdown && !languageDropdown.classList.contains('hidden')) {
        languageDropdown.classList.add('hidden');
        const languageButton = document.querySelector('[onclick="toggleLanguageDropdown()"]');
        if (languageButton) languageButton.setAttribute('aria-expanded', 'false');
    }

    const isHidden = dropdown.classList.contains('hidden');

    if (isHidden) {
        // Position the dropdown relative to the button
        const buttonRect = dropdownButton.getBoundingClientRect();
        dropdown.style.top = (buttonRect.bottom + 8) + 'px';
        dropdown.style.left = buttonRect.left + 'px';

        dropdown.classList.remove('hidden');
        dropdownButton.setAttribute('aria-expanded', 'true');
    } else {
        dropdown.classList.add('hidden');
        dropdownButton.setAttribute('aria-expanded', 'false');
    }
}

// Auth dropdown functionality
function toggleAuthDropdown() {
    const dropdown = document.getElementById('authDropdown');
    const dropdownButton = document.querySelector('[onclick="toggleAuthDropdown()"]');
    const userDropdown = document.getElementById('userDropdown');
    const languageDropdown = document.getElementById('languageDropdown');

    if (!dropdown || !dropdownButton) return;

    // Close other dropdowns if open
    if (userDropdown && !userDropdown.classList.contains('hidden')) {
        userDropdown.classList.add('hidden');
        const userButton = document.querySelector('[onclick="toggleUserDropdown()"]');
        if (userButton) userButton.setAttribute('aria-expanded', 'false');
    }

    if (languageDropdown && !languageDropdown.classList.contains('hidden')) {
        languageDropdown.classList.add('hidden');
        const languageButton = document.querySelector('[onclick="toggleLanguageDropdown()"]');
        if (languageButton) languageButton.setAttribute('aria-expanded', 'false');
    }

    const isHidden = dropdown.classList.contains('hidden');

    if (isHidden) {
        // Position the dropdown relative to the button
        const buttonRect = dropdownButton.getBoundingClientRect();
        dropdown.style.top = (buttonRect.bottom + 8) + 'px';
        dropdown.style.left = buttonRect.left + 'px';

        dropdown.classList.remove('hidden');
        dropdownButton.setAttribute('aria-expanded', 'true');
    } else {
        dropdown.classList.add('hidden');
        dropdownButton.setAttribute('aria-expanded', 'false');
    }
}

// Language dropdown functionality
function toggleLanguageDropdown() {
    const dropdown = document.getElementById('languageDropdown');
    const dropdownButton = document.querySelector('[onclick="toggleLanguageDropdown()"]');
    const userDropdown = document.getElementById('userDropdown');
    const authDropdown = document.getElementById('authDropdown');

    if (!dropdown || !dropdownButton) return;

    // Close other dropdowns if open
    if (userDropdown && !userDropdown.classList.contains('hidden')) {
        userDropdown.classList.add('hidden');
        const userButton = document.querySelector('[onclick="toggleUserDropdown()"]');
        if (userButton) userButton.setAttribute('aria-expanded', 'false');
    }

    if (authDropdown && !authDropdown.classList.contains('hidden')) {
        authDropdown.classList.add('hidden');
        const authButton = document.querySelector('[onclick="toggleAuthDropdown()"]');
        if (authButton) authButton.setAttribute('aria-expanded', 'false');
    }

    const isHidden = dropdown.classList.contains('hidden');

    if (isHidden) {
        // Position the dropdown relative to the button
        const buttonRect = dropdownButton.getBoundingClientRect();
        dropdown.style.top = (buttonRect.bottom + 8) + 'px';
        dropdown.style.left = buttonRect.left + 'px';

        dropdown.classList.remove('hidden');
        dropdownButton.setAttribute('aria-expanded', 'true');
    } else {
        dropdown.classList.add('hidden');
        dropdownButton.setAttribute('aria-expanded', 'false');
    }
}

// Close dropdowns and menus when clicking outside
function handleOutsideClick(event) {
    // Close mobile menu
    const mobileMenu = document.getElementById('mobileMenu');
    const mobileMenuOverlay = document.getElementById('mobileMenuOverlay');
    const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');

    if (mobileMenu && mobileMenuOverlay && mobileMenuToggle && mobileMenu.classList.contains('active')) {
        if (event.target === mobileMenuOverlay) {
            closeMobileMenu();
        }
    }

    // Close user dropdown
    const dropdown = document.getElementById('userDropdown');
    const dropdownButton = document.querySelector('[onclick="toggleUserDropdown()"]');

    if (dropdown && dropdownButton && !dropdown.classList.contains('hidden')) {
        if (!dropdown.contains(event.target) && !dropdownButton.contains(event.target)) {
            dropdown.classList.add('hidden');
            dropdownButton.setAttribute('aria-expanded', 'false');
        }
    }

    // Close auth dropdown
    const authDropdown = document.getElementById('authDropdown');
    const authDropdownButton = document.querySelector('[onclick="toggleAuthDropdown()"]');

    if (authDropdown && authDropdownButton && !authDropdown.classList.contains('hidden')) {
        if (!authDropdown.contains(event.target) && !authDropdownButton.contains(event.target)) {
            authDropdown.classList.add('hidden');
            authDropdownButton.setAttribute('aria-expanded', 'false');
        }
    }

    // Close language dropdown
    const languageDropdown = document.getElementById('languageDropdown');
    const languageDropdownButton = document.querySelector('[onclick="toggleLanguageDropdown()"]');

    if (languageDropdown && languageDropdownButton && !languageDropdown.classList.contains('hidden')) {
        if (!languageDropdown.contains(event.target) && !languageDropdownButton.contains(event.target)) {
            languageDropdown.classList.add('hidden');
            languageDropdownButton.setAttribute('aria-expanded', 'false');
        }
    }
}

// Close mobile menu when clicking on links
function handleMobileLinkClick(event) {
    if (event.target.closest('.mobile-nav-link, .mobile-nav-button')) {
        closeMobileMenu();
    }
}

// Optimized scroll effect for header
const debouncedScrollHandler = debounce(function() {
    const header = document.querySelector('.header');
    if (header) {
        if (window.scrollY > 50) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    }
}, 10);

// Handle window resize to reposition dropdowns
function handleWindowResize() {
    // Close all dropdowns on resize
    const userDropdown = document.getElementById('userDropdown');
    const authDropdown = document.getElementById('authDropdown');
    const languageDropdown = document.getElementById('languageDropdown');

    if (userDropdown && !userDropdown.classList.contains('hidden')) {
        userDropdown.classList.add('hidden');
        const userButton = document.querySelector('[onclick="toggleUserDropdown()"]');
        if (userButton) userButton.setAttribute('aria-expanded', 'false');
    }

    if (authDropdown && !authDropdown.classList.contains('hidden')) {
        authDropdown.classList.add('hidden');
        const authButton = document.querySelector('[onclick="toggleAuthDropdown()"]');
        if (authButton) authButton.setAttribute('aria-expanded', 'false');
    }

    if (languageDropdown && !languageDropdown.classList.contains('hidden')) {
        languageDropdown.classList.add('hidden');
        const languageButton = document.querySelector('[onclick="toggleLanguageDropdown()"]');
        if (languageButton) languageButton.setAttribute('aria-expanded', 'false');
    }
}

// Handle keyboard events
function handleKeyboardEvents(event) {
    if (event.key === 'Escape') {
        // Close user dropdown
        const dropdown = document.getElementById('userDropdown');
        const dropdownButton = document.querySelector('[onclick="toggleUserDropdown()"]');
        if (dropdown && !dropdown.classList.contains('hidden')) {
            dropdown.classList.add('hidden');
            dropdownButton.setAttribute('aria-expanded', 'false');
        }

        // Close auth dropdown
        const authDropdown = document.getElementById('authDropdown');
        const authDropdownButton = document.querySelector('[onclick="toggleAuthDropdown()"]');
        if (authDropdown && !authDropdown.classList.contains('hidden')) {
            authDropdown.classList.add('hidden');
            authDropdownButton.setAttribute('aria-expanded', 'false');
        }

        // Close language dropdown
        const languageDropdown = document.getElementById('languageDropdown');
        const languageDropdownButton = document.querySelector('[onclick="toggleLanguageDropdown()"]');
        if (languageDropdown && !languageDropdown.classList.contains('hidden')) {
            languageDropdown.classList.add('hidden');
            languageDropdownButton.setAttribute('aria-expanded', 'false');
        }

        // Close mobile menu
        const mobileMenu = document.getElementById('mobileMenu');
        if (mobileMenu && mobileMenu.classList.contains('active')) {
            closeMobileMenu();
        }
    }
}

// Prevent double form submissions
function handleFormSubmissions() {
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const submitButton = form.querySelector('button[type="submit"]');
            if (submitButton && !submitButton.disabled) {
                submitButton.disabled = true;
                const originalText = submitButton.innerHTML;
                submitButton.innerHTML = '<i class="fas fa-spinner fa-spin ml-2"></i>جاري الإرسال...';

                // Re-enable button after 10 seconds as fallback
                setTimeout(() => {
                    if (submitButton.disabled) {
                        submitButton.disabled = false;
                        submitButton.innerHTML = originalText;
                    }
                }, 10000);
            }
        });
    });
}

// Add loading states to links
function handleLinkLoading() {
    const links = document.querySelectorAll('a[href]:not([href^="#"]):not([href^="mailto:"]):not([href^="tel:"])');
    links.forEach(link => {
        link.addEventListener('click', function(e) {
            // Don't show loading for external links or special cases
            if (this.hostname !== window.location.hostname ||
                this.getAttribute('download') ||
                this.getAttribute('target') === '_blank' ||
                this.classList.contains('no-loading')) {
                return;
            }

            // Add loading state
            this.style.pointerEvents = 'none';
            this.style.opacity = '0.7';

            // Remove loading state after navigation
            setTimeout(() => {
                this.style.pointerEvents = '';
                this.style.opacity = '';
            }, 1000);
        });
    });
}

// Preload critical pages
function preloadCriticalPages() {
    const criticalPages = [
        '/',
        '/designs',
        '/projects',
        '/lands/create',
        '/cost-calculator'
    ];

    criticalPages.forEach(page => {
        const link = document.createElement('link');
        link.rel = 'prefetch';
        link.href = page;
        document.head.appendChild(link);
    });
}

// Initialize all navigation functionality
function initNavigation() {
    // Add event listeners
    document.addEventListener('click', handleOutsideClick);
    document.addEventListener('click', handleMobileLinkClick);
    document.addEventListener('keydown', handleKeyboardEvents);
    window.addEventListener('scroll', debouncedScrollHandler, { passive: true });
    window.addEventListener('resize', handleWindowResize);

    // Add touch support for mobile devices
    if ('ontouchstart' in window) {
        document.body.classList.add('touch-device');
    }

    // Add event listeners for mobile menu toggle (works for all devices)
    const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
    const mobileMenuClose = document.querySelector('.mobile-menu-close');

    if (mobileMenuToggle) {
        // Remove any existing onclick attribute to avoid conflicts
        mobileMenuToggle.removeAttribute('onclick');

        // Add click event listener
        mobileMenuToggle.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            toggleMobileMenu();
        });

        // Add touch event for mobile devices
        if ('ontouchstart' in window) {
            mobileMenuToggle.addEventListener('touchstart', function(e) {
                e.preventDefault();
                e.stopPropagation();
                toggleMobileMenu();
            }, { passive: false });
        }
    }

    // Add event listener for close button
    if (mobileMenuClose) {
        mobileMenuClose.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            closeMobileMenu();
        });
    }

    // Initialize form and link handlers
    handleFormSubmissions();
    handleLinkLoading();

    // Preload critical pages
    if ('requestIdleCallback' in window) {
        requestIdleCallback(preloadCriticalPages);
    } else {
        setTimeout(preloadCriticalPages, 1000);
    }

    // Debug: Log if mobile menu elements are found
    const mobileMenu = document.getElementById('mobileMenu');
    const mobileMenuOverlay = document.getElementById('mobileMenuOverlay');
    const toggleButton = document.querySelector('.mobile-menu-toggle');

    if (mobileMenu && mobileMenuOverlay && toggleButton) {
        console.log('Mobile menu initialized successfully');
        console.log('Mobile menu element:', mobileMenu);
        console.log('Mobile menu overlay element:', mobileMenuOverlay);
        console.log('Toggle button element:', toggleButton);

        // Add a temporary test function to force show the menu
        window.testMobileMenu = function() {
            console.log('Testing mobile menu visibility...');
            mobileMenu.style.display = 'block';
            mobileMenu.style.visibility = 'visible';
            mobileMenu.style.opacity = '1';
            mobileMenu.style.right = '0';
            mobileMenu.style.zIndex = '99999';
            mobileMenu.classList.add('active');
            mobileMenuOverlay.classList.add('active');
            console.log('Mobile menu should now be visible');
        };

        console.log('Test function available: window.testMobileMenu()');
    } else {
        console.error('Mobile menu elements not found during initialization');
        console.log('Available elements with mobile-menu class:', document.querySelectorAll('.mobile-menu'));
        console.log('Available elements with mobile-menu-toggle class:', document.querySelectorAll('.mobile-menu-toggle'));
        console.log('Available elements with mobile-menu-overlay class:', document.querySelectorAll('.mobile-menu-overlay'));
    }
}

// Initialize when DOM is ready
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initNavigation);
} else {
    initNavigation();
}

// Export functions for global access
window.toggleMobileMenu = toggleMobileMenu;
window.toggleUserDropdown = toggleUserDropdown;
window.toggleAuthDropdown = toggleAuthDropdown;
window.toggleLanguageDropdown = toggleLanguageDropdown;

// Debug function to check dropdown visibility
window.debugDropdowns = function() {
    const userDropdown = document.getElementById('userDropdown');
    const authDropdown = document.getElementById('authDropdown');
    const languageDropdown = document.getElementById('languageDropdown');

    console.log('=== DROPDOWN DEBUG ===');
    console.log('User dropdown:', userDropdown);
    console.log('Auth dropdown:', authDropdown);
    console.log('Language dropdown:', languageDropdown);

    [userDropdown, authDropdown, languageDropdown].forEach((dropdown, index) => {
        if (dropdown) {
            const styles = window.getComputedStyle(dropdown);
            console.log(`Dropdown ${index + 1}:`, {
                display: styles.display,
                visibility: styles.visibility,
                opacity: styles.opacity,
                zIndex: styles.zIndex,
                position: styles.position,
                top: styles.top,
                left: styles.left,
                hasHiddenClass: dropdown.classList.contains('hidden')
            });
        }
    });
};

// Force show all dropdowns for testing
window.forceShowDropdowns = function() {
    const userDropdown = document.getElementById('userDropdown');
    const authDropdown = document.getElementById('authDropdown');
    const languageDropdown = document.getElementById('languageDropdown');

    [userDropdown, authDropdown, languageDropdown].forEach((dropdown, index) => {
        if (dropdown) {
            dropdown.style.position = 'fixed';
            dropdown.style.top = (100 + index * 200) + 'px';
            dropdown.style.left = '100px';
            dropdown.style.zIndex = '9999999';
            dropdown.style.display = 'block';
            dropdown.style.visibility = 'visible';
            dropdown.style.opacity = '1';
            dropdown.style.background = 'white';
            dropdown.style.border = '5px solid red';
            dropdown.classList.remove('hidden');
            console.log(`Forced dropdown ${index + 1} to be visible`);
        }
    });
};

// Test function to show dropdowns
window.testDropdowns = function() {
    console.log('Testing dropdowns...');
    forceShowDropdowns();
    setTimeout(() => {
        console.log('Dropdowns should be visible now!');
    }, 100);
};

// Fallback: Ensure functions are available immediately
if (typeof window.toggleMobileMenu === 'undefined') {
    window.toggleMobileMenu = function() {
        console.log('Fallback mobile menu toggle called');
        toggleMobileMenu();
    };
}





