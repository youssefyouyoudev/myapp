// Navigation toggle functionality
const navToggle = document.getElementById('navToggle');
const navMenu = document.getElementById('navMenu');

if (navToggle && navMenu) {
    navToggle.addEventListener('click', () => {
        navMenu.classList.toggle('active');
        navToggle.classList.toggle('active');
    });
}

// Close mobile menu when clicking on a link
document.querySelectorAll('.nav-link').forEach(link => {
    link.addEventListener('click', () => {
        if (navMenu && navToggle) {
            navMenu.classList.remove('active');
            navToggle.classList.remove('active');
        }
    });
});

// Smooth scroll for anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            const offset = 80;
            const targetPosition = target.offsetTop - offset;
            window.scrollTo({
                top: targetPosition,
                behavior: 'smooth'
            });
        }
    });
});

// Contact form submission
const contactForm = document.getElementById('contactForm');
if (contactForm) {
    contactForm.addEventListener('submit', function(e) {
        e.preventDefault();

        // Form validation
        const name = document.getElementById('name').value;
        const email = document.getElementById('email').value;
        const subject = document.getElementById('subject').value;
        const message = document.getElementById('message').value;

        if (!name || !email || !subject || !message) {
            window.showToast('Please fill in all fields');
            return;
        }

        // Show spinner
        window.showSpinner();

        // Get CSRF token
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // Send form data
        fetch('/contact', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                name: name,
                email: email,
                subject: subject,
                message: message
            })
        })
        .then(response => response.json())
        .then(data => {
            window.hideSpinner();
            if (data.success) {
                window.showToast('Thank you for your message! I will get back to you soon.');
                contactForm.reset();
            } else {
                window.showToast('Something went wrong. Please try again.');
            }
        })
        .catch(error => {
            window.hideSpinner();
            console.error('Error:', error);
            window.showToast('An error occurred. Please try again.');
        });
    });
}

// Navbar scroll effect
window.addEventListener('scroll', () => {
    const navbar = document.querySelector('.navbar');
    if (navbar) {
        if (window.scrollY > 50) {
            navbar.style.background = 'rgba(10, 10, 26, 0.95)';
            navbar.style.boxShadow = '0 4px 12px rgba(0, 0, 0, 0.3)';
        } else {
            navbar.style.background = 'rgba(10, 10, 26, 0.8)';
            navbar.style.boxShadow = 'none';
        }
    }
});

// Initialize animations when page loads
document.addEventListener('DOMContentLoaded', function() {
    // Add animation classes to elements
    const animatedElements = document.querySelectorAll('.project-card, .skill-category, .timeline-item, .education-card');
    animatedElements.forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(20px)';
        el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
    });

    // Intersection Observer for animations
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    });

    animatedElements.forEach(el => observer.observe(el));
});

// Animate theme toggle button
const themeToggle = document.getElementById('themeToggle');
if (themeToggle) {
    themeToggle.addEventListener('mousedown', () => {
        themeToggle.style.transform = 'scale(0.92)';
    });
    themeToggle.addEventListener('mouseup', () => {
        themeToggle.style.transform = 'scale(1)';
    });
    themeToggle.addEventListener('mouseleave', () => {
        themeToggle.style.transform = 'scale(1)';
    });
}

// Animate toast notifications
const toast = document.getElementById('globalToast');
if (toast) {
    toast.addEventListener('transitionend', () => {
        if (!toast.classList.contains('show')) {
            toast.textContent = '';
        }
    });
}

// Animate spinner loader
const spinner = document.getElementById('globalSpinner');
if (spinner) {
    spinner.querySelector('.loader').style.transition = 'transform 0.6s cubic-bezier(.4,0,.2,1)';
}

// Animate main content on theme change
document.documentElement.addEventListener('transitionrun', function(e) {
    if (e.propertyName === 'background') {
        document.querySelector('main').style.boxShadow = '0 2px 24px rgba(139,92,246,0.18)';
    }
});
document.documentElement.addEventListener('transitionend', function(e) {
    if (e.propertyName === 'background') {
        document.querySelector('main').style.boxShadow = '0 2px 16px rgba(0,0,0,0.07)';
    }
});
