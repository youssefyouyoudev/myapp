<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youssef Youyou - Fullstack & Android Developer</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
<script src="{{ asset('js/app.js') }}"></script>

    <style>
        /* Reset & Base Styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

:root {
    /* Colors - Dark Cosmic Theme */
    --color-primary: #8B5CF6;
    --color-secondary: #3B82F6;
    --color-accent: #06B6D4;
    --color-background: #0a0a1a;
    --color-surface: #1a1a2e;
    --color-surface-light: #252540;
    --color-text: #ffffff;
    --color-text-secondary: #9ca3af;
    --color-border: rgba(139, 92, 246, 0.2);

    /* Typography */
    --font-sans: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', 'Oxygen', 'Ubuntu', 'Cantarell', sans-serif;
    --font-mono: 'Monaco', 'Courier New', monospace;

    /* Spacing */
    --spacing-xs: 0.5rem;
    --spacing-sm: 1rem;
    --spacing-md: 1.5rem;
    --spacing-lg: 2rem;
    --spacing-xl: 3rem;
    --spacing-2xl: 4rem;

    /* Border Radius */
    --radius-sm: 0.5rem;
    --radius-md: 0.75rem;
    --radius-lg: 1rem;

    /* Transitions */
    --transition: all 0.3s ease;
}

html {
    scroll-behavior: smooth;
}

body {
    font-family: var(--font-sans);
    background: var(--color-background);
    color: var(--color-text);
    line-height: 1.6;
    overflow-x: hidden;
}

a {
    color: inherit;
    text-decoration: none;
}

img {
    max-width: 100%;
    height: auto;
    display: block;
}

/* Container */
.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 var(--spacing-md);
}

/* Navigation */
.navbar {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    background: rgba(10, 10, 26, 0.8);
    backdrop-filter: blur(10px);
    border-bottom: 1px solid var(--color-border);
    z-index: 1000;
    padding: var(--spacing-md) 0;
}

.nav-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 var(--spacing-md);
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: var(--spacing-lg);
}

.nav-logo {
    display: flex;
    align-items: center;
    gap: var(--spacing-sm);
    font-size: 1.25rem;
    font-weight: 700;
}

.logo-icon {
    width: 40px;
    height: 40px;
}

.nav-menu {
    display: flex;
    list-style: none;
    gap: var(--spacing-lg);
    margin: 0;
}

.nav-link {
    color: var(--color-text-secondary);
    transition: var(--transition);
    font-size: 0.95rem;
}

.nav-link:hover {
    color: var(--color-primary);
}

.nav-social {
    display: flex;
    gap: var(--spacing-md);
}

.nav-social a {
    color: var(--color-text-secondary);
    transition: var(--transition);
}

.nav-social a:hover {
    color: var(--color-primary);
    transform: translateY(-2px);
}

.nav-toggle {
    display: none;
    flex-direction: column;
    gap: 4px;
    background: none;
    border: none;
    cursor: pointer;
    padding: 4px;
}

.nav-toggle span {
    width: 24px;
    height: 2px;
    background: var(--color-text);
    border-radius: 2px;
    transition: var(--transition);
}

/* Hero Section */
.hero {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    overflow: hidden;
    padding-top: 80px;
}

.stars {
    position: absolute;
    inset: 0;
    background-image:
        radial-gradient(2px 2px at 20px 30px, white, transparent),
        radial-gradient(2px 2px at 60px 70px, white, transparent),
        radial-gradient(1px 1px at 50px 50px, white, transparent),
        radial-gradient(1px 1px at 130px 80px, white, transparent),
        radial-gradient(2px 2px at 90px 10px, white, transparent);
    background-size: 200px 200px;
    animation: twinkle 20s linear infinite;
    opacity: 0.5;
}

@keyframes twinkle {
    from { transform: translate(0, 0); }
    to { transform: translate(-200px, -200px); }
}

.hero-container {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: var(--spacing-2xl);
    align-items: center;
    position: relative;
    z-index: 1;
}

.hero-content {
    max-width: 600px;
}

.hero-badge {
    display: inline-flex;
    align-items: center;
    gap: var(--spacing-xs);
    padding: var(--spacing-xs) var(--spacing-md);
    background: rgba(139, 92, 246, 0.1);
    border: 1px solid var(--color-border);
    border-radius: 2rem;
    font-size: 0.875rem;
    color: var(--color-primary);
    margin-bottom: var(--spacing-lg);
}

.hero-title {
    font-size: 3.5rem;
    font-weight: 700;
    line-height: 1.1;
    margin-bottom: var(--spacing-md);
}

.gradient-text {
    background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-secondary) 50%, var(--color-accent) 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.hero-description {
    font-size: 1.125rem;
    color: var(--color-text-secondary);
    margin-bottom: var(--spacing-xl);
    line-height: 1.6;
}

.hero-buttons {
    display: flex;
    gap: var(--spacing-md);
}

.btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 0.875rem 1.75rem;
    border-radius: var(--radius-md);
    font-size: 1rem;
    font-weight: 600;
    transition: var(--transition);
    cursor: pointer;
    border: none;
}

.btn-primary {
    background: linear-gradient(135deg, var(--color-primary), var(--color-secondary));
    color: white;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 30px rgba(139, 92, 246, 0.3);
}

