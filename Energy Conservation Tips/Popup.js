// -----------------------------------------------------------------------------------
// NAVIGATION TOGGLE BUTTON FOR MOBILE MENU
// -----------------------------------------------------------------------------------
document.addEventListener('DOMContentLoaded', function () {
    const navToggle = document.querySelector('.nav-toggle');
    const navLinks = document.querySelector('.nav-links');
    const nav = document.querySelector('.nav');

    navToggle.addEventListener('click', function () {
        navLinks.classList.toggle('open');
        nav.classList.toggle('open');
        console.log('Nav toggle clicked');
    });

    // -----------------------------------------------------------------------------------
    // INTERSECTION OBSERVER FOR ANIMATIONS
    // -----------------------------------------------------------------------------------
    const observerOptions = {
        threshold: 0.15,
        rootMargin: '50px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate');

                // Add delay for destination and review cards
                if (entry.target.classList.contains('destination-card') ||
                    entry.target.classList.contains('review-card')) {
                    const delay = Array.from(entry.target.parentElement.children).indexOf(entry.target) * 0.2;
                    entry.target.style.transitionDelay = `${delay}s`;
                }
            }
        });
    }, observerOptions);

    // Observe elements for animation
    const elementsToAnimate = [
        '.main-banner h1',
        '.main-banner p',
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

    // -----------------------------------------------------------------------------------
    // BLOG POST SORTING FUNCTIONALITY
    // -----------------------------------------------------------------------------------
    const sortSelect = document.getElementById('sort-select');
    const blogPostsSection = document.querySelector('.blog-posts');

    function getPostDate(post) {
        const dateText = post.querySelector('.date').textContent.trim();
        const [day, month, year] = dateText.split('/').map(Number);
        return new Date(`20${year}-${month}-${day}`).getTime();
    }

    function sortPosts(order) {
        const posts = Array.from(document.querySelectorAll('.blog-card'));

        posts.sort((a, b) => {
            const dateA = getPostDate(a);
            const dateB = getPostDate(b);
            return order === 'oldest' ? dateA - dateB : dateB - dateA;
        });

        posts.forEach(post => post.remove());
        posts.forEach(post => blogPostsSection.appendChild(post));
    }

    if (sortSelect) {
        sortSelect.addEventListener('change', (e) => {
            console.log('Sort direction:', e.target.value);
            sortPosts(e.target.value);
        });
        sortPosts(sortSelect.value);
    }

    // -----------------------------------------------------------------------------------
    // SCROLL CLICK EXPLORE BUTTON
    // -----------------------------------------------------------------------------------
    const exploreBtn = document.querySelector('.explore');
    if (exploreBtn) {
        exploreBtn.addEventListener('click', function (e) {
            e.preventDefault();
            const popularNow = document.querySelector('.popular-now');
            popularNow.scrollIntoView({ behavior: 'smooth' });
        });
    }
});

// -----------------------------------------------------------------------------------
// HEADER SCROLL ANIMATION
// -----------------------------------------------------------------------------------
window.addEventListener("scroll", function () {
    const headerBar = document.querySelector(".header-bar");
    const headerBar2 = document.querySelector(".header-bar2");

    if (window.scrollY > 50) {
        headerBar?.classList.add("scrolled");
        headerBar2?.classList.add("scrolled");
    } else {
        headerBar?.classList.remove("scrolled");
        headerBar2?.classList.remove("scrolled");
    }
});

// -----------------------------------------------------------------------------------
// LIKE COUNTER FUNCTIONALITY
// -----------------------------------------------------------------------------------
let likeCount = 0;
const likeButton = document.querySelector('.like-button');
const unlikeButton = document.querySelector('.unlike-button');
const likeCounterElement = document.querySelector('.like-counter');

if (likeButton && unlikeButton && likeCounterElement) {
    likeButton.addEventListener('click', function () {
        likeCount++;
        likeCounterElement.textContent = likeCount;
    });

    unlikeButton.addEventListener('click', function () {
        if (likeCount > 0) {
            likeCount--;
            likeCounterElement.textContent = likeCount;
        }
    });
}

