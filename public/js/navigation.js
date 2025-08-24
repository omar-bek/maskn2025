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
    const toggleButton = document.querySelector('.mobile-menu-toggle');

    if (!mobileMenu || !toggleButton) return;

    const isActive = mobileMenu.classList.contains('active');

    if (isActive) {
        mobileMenu.classList.remove('active');
        toggleButton.setAttribute('aria-expanded', 'false');
        document.body.style.overflow = '';
    } else {
        mobileMenu.classList.add('active');
        toggleButton.setAttribute('aria-expanded', 'true');
        document.body.style.overflow = 'hidden';
    }
}

// User dropdown functionality
function toggleUserDropdown() {
    const dropdown = document.getElementById('userDropdown');
    const dropdownButton = document.querySelector('[onclick="toggleUserDropdown()"]');

    if (!dropdown || !dropdownButton) return;

    const isHidden = dropdown.classList.contains('hidden');

    if (isHidden) {
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
    const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');

    if (mobileMenu && mobileMenuToggle) {
        if (!mobileMenu.contains(event.target) && !mobileMenuToggle.contains(event.target)) {
            mobileMenu.classList.remove('active');
            mobileMenuToggle.setAttribute('aria-expanded', 'false');
            document.body.style.overflow = '';
        }
    }

    // Close user dropdown
    const dropdown = document.getElementById('userDropdown');
    const dropdownButton = document.querySelector('[onclick="toggleUserDropdown()"]');

    if (dropdown && dropdownButton) {
        if (!dropdown.contains(event.target) && !dropdownButton.contains(event.target)) {
            dropdown.classList.add('hidden');
            dropdownButton.setAttribute('aria-expanded', 'false');
        }
    }
}

// Close mobile menu when clicking on links
function handleMobileLinkClick(event) {
    if (event.target.closest('.mobile-nav-link, .mobile-nav-button')) {
        const mobileMenu = document.getElementById('mobileMenu');
        const toggleButton = document.querySelector('.mobile-menu-toggle');
        if (mobileMenu) {
            mobileMenu.classList.remove('active');
            toggleButton.setAttribute('aria-expanded', 'false');
            document.body.style.overflow = '';
        }
    }
}

// Optimized scroll effect for header
const debouncedScrollHandler = debounce(function() {
    const header = document.querySelector('.header');
    if (header) {
        if (window.scrollY > 50) {
            header.style.boxShadow = '0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1)';
        } else {
            header.style.boxShadow = '0 1px 2px 0 rgb(0 0 0 / 0.05)';
        }
    }
}, 10);

// Handle keyboard events
function handleKeyboardEvents(event) {
    if (event.key === 'Escape') {
        // Close user dropdown
        const dropdown = document.getElementById('userDropdown');
        const dropdownButton = document.querySelector('[onclick="toggleUserDropdown()"]');
        if (dropdown) {
            dropdown.classList.add('hidden');
            dropdownButton.setAttribute('aria-expanded', 'false');
        }

        // Close mobile menu
        const mobileMenu = document.getElementById('mobileMenu');
        const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
        if (mobileMenu && mobileMenu.classList.contains('active')) {
            mobileMenu.classList.remove('active');
            mobileMenuToggle.setAttribute('aria-expanded', 'false');
            document.body.style.overflow = '';
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

    // Initialize form and link handlers
    handleFormSubmissions();
    handleLinkLoading();

    // Preload critical pages
    if ('requestIdleCallback' in window) {
        requestIdleCallback(preloadCriticalPages);
    } else {
        setTimeout(preloadCriticalPages, 1000);
    }

    // Add touch support for mobile
    if ('ontouchstart' in window) {
        document.body.classList.add('touch-device');
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