.btn-secondary {
    background: transparent;
    color: var(--color-text);
    border: 2px solid var(--color-border);
}

.btn-secondary:hover {
    border-color: var(--color-primary);
    background: rgba(139, 92, 246, 0.1);
}

/* Hero Visual */
.hero-visual {
    position: relative;
    height: 500px;
}

.cosmic-orb {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 300px;
    height: 300px;
    background: radial-gradient(circle, rgba(139, 92, 246, 0.4) 0%, rgba(59, 130, 246, 0.2) 50%, transparent 70%);
    border-radius: 50%;
    animation: pulse 3s ease-in-out infinite;
}

@keyframes pulse {
    0%, 100% { transform: translate(-50%, -50%) scale(1); opacity: 0.8; }
    50% { transform: translate(-50%, -50%) scale(1.1); opacity: 1; }
}

.tech-icons {
    position: relative;
    width: 100%;
    height: 100%;
}

.tech-icon {
    position: absolute;
    top: 50%;
    left: 50%;
    animation: orbit 20s linear infinite;
    animation-delay: var(--delay);
}

@keyframes orbit {
    from {
        transform: translate(-50%, -50%) translate(var(--x), var(--y)) rotate(0deg);
    }
    to {
        transform: translate(-50%, -50%) translate(var(--x), var(--y)) rotate(360deg);
    }
}

.tech-icon svg {
    filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.3));
}

/* Sections */
.section {
    padding: var(--spacing-2xl) 0;
}

.section-alt {
    background: var(--color-surface);
}

.section-header {
    text-align: center;
    margin-bottom: var(--spacing-2xl);
}

.section-label {
    display: inline-block;
    padding: var(--spacing-xs) var(--spacing-md);
    background: rgba(139, 92, 246, 0.1);
    border: 1px solid var(--color-border);
    border-radius: 2rem;
    font-size: 0.875rem;
    color: var(--color-primary);
    margin-bottom: var(--spacing-md);
}

.section-title {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: var(--spacing-md);
}

.section-description {
    font-size: 1.125rem;
    color: var(--color-text-secondary);
    max-width: 600px;
    margin: 0 auto;
}

/* About Section */
.about-grid {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: var(--spacing-2xl);
}

.about-subtitle {
    font-size: 1.5rem;
    margin-bottom: var(--spacing-md);
}

.about-text {
    color: var(--color-text-secondary);
    margin-bottom: var(--spacing-md);
    line-height: 1.8;
}

.about-stats {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: var(--spacing-lg);
    margin-top: var(--spacing-xl);
}

.stat-item {
    text-align: center;
    padding: var(--spacing-md);
    background: rgba(139, 92, 246, 0.1);
    border: 1px solid var(--color-border);
    border-radius: var(--radius-md);
}

.stat-number {
    font-size: 2rem;
    font-weight: 700;
    background: linear-gradient(135deg, var(--color-primary), var(--color-secondary));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.stat-label {
    font-size: 0.875rem;
    color: var(--color-text-secondary);
}

.info-card {
    background: var(--color-surface);
    border: 1px solid var(--color-border);
    border-radius: var(--radius-lg);
    padding: var(--spacing-lg);
    margin-bottom: var(--spacing-md);
}

.info-title {
    font-size: 1.125rem;
    margin-bottom: var(--spacing-md);
}

.info-items {
    display: flex;
    flex-direction: column;
    gap: var(--spacing-md);
}

.info-item {
    display: flex;
    align-items: center;
    gap: var(--spacing-sm);
    color: var(--color-text-secondary);
}

.info-item svg {
    color: var(--color-primary);
    flex-shrink: 0;
}

.language-list {
    display: flex;
    flex-direction: column;
    gap: var(--spacing-sm);
}

.language-item {
    display: flex;
    justify-content: space-between;
    padding: var(--spacing-sm);
    background: var(--color-surface-light);
    border-radius: var(--radius-sm);
}

.language-level {
    color: var(--color-primary);
    font-size: 0.875rem;
}

/* Skills Section */
.skills-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: var(--spacing-lg);
}

.skill-category {
    background: var(--color-surface);
    border: 1px solid var(--color-border);
    border-radius: var(--radius-lg);
    padding: var(--spacing-lg);
    transition: var(--transition);
}

.skill-category:hover {
    border-color: var(--color-primary);
    transform: translateY(-4px);
}

.skill-category-header {
    display: flex;
    align-items: center;
    gap: var(--spacing-sm);
    margin-bottom: var(--spacing-md);
}

.skill-category-header svg {
    color: var(--color-primary);
}

.skill-category-header h3 {
    font-size: 1.25rem;
}

.skill-items {
    display: flex;
    flex-wrap: wrap;
    gap: var(--spacing-xs);
}

.skill-tag {
    padding: var(--spacing-xs) var(--spacing-md);
    background: rgba(139, 92, 246, 0.1);
    border: 1px solid var(--color-border);
    border-radius: 2rem;
    font-size: 0.875rem;
    color: var(--color-text);
    transition: var(--transition);
}

.skill-tag:hover {
    background: rgba(139, 92, 246, 0.2);
    border-color: var(--color-primary);
}

/* Projects Section */
.projects-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    gap: var(--spacing-lg);
}

