@extends('layouts.app')

@section('title', 'Youssef Youyou - Fullstack & Android Developer Portfolio')

@section('content')
    <!-- Hero Section -->
    @include('sections.hero')

    <!-- About Section -->
    @include('sections.about')

    <!-- Skills Section -->
    @include('sections.skills')

    <!-- Projects Section -->
    @include('sections.projects')

    <!-- Experience Section -->
    @include('sections.experience')

    <!-- Contact Section -->
    @include('sections.contact')
@endsection

@push('styles')
<style>
    /* Additional styles for active navigation links */
    .nav-link.active {
        color: var(--color-primary);
        position: relative;
    }

    .nav-link.active::after {
        content: '';
        position: absolute;
        bottom: -5px;
        left: 0;
        width: 100%;
        height: 2px;
        background: var(--color-primary);
        border-radius: 1px;
    }

    /* Loading animation for form submission */
    .btn-loading {
        position: relative;
        color: transparent;
    }

    .btn-loading::after {
        content: '';
        position: absolute;
        left: 50%;
        top: 50%;
        width: 20px;
        height: 20px;
        margin-left: -10px;
        margin-top: -10px;
        border: 2px solid rgba(255, 255, 255, 0.3);
        border-top-color: white;
        border-radius: 50%;
        animation: spin 0.6s linear infinite;
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }

    /* Success/Error messages */
    .form-message {
        padding: var(--spacing-sm);
        border-radius: var(--radius-sm);
        margin-top: var(--spacing-md);
        display: none;
    }

    .form-message.success {
        background: rgba(34, 197, 94, 0.1);
        border: 1px solid rgba(34, 197, 94, 0.3);
        color: #22c55e;
    }

    .form-message.error {
        background: rgba(239, 68, 68, 0.1);
        border: 1px solid rgba(239, 68, 68, 0.3);
        color: #ef4444;
    }
</style>
@endpush

@push('scripts')
<script>
    // Mobile Navigation Toggle
    const navToggle = document.getElementById('navToggle');
    const navMenu = document.getElementById('navMenu');

    if (navToggle && navMenu) {
        navToggle.addEventListener('click', () => {
            navMenu.classList.toggle('active');
            navToggle.classList.toggle('active');
        });

        // Close menu when clicking outside
        document.addEventListener('click', (event) => {
            if (!navMenu.contains(event.target) && !navToggle.contains(event.target)) {
                navMenu.classList.remove('active');
                navToggle.classList.remove('active');
            }
        });
    }

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

    // Active navigation link on scroll
    const sections = document.querySelectorAll('section[id]');
    const navLinks = document.querySelectorAll('.nav-link');

    function highlightNavigation() {
        const scrollY = window.pageYOffset;

        sections.forEach(section => {
            const sectionHeight = section.offsetHeight;
            const sectionTop = section.offsetTop - 100;
            const sectionId = section.getAttribute('id');
            const navLink = document.querySelector(`.nav-link[href="#${sectionId}"]`);

            if (scrollY > sectionTop && scrollY <= sectionTop + sectionHeight) {
                navLinks.forEach(link => link.classList.remove('active'));
                navLink?.classList.add('active');
            }
        });

        // Handle home section
        if (scrollY < 100) {
            navLinks.forEach(link => link.classList.remove('active'));
            document.querySelector('.nav-link[href="#home"]')?.classList.add('active');
        }
    }

    window.addEventListener('scroll', highlightNavigation);

    // Contact Form Handling
    const contactForm = document.getElementById('contactForm');
    if (contactForm) {
        // Create message container
        const messageContainer = document.createElement('div');
        messageContainer.className = 'form-message';
        contactForm.appendChild(messageContainer);

        contactForm.addEventListener('submit', async function(e) {
            e.preventDefault();

            // Get form elements
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalBtnText = submitBtn.querySelector('.btn-text').textContent;
            const formData = new FormData(this);

            // Show loading state
            submitBtn.classList.add('btn-loading');
            submitBtn.disabled = true;

            try {
                const response = await fetch('/contact', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    },
                    body: formData
                });

                const data = await response.json();

                if (data.success) {
                    messageContainer.textContent = 'Thank you! Your message has been sent successfully.';
                    messageContainer.className = 'form-message success';
                    messageContainer.style.display = 'block';
                    contactForm.reset();

                    // Hide message after 5 seconds
                    setTimeout(() => {
                        messageContainer.style.display = 'none';
                    }, 5000);
                } else {
                    throw new Error(data.message || 'Something went wrong');
                }
            } catch (error) {
                messageContainer.textContent = error.message || 'An error occurred. Please try again.';
                messageContainer.className = 'form-message error';
                messageContainer.style.display = 'block';

                // Hide message after 5 seconds
                setTimeout(() => {
                    messageContainer.style.display = 'none';
                }, 5000);
            } finally {
                // Reset button state
                submitBtn.classList.remove('btn-loading');
                submitBtn.disabled = false;
                submitBtn.querySelector('.btn-text').textContent = originalBtnText;
            }
        });
    }

    // Intersection Observer for animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-in');
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    // Observe elements for animation
    document.querySelectorAll('.project-card, .skill-category, .timeline-item, .education-card, .contact-card').forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(20px)';
        el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(el);
    });

    // Navbar scroll effect
    window.addEventListener('scroll', () => {
        const navbar = document.querySelector('.navbar');
        if (navbar) {
            if (window.scrollY > 50) {
                navbar.style.background = 'rgba(10, 10, 26, 0.95)';
                navbar.style.boxShadow = '0 4px 12px rgba(0, 0, 0, 0.3)';
                navbar.style.backdropFilter = 'blur(10px)';
            } else {
                navbar.style.background = 'rgba(10, 10, 26, 0.8)';
                navbar.style.boxShadow = 'none';
                navbar.style.backdropFilter = 'blur(10px)';
            }
        }
    });

    // Initialize on page load
    document.addEventListener('DOMContentLoaded', () => {
        // Trigger initial scroll check
        highlightNavigation();

        // Add animation class for visible elements
        document.querySelectorAll('.project-card, .skill-category, .timeline-item, .education-card, .contact-card').forEach(el => {
            if (el.getBoundingClientRect().top < window.innerHeight * 0.8) {
                el.style.opacity = '1';
                el.style.transform = 'translateY(0)';
            }
        });
    });

    // Tech icons hover effect
    document.querySelectorAll('.tech-icon').forEach(icon => {
        icon.addEventListener('mouseenter', () => {
            icon.style.transform = 'translate(-50%, -50%) scale(1.2)';
        });

        icon.addEventListener('mouseleave', () => {
            icon.style.transform = 'translate(-50%, -50%) scale(1)';
        });
    });
</script>
@endpush
