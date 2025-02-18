document.addEventListener('DOMContentLoaded', function() {
    const navToggle = document.querySelector('.nav-toggle');
    const navLinks = document.querySelector('.nav-links');
    
    navToggle.addEventListener('click', function() {
        // Toggle the open class on nav-links
        navLinks.classList.toggle('open');
        console.log('Nav toggle clicked'); // For debugging
    });
});


window.addEventListener("scroll", function () {
    const headerBar = document.querySelector(".header-bar");
    if (window.scrollY > 50) {
        headerBar.classList.add("scrolled");
    } else {
        headerBar.classList.remove("scrolled");
    }
});

window.addEventListener("scroll", function () {
    const headerBar2 = document.querySelector(".header-bar2");
    if (window.scrollY > 50) {
        headerBar2.classList.add("scrolled");
    } else {
        headerBar2.classList.remove("scrolled");
    }
});

// Existing scroll event listeners...

// Intersection Observer for animations
const observerOptions = {
    threshold: 0.2,
    rootMargin: '0px'
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('animate');
            observer.unobserve(entry.target);
        }
    });
}, observerOptions);


document.addEventListener('DOMContentLoaded', function() {
    // Existing navigation code remains...

    // Intersection Observer for scroll animations
    const observerOptions = {
        threshold: 0.15,
        rootMargin: '50px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                // Add animation class when element comes into view
                entry.target.classList.add('animate');
                
                // If the element is a destination card or review card, add delay
                if (entry.target.classList.contains('destination-card')) {
                    const delay = Array.from(entry.target.parentElement.children).indexOf(entry.target) * 0.2;
                    entry.target.style.transitionDelay = `${delay}s`;
                }
                if (entry.target.classList.contains('review-card')) {
                    const delay = Array.from(entry.target.parentElement.children).indexOf(entry.target) * 0.2;
                    entry.target.style.transitionDelay = `${delay}s`;
                }
            }
        });
    }, observerOptions);
// Observe elements
const elementsToAnimate = [
    '.banner h1',
    '.banner p',
    '.explore',
    '.destination-card',
    '.review-card',
    '.map-container',
    '.about-us'
].join(',');

document.querySelectorAll(elementsToAnimate).forEach(element => {
    element.classList.add('scroll-animate');
    observer.observe(element);
});

// Smooth scroll for explore button
const exploreBtn = document.querySelector('.explore');
if (exploreBtn) {
    exploreBtn.addEventListener('click', function(e) {
        e.preventDefault();
        const mainContent = document.querySelector('.main-content');
        mainContent.scrollIntoView({ behavior: 'smooth' });
    });
}
});