.project-card {
    background: var(--color-surface);
    border: 1px solid var(--color-border);
    border-radius: var(--radius-lg);
    overflow: hidden;
    transition: var(--transition);
}

.project-card:hover {
    transform: translateY(-8px);
    border-color: var(--color-primary);
    box-shadow: 0 20px 40px rgba(139, 92, 246, 0.2);
}

.project-image {
    position: relative;
    height: 200px;
    overflow: hidden;
}

.project-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: var(--transition);
}

.project-card:hover .project-image img {
    transform: scale(1.1);
}

.project-overlay {
    position: absolute;
    inset: 0;
    background: rgba(10, 10, 26, 0.8);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: var(--transition);
}

.project-card:hover .project-overlay {
    opacity: 1;
}

.project-link {
    padding: var(--spacing-sm) var(--spacing-lg);
    background: var(--color-primary);
    color: white;
    border-radius: var(--radius-md);
    font-weight: 600;
}

.project-content {
    padding: var(--spacing-lg);
}

.project-title {
    font-size: 1.25rem;
    margin-bottom: var(--spacing-sm);
}

.project-description {
    color: var(--color-text-secondary);
    margin-bottom: var(--spacing-md);
    font-size: 0.95rem;
    line-height: 1.6;
}

.project-tech {
    display: flex;
    flex-wrap: wrap;
    gap: var(--spacing-xs);
}

.tech-badge {
    padding: 0.25rem 0.75rem;
    background: rgba(139, 92, 246, 0.1);
    border: 1px solid var(--color-border);
    border-radius: 2rem;
    font-size: 0.75rem;
    color: var(--color-primary);
}

/* Experience Section */
.timeline {
    max-width: 900px;
    margin: 0 auto var(--spacing-2xl);
    position: relative;
}

.timeline::before {
    content: '';
    position: absolute;
    left: 20px;
    top: 0;
    bottom: 0;
    width: 2px;
    background: var(--color-border);
}

.timeline-item {
    position: relative;
    padding-left: 60px;
    margin-bottom: var(--spacing-xl);
}

.timeline-marker {
    position: absolute;
    left: 12px;
    top: 0;
    width: 18px;
    height: 18px;
    background: var(--color-primary);
    border: 3px solid var(--color-background);
    border-radius: 50%;
    z-index: 1;
}

.timeline-content {
    background: var(--color-surface);
    border: 1px solid var(--color-border);
    border-radius: var(--radius-lg);
    padding: var(--spacing-lg);
}

.timeline-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: var(--spacing-sm);
    flex-wrap: wrap;
    gap: var(--spacing-sm);
}

.timeline-title {
    font-size: 1.25rem;
    color: var(--color-primary);
}

.timeline-date {
    font-size: 0.875rem;
    color: var(--color-text-secondary);
}

.timeline-company {
    font-weight: 600;
    margin-bottom: var(--spacing-sm);
}

.timeline-description {
    color: var(--color-text-secondary);
    line-height: 1.6;
}

/* Education Section */
.education-section {
    max-width: 900px;
    margin: 0 auto;
}

.education-title {
    font-size: 2rem;
    text-align: center;
    margin-bottom: var(--spacing-xl);
}

.education-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: var(--spacing-lg);
}

.education-card {
    background: var(--color-surface);
    border: 1px solid var(--color-border);
    border-radius: var(--radius-lg);
    padding: var(--spacing-lg);
    display: flex;
    gap: var(--spacing-md);
    transition: var(--transition);
}

.education-card:hover {
    border-color: var(--color-primary);
    transform: translateY(-4px);
}

.education-icon {
    flex-shrink: 0;
    width: 48px;
    height: 48px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(139, 92, 246, 0.1);
    border-radius: var(--radius-md);
    color: var(--color-primary);
}

.education-degree {
    font-size: 1rem;
    margin-bottom: var(--spacing-xs);
}

.education-school {
    font-size: 0.875rem;
    color: var(--color-text-secondary);
    margin-bottom: var(--spacing-xs);
}

.education-year {
    font-size: 0.75rem;
    color: var(--color-primary);
}

/* Contact Section */
.contact-grid {
    display: grid;
    grid-template-columns: 1fr 2fr;
    gap: var(--spacing-2xl);
    max-width: 1000px;
    margin: 0 auto;
}

.contact-card {
    display: flex;
    align-items: flex-start;
    gap: var(--spacing-md);
    padding: var(--spacing-lg);
    background: var(--color-surface);
    border: 1px solid var(--color-border);
    border-radius: var(--radius-lg);
    margin-bottom: var(--spacing-md);
}

.contact-icon {
    flex-shrink: 0;
    width: 48px;
    height: 48px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(139, 92, 246, 0.1);
    border-radius: var(--radius-md);
    color: var(--color-primary);
}

.contact-card h4 {
    font-size: 1rem;
    margin-bottom: var(--spacing-xs);
}

.contact-card a {
    color: var(--color-text-secondary);
    transition: var(--transition);
}

.contact-card a:hover {
    color: var(--color-primary);
}

.contact-social {
    padding: var(--spacing-lg);
    background: var(--color-surface);
    border: 1px solid var(--color-border);
    border-radius: var(--radius-lg);
}

.contact-social h4 {
    margin-bottom: var(--spacing-md);
}

.social-links {
    display: flex;
    gap: var(--spacing-md);
}

