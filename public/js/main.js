// Main Layout JavaScript - Responsive Navigation

document.addEventListener('DOMContentLoaded', function() {
    
    // Initialize
    initNavigation();
    initMobileMenu();
    initScrollEffects();
    initAnimations();
    
});

// ==================== NAVIGATION ====================

function initNavigation() {
    // Set active nav item based on current page
    const currentPath = window.location.pathname;
    const navLinks = document.querySelectorAll('.nav-link');
    const bottomNavItems = document.querySelectorAll('.bottom-nav-item');
    
    navLinks.forEach(link => {
        const href = link.getAttribute('href');
        if (currentPath === href || currentPath.includes(href)) {
            link.classList.add('active');
        }
    });
    
    bottomNavItems.forEach(item => {
        const href = item.getAttribute('href');
        if (href && (currentPath === href || currentPath.includes(href))) {
            item.classList.add('active');
        }
    });
    
    // Handle nav link clicks
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            // Remove active from all
            navLinks.forEach(l => l.classList.remove('active'));
            // Add active to clicked
            this.classList.add('active');
        });
    });
    
    bottomNavItems.forEach(item => {
        item.addEventListener('click', function(e) {
            // Skip logout button
            if (this.classList.contains('logout')) return;
            
            // Remove active from all
            bottomNavItems.forEach(i => i.classList.remove('active'));
            // Add active to clicked
            this.classList.add('active');
        });
    });
}

// ==================== MOBILE MENU ====================

function initMobileMenu() {
    const mobileToggle = document.querySelector('.mobile-toggle');
    const navMenu = document.querySelector('.nav-menu');
    
    if (!mobileToggle || !navMenu) return;
    
    // Toggle mobile menu
    mobileToggle.addEventListener('click', function() {
        navMenu.classList.toggle('show');
        this.classList.toggle('active');
        
        // Change icon
        const icon = this.querySelector('i');
        if (icon) {
            if (navMenu.classList.contains('show')) {
                icon.classList.remove('fa-bars');
                icon.classList.add('fa-times');
            } else {
                icon.classList.remove('fa-times');
                icon.classList.add('fa-bars');
            }
        }
    });
    
    // Close menu when clicking outside
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.desktop-navbar')) {
            navMenu.classList.remove('show');
            mobileToggle.classList.remove('active');
            const icon = mobileToggle.querySelector('i');
            if (icon) {
                icon.classList.remove('fa-times');
                icon.classList.add('fa-bars');
            }
        }
    });
    
    // Close menu when clicking a link
    const navLinks = navMenu.querySelectorAll('.nav-link');
    navLinks.forEach(link => {
        link.addEventListener('click', function() {
            navMenu.classList.remove('show');
            mobileToggle.classList.remove('active');
        });
    });
}

// ==================== SCROLL EFFECTS ====================

function initScrollEffects() {
    const navbar = document.querySelector('.desktop-navbar');
    
    if (!navbar) return;
    
    let lastScroll = 0;
    
    window.addEventListener('scroll', function() {
        const currentScroll = window.pageYOffset;
        
        // Add shadow on scroll
        if (currentScroll > 50) {
            navbar.style.boxShadow = '0 4px 20px rgba(0, 0, 0, 0.15)';
        } else {
            navbar.style.boxShadow = '0 2px 10px rgba(0, 0, 0, 0.1)';
        }
        
        // Hide navbar on scroll down (mobile only)
        if (window.innerWidth <= 768) {
            if (currentScroll > lastScroll && currentScroll > 100) {
                navbar.style.transform = 'translateY(-100%)';
            } else {
                navbar.style.transform = 'translateY(0)';
            }
        }
        
        lastScroll = currentScroll;
    });
}

// ==================== ANIMATIONS ====================