// -----------------------------------------------------------------------------------
// ACHIEVEMENT COUNTER ANIMATION
// -----------------------------------------------------------------------------------
function animateCounter(element, target, duration) {
    const startTime = performance.now();
    const startValue = 0;

    function updateCounter(currentTime) {
        const elapsedTime = currentTime - startTime;

        if (elapsedTime > duration) {
            element.textContent = target.includes('+')
                ? Math.floor(parseInt(target)) + '+'
                : target.includes('%')
                    ? Math.floor(parseInt(target)) + '%'
                    : Math.floor(parseInt(target)).toLocaleString();
            return;
        }

        const progress = elapsedTime / duration;
        const easedProgress = progress * (2 - progress);
        const currentValue = Math.floor(startValue + (parseInt(target) * easedProgress));

        element.textContent = target.includes('+')
            ? currentValue + '+'
            : target.includes('%')
                ? currentValue + '%'
                : currentValue.toLocaleString();

        requestAnimationFrame(updateCounter);
    }

    requestAnimationFrame(updateCounter);
}

// Achievement observer setup
const achievementObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            const valueElements = entry.target.querySelectorAll('.achievement-card h3');

            valueElements.forEach(element => {
                const targetValue = element.textContent;
                element.textContent = '0';
                animateCounter(element, targetValue, 1500);
            });

            achievementObserver.unobserve(entry.target);
        }
    });
}, {
    threshold: 0.3,
    rootMargin: '0px'
});

// Observe achievements section
const achievementsSection = document.querySelector('.achievements-section');
if (achievementsSection) {
    achievementObserver.observe(achievementsSection);
}

// -----------------------------------------------------------------------------------
// SOCIAL SHARING FUNCTIONS
// -----------------------------------------------------------------------------------
function shareOnFacebook() {
    window.open(`https://www.facebook.com/sharer/sharer.php?u=${window.location.href}`, '_blank');
}

function shareOnTwitter() {
    const title = document.querySelector('h1').textContent;
    window.open(`https://twitter.com/intent/tweet?text=${encodeURIComponent(title)}&url=${window.location.href}`, '_blank');
}

function shareOnLinkedIn() {
    window.open(`https://www.linkedin.com/shareArticle?mini=true&url=${window.location.href}`, '_blank');
}

function shareViaEmail() {
    const title = document.querySelector('h1').textContent;
    window.open(`mailto:?subject=${encodeURIComponent(title)}&body=${window.location.href}`);
}

function shareOnWhatsApp() {
    const title = document.querySelector('h1').textContent;
    window.open(`https://wa.me/?text=${encodeURIComponent(title + ' ' + window.location.href)}`, '_blank');
}



document.addEventListener('DOMContentLoaded', function() {
    // Wait for everything to load before initializing
    setTimeout(initCarousel, 100);
    
    function initCarousel() {
      // Get carousel elements with more specific selectors
      const track = document.querySelector('.auto-scrolling-banner .carousel-track');
      if (!track) {
        console.error('Carousel track not found');
        return;
      }
      
      const slides = document.querySelectorAll('.auto-scrolling-banner .carousel-slide');
      if (!slides.length) {
        console.error('Carousel slides not found');
        return;
      }
      
      const dots = document.querySelectorAll('.auto-scrolling-banner .dot');
      
      let currentSlide = 0;
      const slideCount = slides.length;
      let slideInterval;
      
      console.log('Carousel initialized with', slideCount, 'slides');
      
      // Function to move to a specific slide
      function moveToSlide(slideIndex) {
        if (slideIndex >= slideCount) slideIndex = 0;
        if (slideIndex < 0) slideIndex = slideCount - 1;
        
        track.style.transform = `translateX(-${slideIndex * (100 / slideCount)}%)`;
        
        // Update active dot
        dots.forEach(dot => dot.classList.remove('active'));
        if (dots[slideIndex]) {
          dots[slideIndex].classList.add('active');
        }
        
        currentSlide = slideIndex;
        console.log('Moved to slide', currentSlide);
      }
      
      // Set up automatic sliding
      function startSlideShow() {
        // Clear any existing interval first
        if (slideInterval) {
          clearInterval(slideInterval);
        }
        
        slideInterval = setInterval(() => {
          moveToSlide(currentSlide + 1);
        }, 3000); // Change slide every 3 seconds
        
        console.log('Slideshow started');
      }
      
      // Add click events to dots
      dots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
          clearInterval(slideInterval);
          moveToSlide(index);
          startSlideShow();
        });
      });
      
      // Handle mouse interactions
      track.addEventListener('mouseenter', () => {
        clearInterval(slideInterval);
        console.log('Slideshow paused');
      });
      
      track.addEventListener('mouseleave', () => {
        startSlideShow();
        console.log('Slideshow resumed');
      });
      
      // Initialize the carousel
      moveToSlide(0);
      startSlideShow();
      
      // Add a forced redraw to ensure everything renders correctly
      track.style.display = 'none';
      setTimeout(() => {
        track.style.display = 'flex';
      }, 10);
    }
  });