.social-links a {
    width: 48px;
    height: 48px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(139, 92, 246, 0.1);
    border: 1px solid var(--color-border);
    border-radius: var(--radius-md);
    color: var(--color-text-secondary);
    transition: var(--transition);
}

.social-links a:hover {
    background: var(--color-primary);
    color: white;
    transform: translateY(-4px);
}

/* Contact Form */
.contact-form {
    background: var(--color-surface);
    border: 1px solid var(--color-border);
    border-radius: var(--radius-lg);
    padding: var(--spacing-xl);
}

.form-group {
    margin-bottom: var(--spacing-md);
}

.form-group label {
    display: block;
    margin-bottom: var(--spacing-xs);
    font-weight: 600;
    color: var(--color-text);
}

.form-group input,
.form-group textarea {
    width: 100%;
    padding: var(--spacing-sm);
    background: var(--color-surface-light);
    border: 1px solid var(--color-border);
    border-radius: var(--radius-sm);
    color: var(--color-text);
    font-family: inherit;
    font-size: 1rem;
    transition: var(--transition);
}

.form-group input:focus,
.form-group textarea:focus {
    outline: none;
    border-color: var(--color-primary);
    box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.1);
}

.form-group textarea {
    resize: vertical;
}

/* Footer */
.footer {
    background: var(--color-surface);
    border-top: 1px solid var(--color-border);
    padding: var(--spacing-xl) 0;
    text-align: center;
}

.footer-content p {
    color: var(--color-text-secondary);
    margin-bottom: var(--spacing-xs);
}

/* Responsive Design */
@media (max-width: 1024px) {
    .hero-title {
        font-size: 2.5rem;
    }

    .about-grid,
    .contact-grid {
        grid-template-columns: 1fr;
    }

    .hero-container {
        grid-template-columns: 1fr;
    }

    .hero-visual {
        display: none;
    }
}