function initAnimations() {
    // Fade in elements on load
    const fadeElements = document.querySelectorAll('.fade-in');
    fadeElements.forEach((el, index) => {
        setTimeout(() => {
            el.style.opacity = '1';
            el.style.transform = 'translateY(0)';
        }, index * 100);
    });
    
    // Intersection Observer for scroll animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('slide-up');
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);
    
    // Observe elements with animate class
    document.querySelectorAll('.animate-on-scroll').forEach(el => {
        observer.observe(el);
    });
}

// ==================== LOGOUT CONFIRMATION ====================

function initLogoutConfirmation() {
    const logoutForms = document.querySelectorAll('form[action*="logout"]');
    
    logoutForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const confirm = window.confirm('Apakah Anda yakin ingin keluar?');
            if (!confirm) {
                e.preventDefault();
            }
        });
    });
}

// ==================== UTILITIES ====================

// Smooth scroll to element
function smoothScrollTo(element) {
    if (!element) return;
    
    element.scrollIntoView({
        behavior: 'smooth',
        block: 'start'
    });
}

// Show toast notification
function showToast(message, type = 'info') {
    // Create toast element
    const toast = document.createElement('div');
    toast.className = `toast toast-${type}`;
    toast.textContent = message;
    toast.style.cssText = `
        position: fixed;
        bottom: 90px;
        left: 50%;
        transform: translateX(-50%);
        background: ${type === 'success' ? '#2ecc71' : type === 'error' ? '#e74c3c' : '#3498db'};
        color: white;
        padding: 1rem 2rem;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        z-index: 9999;
        animation: slideUp 0.3s ease-out;
    `;
    
    document.body.appendChild(toast);
    
    // Remove after 3 seconds
    setTimeout(() => {
        toast.style.animation = 'fadeOut 0.3s ease-out';
        setTimeout(() => {
            toast.remove();
        }, 300);
    }, 3000);
}

// Detect device type
function isMobile() {
    return window.innerWidth <= 768;
}

function isTablet() {
    return window.innerWidth > 768 && window.innerWidth <= 968;
}

function isDesktop() {
    return window.innerWidth > 968;
}

// Handle window resize
let resizeTimer;
window.addEventListener('resize', function() {
    clearTimeout(resizeTimer);
    resizeTimer = setTimeout(function() {
        // Re-initialize on resize
        initNavigation();
    }, 250);
});

// ==================== BOTTOM NAV ACTIVE STATE ====================

// Update active state on route change (for SPA-like behavior)
function updateActiveNav(route) {
    const navLinks = document.querySelectorAll('.nav-link');
    const bottomNavItems = document.querySelectorAll('.bottom-nav-item');
    
    navLinks.forEach(link => {
        link.classList.remove('active');
        if (link.getAttribute('href') === route) {
            link.classList.add('active');
        }
    });
    
    bottomNavItems.forEach(item => {
        item.classList.remove('active');
        if (item.getAttribute('href') === route) {
            item.classList.add('active');
        }
    });
}

// ==================== PAGE LOAD ANIMATIONS ====================

window.addEventListener('load', function() {
    // Add loaded class to body
    document.body.classList.add('loaded');
    
    // Trigger entrance animations
    const welcomeSection = document.querySelector('.welcome-section');
    if (welcomeSection) {
        setTimeout(() => {
            welcomeSection.classList.add('fade-in');
        }, 100);
    }
});

// ==================== FORM VALIDATION HELPERS ====================

// Add validation to forms if needed
function validateForm(formElement) {
    const inputs = formElement.querySelectorAll('input[required], select[required], textarea[required]');
    let isValid = true;
    
    inputs.forEach(input => {
        if (!input.value.trim()) {
            isValid = false;
            input.classList.add('error');
        } else {
            input.classList.remove('error');
        }
    });
    
    return isValid;
}

// ==================== EXPORT FUNCTIONS ====================

// Make functions available globally if needed
window.dietGiziApp = {
    smoothScrollTo,
    showToast,
    updateActiveNav,
    validateForm,
    isMobile,
    isTablet,
    isDesktop
};
