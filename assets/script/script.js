// Theme Handling
const themeToggle = document.getElementById('theme-toggle');
const themeIcon = themeToggle?.querySelector('i');
const html = document.documentElement;

// Initialize Theme
const savedTheme = localStorage.getItem('theme') || 
                  (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');

setTheme(savedTheme);

function setTheme(theme) {
    html.setAttribute('data-theme', theme);
    localStorage.setItem('theme', theme);
    
    // Update Icon
    if (themeIcon) {
        if (theme === 'dark') {
            themeIcon.className = 'ri-sun-line';
        } else {
            themeIcon.className = 'ri-moon-line';
        }
    }
}

// Toggle Event
if (themeToggle) {
    themeToggle.addEventListener('click', () => {
        const currentTheme = html.getAttribute('data-theme');
        const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
        setTheme(newTheme);
    });
}

// Add smooth scrolling for all anchor links and buttons
document.querySelectorAll('a[href^="#"], .hero-btn').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
        e.preventDefault();
        
        // Get the target element
        const targetId = this.getAttribute('href')?.substring(1) || 
                        this.getAttribute('data-target');
        const targetElement = document.getElementById(targetId);
        if (targetElement) {
            targetElement.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
            // Close mobile menu if exists
            const mobileMenu = document.querySelector('.mobile-menu');
            if (mobileMenu && mobileMenu.classList.contains('active')) {
                mobileMenu.classList.remove('active');
            }
        }
    });
});

// Handle navigation for mobile
document.addEventListener("DOMContentLoaded", function () {
  const navLinks = document.querySelectorAll(".nav-links a");

  navLinks.forEach((link) => {
    link.addEventListener("click", function (e) {
      // Close mobile menu if it exists
      const mobileMenu = document.querySelector(".mobile-menu");
      if (mobileMenu && mobileMenu.classList.contains("active")) {
        mobileMenu.classList.remove("active");
      }
    });
  });
});

function updateCountdown() {
    try {
        const targetDate = new Date('April 3, 2025 00:00:00').getTime();
        
        // Update every second
        const timer = setInterval(() => {
            try {
                const now = new Date().getTime();
                const distance = targetDate - now;

                // Calculate time units
                const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                // Update DOM elements with leading zeros
                const daysEl = document.getElementById('days');
                const hoursEl = document.getElementById('hours');
                const minutesEl = document.getElementById('minutes');
                const secondsEl = document.getElementById('seconds');

                if (daysEl) daysEl.innerText = days.toString().padStart(2, '0');
                if (hoursEl) hoursEl.innerText = hours.toString().padStart(2, '0');
                if (minutesEl) minutesEl.innerText = minutes.toString().padStart(2, '0');
                if (secondsEl) secondsEl.innerText = seconds.toString().padStart(2, '0');

                // Check if countdown is over
                if (distance < 0) {
                    clearInterval(timer);
                    if (daysEl) daysEl.innerText = '00';
                    if (hoursEl) hoursEl.innerText = '00';
                    if (minutesEl) minutesEl.innerText = '00';
                    if (secondsEl) secondsEl.innerText = '00';
                }
            } catch (error) {
                console.error('Error updating countdown:', error);
            }
        }, 1000);

        // Initial update
        updateCountdownDisplay();
    } catch (error) {
        console.error('Error initializing countdown:', error);
        // Fallback display
        setFallbackCountdown();
    }
}

function updateCountdownDisplay() {
    const now = new Date().getTime();
    const targetDate = new Date('April 3, 2025 00:00:00').getTime();
    const distance = targetDate - now;

    const days = Math.floor(distance / (1000 * 60 * 60 * 24));
    const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    const seconds = Math.floor((distance % (1000 * 60)) / 1000);

    const daysEl = document.getElementById('days');
    const hoursEl = document.getElementById('hours');
    const minutesEl = document.getElementById('minutes');
    const secondsEl = document.getElementById('seconds');

    if (daysEl) daysEl.innerText = days.toString().padStart(2, '0');
    if (hoursEl) hoursEl.innerText = hours.toString().padStart(2, '0');
    if (minutesEl) minutesEl.innerText = minutes.toString().padStart(2, '0');
    if (secondsEl) secondsEl.innerText = seconds.toString().padStart(2, '0');
}

function setFallbackCountdown() {
    const elements = ['days', 'hours', 'minutes', 'seconds'];
    elements.forEach(id => {
        const element = document.getElementById(id);
        if (element) element.innerText = '00';
    });
}

// Initialize countdown when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    updateCountdown();
    
    // Backup check for mobile Chrome
    setTimeout(() => {
        const daysElement = document.getElementById('days');
        if (daysElement && daysElement.innerText === '00') {
            updateCountdown();
        }
    }, 1000);

    // Footer Update
    updateFooter();
});

// Add visibility change handler for mobile browsers
document.addEventListener('visibilitychange', () => {
    if (!document.hidden) {
        updateCountdownDisplay();
    }
});

function updateFooter() {
    const footerElement = document.querySelector('.single-line-footer p');
    if (footerElement) {
        const currentYear = new Date().getFullYear();
        footerElement.innerHTML = `&copy; ${currentYear} TECHNOLOGY INNOVATION HUB. All Rights Reserved.`;
    }
}

// Active Navigation Highlight
function initActiveNavigation() {
    const sections = document.querySelectorAll('section');
    const navLinks = document.querySelectorAll('.nav-links li a');
    
    if (sections.length === 0) return;

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const id = entry.target.getAttribute('id');
                navLinks.forEach(link => {
                    // Check if link href contains the id
                    const href = link.getAttribute('href');
                    if (href.includes(`#${id}`)) {
                        // Remove active from all others first? 
                        // It's safer to remove active from all whenever a new one is set
                         navLinks.forEach(l => l.classList.remove('active'));
                         link.classList.add('active');
                    }
                });
            }
        });
    }, {
        rootMargin: '-50% 0px -50% 0px' // Center line detection
    });

    sections.forEach(section => {
        observer.observe(section);
    });
}

document.addEventListener('DOMContentLoaded', () => {
    initActiveNavigation();
});
