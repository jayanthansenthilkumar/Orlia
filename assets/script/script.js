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
    const countdownDate = new Date("April 2, 2025 09:00:00").getTime();
    
    function update() {
        const now = Date.now();
        const distance = countdownDate - now;
        
        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);
        
        // Update countdown elements
        const elements = document.querySelectorAll('.countdown-item span:first-child');
        const values = [days, hours, minutes, seconds];
        
        elements.forEach((element, index) => {
            if (element) {
                element.textContent = values[index].toString().padStart(2, '0');
            }
        });
    }
    
    // Run immediately
    update();
    
    // Update every second
    return setInterval(update, 1000);
}

// Initialize countdown
document.addEventListener('DOMContentLoaded', () => {
    const interval = updateCountdown();
    
    // Cleanup
    window.addEventListener('beforeunload', () => {
        clearInterval(interval);
    });
});