@media (max-width: 768px) {
    .nav-menu {
        position: fixed;
        top: 80px;
        left: 0;
        right: 0;
        flex-direction: column;
        background: rgba(10, 10, 26, 0.98);
        padding: var(--spacing-lg);
        border-bottom: 1px solid var(--color-border);
        transform: translateY(-100%);
        opacity: 0;
        visibility: hidden;
        transition: var(--transition);
    }

    .nav-menu.active {
        transform: translateY(0);
        opacity: 1;
        visibility: visible;
    }

    .nav-toggle {
        display: flex;
    }

    .nav-social {
        display: none;
    }

    .hero-title {
        font-size: 2rem;
    }

    .section-title {
        font-size: 2rem;
    }

    .about-stats {
        grid-template-columns: 1fr;
    }

    .skills-grid,
    .projects-grid {
        grid-template-columns: 1fr;
    }

    .timeline::before {
        left: 10px;
    }

    .timeline-item {
        padding-left: 40px;
    }

    .timeline-marker {
        left: 5px;
    }

    .education-grid {
        grid-template-columns: 1fr;
    }
}

    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="nav-container">
            <div class="nav-logo">
                <div class="logo-icon">
                    <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect width="40" height="40" rx="8" fill="url(#gradient)"/>
                        <text x="20" y="28" text-anchor="middle" fill="white" font-size="20" font-weight="bold">Y</text>
                        <defs>
                            <linearGradient id="gradient" x1="0" y1="0" x2="40" y2="40">
                                <stop offset="0%" stop-color="#8B5CF6"/>
                                <stop offset="100%" stop-color="#3B82F6"/>
                            </linearGradient>
                        </defs>
                    </svg>
                </div>
                <span class="nav-name">Youssef Youyou</span>
            </div>

            <ul class="nav-menu" id="navMenu">
                <li><a href="#about" class="nav-link">About me</a></li>
                <li><a href="#skills" class="nav-link">Skills</a></li>
                <li><a href="#projects" class="nav-link">Projects</a></li>
                <li><a href="#experience" class="nav-link">Experience</a></li>
                <li><a href="#contact" class="nav-link">Contact</a></li>
            </ul>

            <div class="nav-social">
                <a href="https://instagram.com" target="_blank" aria-label="Instagram">
                    <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                </a>
                <a href="https://facebook.com" target="_blank" aria-label="Facebook">
                    <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                </a>
                <a href="https://twitter.com" target="_blank" aria-label="Twitter">
                    <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                </a>
            </div>

            <button class="nav-toggle" id="navToggle" aria-label="Toggle navigation">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero" id="home">
        <div class="stars"></div>
        <div class="hero-container">
            <div class="hero-content">
                <div class="hero-badge">
                    <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                    <span>Fullstack Developer Portfolio</span>
                </div>

                <h1 class="hero-title">
                    Providing <span class="gradient-text">the best</span>
                    <br>project experience.
                </h1>

                <p class="hero-description">
                    I'm a Full Stack Web Developer and Android Developer with experience in Website, Mobile,
                    and Software development. Check out my projects and skills.
                </p>

                <div class="hero-buttons">
                    <a href="#about" class="btn btn-primary">Learn more</a>
                    <a href="#contact" class="btn btn-secondary">Get in touch</a>
                </div>
            </div>

            <div class="hero-visual">
                <div class="cosmic-orb"></div>
                <div class="tech-icons">
                    <div class="tech-icon" style="--delay: 0s; --x: 120px; --y: -80px;">
                        <svg width="48" height="48" viewBox="0 0 48 48" fill="none">
                            <rect width="48" height="48" rx="12" fill="#1a1a2e"/>
                            <text x="24" y="32" text-anchor="middle" fill="#61dafb" font-size="16" font-weight="bold">JS</text>
                        </svg>
                    </div>
                    <div class="tech-icon" style="--delay: 0.5s; --x: -100px; --y: -60px;">
                        <svg width="48" height="48" viewBox="0 0 48 48" fill="none">
                            <rect width="48" height="48" rx="12" fill="#1a1a2e"/>
                            <text x="24" y="32" text-anchor="middle" fill="#3178c6" font-size="16" font-weight="bold">TS</text>
                        </svg>
                    </div>
                    <div class="tech-icon" style="--delay: 1s; --x: 140px; --y: 80px;">
                        <svg width="48" height="48" viewBox="0 0 48 48" fill="none">
                            <rect width="48" height="48" rx="12" fill="#1a1a2e"/>
                            <path d="M24 12L14 18v12l10 6 10-6V18l-10-6z" fill="#FF2D20"/>
                        </svg>
                    </div>
                    <div class="tech-icon" style="--delay: 1.5s; --x: -110px; --y: 90px;">
                        <svg width="48" height="48" viewBox="0 0 48 48" fill="none">
                            <rect width="48" height="48" rx="12" fill="#1a1a2e"/>
                            <circle cx="24" cy="24" r="8" stroke="#61dafb" stroke-width="1.5" fill="none"/>
                            <circle cx="24" cy="24" r="2" fill="#61dafb"/>
                        </svg>
                    </div>
                    <div class="tech-icon" style="--delay: 2s; --x: 0px; --y: -120px;">
                        <svg width="48" height="48" viewBox="0 0 48 48" fill="none">
                            <rect width="48" height="48" rx="12" fill="#1a1a2e"/>
                            <path d="M24 16l-8 8 8 8 8-8-8-8z" fill="#A259FF"/>
                        </svg>
                    </div>
                    <div class="tech-icon" style="--delay: 2.5s; --x: 0px; --y: 130px;">
                        <svg width="48" height="48" viewBox="0 0 48 48" fill="none">
                            <rect width="48" height="48" rx="12" fill="#1a1a2e"/>
                            <path d="M24 12l-4 12h8l-4 12 8-12h-8l4-12z" fill="#F7DF1E"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="section" id="about">
        <div class="container">
            <div class="section-header">
                <span class="section-label">About</span>
                <h2 class="section-title">Get to know me</h2>
            </div>

            <div class="about-grid">
                <div class="about-content">
                    <h3 class="about-subtitle">Hi, I'm Youssef Youyou</h3>
                    <p class="about-text">
                        A passionate Fullstack Web Developer and Android Developer with expertise in building
                        modern web applications and mobile solutions. I specialize in Laravel, React, and Kotlin,
                        creating seamless user experiences from concept to deployment.
                    </p>
                    <p class="about-text">
                        With hands-on experience in both frontend and backend development, I bring ideas to life
                        through clean code, thoughtful design, and robust architecture. I'm constantly learning
                        and adapting to new technologies to deliver the best solutions.
                    </p>

                    <div class="about-stats">
                        <div class="stat-item">
                            <div class="stat-number">2+</div>
                            <div class="stat-label">Years Experience</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">15+</div>
                            <div class="stat-label">Projects Completed</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">10+</div>
                            <div class="stat-label">Technologies</div>
                        </div>
                    </div>
                </div>

                <div class="about-info">
                    <div class="info-card">
                        <h4 class="info-title">Contact Information</h4>
                        <div class="info-items">
                            <div class="info-item">
                                <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                                </svg>
                                <span>contact@youssefyouyou.com</span>
                            </div>
                            <div class="info-item">
                                <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                                </svg>
                                <span>+212 610 090 070</span>
                            </div>
                            <div class="info-item">
                                <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                                </svg>
                                <span>Morocco</span>
                            </div>
                        </div>
                    </div>

                    <div class="info-card">
                        <h4 class="info-title">Languages</h4>
                        <div class="language-list">
                            <div class="language-item">
                                <span>Arabic</span>
                                <span class="language-level">Native</span>
                            </div>
                            <div class="language-item">
                                <span>French</span>
                                <span class="language-level">Fluent</span>
                            </div>
                            <div class="language-item">
                                <span>English</span>
                                <span class="language-level">Professional</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Skills Section -->
    <section class="section section-alt" id="skills">
        <div class="container">
            <div class="section-header">
                <span class="section-label">Skills</span>
                <h2 class="section-title">Technologies I work with</h2>
            </div>

            <div class="skills-grid">
                <div class="skill-category">
                    <div class="skill-category-header">
                        <svg width="24" height="24" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M12.316 3.051a1 1 0 01.633 1.265l-4 12a1 1 0 11-1.898-.632l4-12a1 1 0 011.265-.633zM5.707 6.293a1 1 0 010 1.414L3.414 10l2.293 2.293a1 1 0 11-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0zm8.586 0a1 1 0 011.414 0l3 3a1 1 0 010 1.414l-3 3a1 1 0 11-1.414-1.414L16.586 10l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                        </svg>
                        <h3>Frontend Development</h3>
                    </div>
                    <div class="skill-items">
                        <span class="skill-tag">HTML5</span>
                        <span class="skill-tag">CSS3</span>
                        <span class="skill-tag">JavaScript</span>
                        <span class="skill-tag">React</span>
                        <span class="skill-tag">TypeScript</span>
                        <span class="skill-tag">Tailwind CSS</span>
                        <span class="skill-tag">Bootstrap</span>
                        <span class="skill-tag">Vue.js</span>
                    </div>
                </div>

                <div class="skill-category">
                    <div class="skill-category-header">
                        <svg width="24" height="24" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M2 5a2 2 0 012-2h12a2 2 0 012 2v10a2 2 0 01-2 2H4a2 2 0 01-2-2V5zm3.293 1.293a1 1 0 011.414 0l3 3a1 1 0 010 1.414l-3 3a1 1 0 01-1.414-1.414L7.586 10 5.293 7.707a1 1 0 010-1.414zM11 12a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/>
                        </svg>
                        <h3>Backend Development</h3>
                    </div>
                    <div class="skill-items">
                        <span class="skill-tag">PHP</span>
                        <span class="skill-tag">Laravel</span>
                        <span class="skill-tag">MySQL</span>
                        <span class="skill-tag">Node.js</span>
                        <span class="skill-tag">Express</span>
                        <span class="skill-tag">MongoDB</span>
                        <span class="skill-tag">REST API</span>
                        <span class="skill-tag">GraphQL</span>
                    </div>
                </div>

                <div class="skill-category">
                    <div class="skill-category-header">
                        <svg width="24" height="24" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                        </svg>
                        <h3>Mobile Development</h3>
                    </div>
                    <div class="skill-items">
                        <span class="skill-tag">Android</span>
                        <span class="skill-tag">Kotlin</span>
                        <span class="skill-tag">Java</span>
                        <span class="skill-tag">React Native</span>
                        <span class="skill-tag">Flutter</span>
                    </div>
                </div>

                <div class="skill-category">
                    <div class="skill-category-header">
                        <svg width="24" height="24" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v3.586l-1.293-1.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V8z" clip-rule="evenodd"/>
                        </svg>
                        <h3>Tools & DevOps</h3>
                    </div>
                    <div class="skill-items">
                        <span class="skill-tag">Git</span>
                        <span class="skill-tag">GitHub</span>
                        <span class="skill-tag">CI/CD</span>
                        <span class="skill-tag">Docker</span>
                        <span class="skill-tag">AWS</span>
                        <span class="skill-tag">Linux</span>
                        <span class="skill-tag">DevOps</span>
                    </div>
                </div>

                <div class="skill-category">
                    <div class="skill-category-header">
                        <svg width="24" height="24" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                            <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/>
                        </svg>
                        <h3>Other Skills</h3>
                    </div>
                    <div class="skill-items">
                        <span class="skill-tag">UML</span>
                        <span class="skill-tag">Agile</span>
                        <span class="skill-tag">Scrum</span>
                        <span class="skill-tag">Team Work</span>
                        <span class="skill-tag">Leadership</span>
                        <span class="skill-tag">Problem Solving</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Projects Section -->
    <section class="section" id="projects">
        <div class="container">
            <div class="section-header">
                <span class="section-label">Projects</span>
                <h2 class="section-title">Featured work</h2>
            </div>

            <div class="projects-grid">
                <div class="project-card">
                    <div class="project-image">
                        <img src="/placeholder.svg?height=300&width=500" alt="EduManager">
                        <div class="project-overlay">
                            <a href="#" class="project-link">View Project</a>
                        </div>
                    </div>
                    <div class="project-content">
                        <h3 class="project-title">EduManager</h3>
                        <p class="project-description">
                            A comprehensive education management system built with Laravel and MySQL.
                            Features include student enrollment, grade tracking, attendance management, and reporting.
                        </p>
                        <div class="project-tech">
                            <span class="tech-badge">Laravel</span>
                            <span class="tech-badge">MySQL</span>
                            <span class="tech-badge">Bootstrap</span>
                        </div>
                    </div>
                </div>

                <div class="project-card">
                    <div class="project-image">
                        <img src="/placeholder.svg?height=300&width=500" alt="ECars">
                        <div class="project-overlay">
                            <a href="#" class="project-link">View Project</a>
                        </div>
                    </div>
                    <div class="project-content">
                        <h3 class="project-title">ECars - Car Rental Platform</h3>
                        <p class="project-description">
                            Modern car rental platform using MERN stack. Users can browse available vehicles,
                            make reservations, and manage bookings with an intuitive interface.
                        </p>
                        <div class="project-tech">
                            <span class="tech-badge">MongoDB</span>
                            <span class="tech-badge">Express</span>
                            <span class="tech-badge">React</span>
                            <span class="tech-badge">Node.js</span>
                        </div>
                    </div>
                </div>

                <div class="project-card">
                    <div class="project-image">
                        <img src="/placeholder.svg?height=300&width=500" alt="ERPLUS">
                        <div class="project-overlay">
                            <a href="#" class="project-link">View Project</a>
                        </div>
                    </div>
                    <div class="project-content">
                        <h3 class="project-title">ERPLUS API</h3>
                        <p class="project-description">
                            RESTful API for restaurant management system combining React frontend with Laravel backend.
                            Handles orders, inventory, and staff management efficiently.
                        </p>
                        <div class="project-tech">
                            <span class="tech-badge">React</span>
                            <span class="tech-badge">Laravel</span>
                            <span class="tech-badge">MySQL</span>
                        </div>
                    </div>
                </div>

                <div class="project-card">
                    <div class="project-image">
                        <img src="/placeholder.svg?height=300&width=500" alt="Invoix">
                        <div class="project-overlay">
                            <a href="#" class="project-link">View Project</a>
                        </div>
                    </div>
                    <div class="project-content">
                        <h3 class="project-title">Invoix</h3>
                        <p class="project-description">
                            Complete invoicing system built with Laravel. Create, manage, and track invoices
                            with automated reminders and payment tracking capabilities.
                        </p>
                        <div class="project-tech">
                            <span class="tech-badge">Laravel</span>
                            <span class="tech-badge">MySQL</span>
                            <span class="tech-badge">PDF Generation</span>
                        </div>
                    </div>
                </div>

                <div class="project-card">
                    <div class="project-image">
                        <img src="/placeholder.svg?height=300&width=500" alt="Card Subscription">
                        <div class="project-overlay">
                            <a href="#" class="project-link">View Project</a>
                        </div>
                    </div>
                    <div class="project-content">
                        <h3 class="project-title">Card Subscription Mobile App</h3>
                        <p class="project-description">
                            Native Android application for managing subscription cards. Built with Kotlin,
                            featuring offline support and secure payment integration.
                        </p>
                        <div class="project-tech">
                            <span class="tech-badge">Kotlin</span>
                            <span class="tech-badge">Android</span>
                            <span class="tech-badge">SQLite</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Experience Section -->
    <section class="section section-alt" id="experience">
        <div class="container">
            <div class="section-header">
                <span class="section-label">Experience</span>
                <h2 class="section-title">Professional journey</h2>
            </div>

            <div class="timeline">
                <div class="timeline-item">
                    <div class="timeline-marker"></div>
                    <div class="timeline-content">
                        <div class="timeline-header">
                            <h3 class="timeline-title">Agent CAC</h3>
                            <span class="timeline-date">Sep 2024 - Jun 2025</span>
                        </div>
                        <p class="timeline-company">Vectalia</p>
                        <p class="timeline-description">
                            Customer service and administrative support role, handling client communications
                            and operational tasks with 9 months of dedicated service.
                        </p>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-marker"></div>
                    <div class="timeline-content">
                        <div class="timeline-header">
                            <h3 class="timeline-title">Agent Administrative</h3>
                            <span class="timeline-date">Dec 2023 - Jun 2024</span>
                        </div>
                        <p class="timeline-company">Vectalia</p>
                        <p class="timeline-description">
                            Managed administrative operations and documentation, ensuring smooth workflow
                            and efficient communication across departments.
                        </p>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-marker"></div>
                    <div class="timeline-content">
                        <div class="timeline-header">
                            <h3 class="timeline-title">Web Developer (Remote)</h3>
                            <span class="timeline-date">Jun 2023 - Dec 2023</span>
                        </div>
                        <p class="timeline-company">Mediatechly - London</p>
                        <p class="timeline-description">
                            Developed and maintained web applications remotely for a London-based tech company.
                            Worked on full-stack projects using modern frameworks and best practices.
                        </p>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-marker"></div>
                    <div class="timeline-content">
                        <div class="timeline-header">
                            <h3 class="timeline-title">Formateur Algorithme</h3>
                            <span class="timeline-date">Apr 2023 - May 2023</span>
                        </div>
                        <p class="timeline-company">Centre Beta</p>
                        <p class="timeline-description">
                            Taught algorithmic thinking and problem-solving to students. Created course
                            materials and practical exercises for programming fundamentals.
                        </p>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-marker"></div>
                    <div class="timeline-content">
                        <div class="timeline-header">
                            <h3 class="timeline-title">Assistant Technique</h3>
                            <span class="timeline-date">Jun 2021 - Oct 2021</span>
                        </div>
                        <p class="timeline-company">Commune Bouarg</p>
                        <p class="timeline-description">
                            Provided technical support and assistance for municipal IT systems and
                            administrative software applications.
                        </p>
                    </div>
                </div>
            </div>

            <div class="education-section">
                <h3 class="education-title">Education</h3>
                <div class="education-grid">
                    <div class="education-card">
                        <div class="education-icon">
                            <svg width="24" height="24" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"/>
                            </svg>
                        </div>
                        <div class="education-content">
                            <h4 class="education-degree">License Professional Web Development</h4>
                            <p class="education-school">Web Fullstack</p>
                            <span class="education-year">2024</span>
                        </div>
                    </div>

                    <div class="education-card">
                        <div class="education-icon">
                            <svg width="24" height="24" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"/>
                            </svg>
                        </div>
                        <div class="education-content">
                            <h4 class="education-degree">Diplome ISTA Development Digital</h4>
                            <p class="education-school">Option Web Fullstack</p>
                            <span class="education-year">2021 - 2023</span>
                        </div>
                    </div>

                    <div class="education-card">
                        <div class="education-icon">
                            <svg width="24" height="24" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"/>
                            </svg>
                        </div>
                        <div class="education-content">
                            <h4 class="education-degree">Diplome Informatique et Gestion</h4>
                            <p class="education-school">Centre Al Baraka</p>
                            <span class="education-year">2021</span>
                        </div>
                    </div>

                    <div class="education-card">
                        <div class="education-icon">
                            <svg width="24" height="24" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"/>
                            </svg>
                        </div>
                        <div class="education-content">
                            <h4 class="education-degree">Bac Pro Reseaux et Maintenance</h4>
                            <p class="education-school">Professional Baccalaureate</p>
                            <span class="education-year">2021</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="section" id="contact">
        <div class="container">
            <div class="section-header">
                <span class="section-label">Contact</span>
                <h2 class="section-title">Let's work together</h2>
                <p class="section-description">
                    Have a project in mind? I'm always open to discussing new opportunities and ideas.
                </p>
            </div>

            <div class="contact-grid">
                <div class="contact-info">
                    <div class="contact-card">
                        <div class="contact-icon">
                            <svg width="24" height="24" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                            </svg>
                        </div>
                        <div>
                            <h4>Email</h4>
                            <a href="mailto:contact@youssefyouyou.com">contact@youssefyouyou.com</a>
                        </div>
                    </div>

                    <div class="contact-card">
                        <div class="contact-icon">
                            <svg width="24" height="24" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                            </svg>
                        </div>
                        <div>
                            <h4>Phone</h4>
                            <a href="tel:+212610090070">+212 610 090 070</a>
                        </div>
                    </div>

                    <div class="contact-card">
                        <div class="contact-icon">
                            <svg width="24" height="24" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div>
                            <h4>Location</h4>
                            <p>Morocco</p>
                        </div>
                    </div>

                    <div class="contact-social">
                        <h4>Follow me</h4>
                        <div class="social-links">
                            <a href="https://github.com" target="_blank" aria-label="GitHub">
                                <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                                </svg>
                            </a>
                            <a href="https://linkedin.com" target="_blank" aria-label="LinkedIn">
                                <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                </svg>
                            </a>
                            <a href="https://twitter.com" target="_blank" aria-label="Twitter">
                                <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <form class="contact-form" id="contactForm">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required>
                    </div>

                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <input type="text" id="subject" name="subject" required>
                    </div>

                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea id="message" name="message" rows="5" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Send Message</button>
                </form>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <p>&copy; 2025 Youssef Youyou. All rights reserved.</p>
                <p>Built with passion and modern web technologies.</p>
            </div>
        </div>
    </footer>

    <script >
        // Mobile Navigation Toggle
const navToggle = document.getElementById('navToggle');
const navMenu = document.getElementById('navMenu');

navToggle.addEventListener('click', () => {
    navMenu.classList.toggle('active');
    navToggle.classList.toggle('active');
});

// Close mobile menu when clicking on a link
const navLinks = document.querySelectorAll('.nav-link');
navLinks.forEach(link => {
    link.addEventListener('click', () => {
        navMenu.classList.remove('active');
        navToggle.classList.remove('active');
    });
});

// Smooth scroll for navigation links
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

function highlightNavigation() {
    const scrollY = window.pageYOffset;

    sections.forEach(section => {
        const sectionHeight = section.offsetHeight;
        const sectionTop = section.offsetTop - 100;
        const sectionId = section.getAttribute('id');
        const navLink = document.querySelector(`.nav-link[href="#${sectionId}"]`);

        if (scrollY > sectionTop && scrollY <= sectionTop + sectionHeight) {
            navLink?.classList.add('active');
        } else {
            navLink?.classList.remove('active');
        }
    });
}

window.addEventListener('scroll', highlightNavigation);

// Contact Form Handling
const contactForm = document.getElementById('contactForm');

contactForm.addEventListener('submit', (e) => {
    e.preventDefault();

    // Get form data
    const formData = {
        name: document.getElementById('name').value,
        email: document.getElementById('email').value,
        subject: document.getElementById('subject').value,
        message: document.getElementById('message').value
    };

    // Here you would typically send the data to your Laravel backend
    // Example: fetch('/contact', { method: 'POST', body: JSON.stringify(formData) })

    console.log('Form submitted:', formData);

    // Show success message (you can customize this)
    alert('Thank you for your message! I will get back to you soon.');

    // Reset form
    contactForm.reset();
});

// Intersection Observer for fade-in animations
const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.style.opacity = '1';
            entry.target.style.transform = 'translateY(0)';
        }
    });
}, observerOptions);

// Observe elements for animation
document.querySelectorAll('.project-card, .skill-category, .timeline-item, .education-card').forEach(el => {
    el.style.opacity = '0';
    el.style.transform = 'translateY(20px)';
    el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
    observer.observe(el);
});

// Navbar background on scroll
let lastScroll = 0;
const navbar = document.querySelector('.navbar');

window.addEventListener('scroll', () => {
    const currentScroll = window.pageYOffset;

    if (currentScroll > 50) {
        navbar.style.background = 'rgba(10, 10, 26, 0.95)';
        navbar.style.boxShadow = '0 4px 12px rgba(0, 0, 0, 0.3)';
    } else {
        navbar.style.background = 'rgba(10, 10, 26, 0.8)';
        navbar.style.boxShadow = 'none';
    }

    lastScroll = currentScroll;
});

    </script>
</body>
</html>
