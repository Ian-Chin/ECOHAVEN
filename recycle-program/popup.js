//---------------------------------------------------------------------------------- 
// NAVIGATION TOGGLE BUTTON FOR MOBILE MENU
//---------------------------------------------------------------------------------- 
document.addEventListener('DOMContentLoaded', function() {
    const navToggle = document.querySelector('.nav-toggle');
    const navLinks = document.querySelector('.nav-links');
    
    navToggle.addEventListener('click', function() {
        // Toggle the open class on nav-links
        navLinks.classList.toggle('open');
        console.log('Nav toggle clicked'); // For debugging
    });
});

//---------------------------------------------------------------------------------- 
// HEADER 1 N 2 SCROLL ANIMATION
//---------------------------------------------------------------------------------- 
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

//---------------------------------------------------------------------------------- 
// Existing scroll event listeners...

// Intersection Observer for animations
//---------------------------------------------------------------------------------- 
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

//----------------------------------------------------------------------------------
//SCROLL CLICK EXPLORE BUTTON
//----------------------------------------------------------------------------------    
const exploreBtn = document.querySelector('.explore');
if (exploreBtn) {
    exploreBtn.addEventListener('click', function(e) {
        e.preventDefault();
        const mainContent = document.querySelector('.main-content');
        mainContent.scrollIntoView({ behavior: 'smooth' });
    });
}
});

const exploreBtn = document.querySelector('.explore');
if (exploreBtn) {
    exploreBtn.addEventListener('click', function(e) {
        e.preventDefault();
        const popularNow = document.querySelector('.popular-now');
        popularNow.scrollIntoView({ behavior: 'smooth' });
    });
}

//----------------------------------------------------------------------------------    
// OUR IMPACT NUMBER COUNTING FROM 0 TO TARGET
//---------------------------------------------------------------------------------- 
function animateCounter(element, target, duration) {
    const startTime = performance.now();
    const startValue = 0;
    
    function updateCounter(currentTime) {
      const elapsedTime = currentTime - startTime;
      
      if (elapsedTime > duration) {
        // Animation complete, set final value
        element.textContent = target.includes('+') 
          ? Math.floor(parseInt(target)) + '+' 
          : target.includes('%')
            ? Math.floor(parseInt(target)) + '%'
            : Math.floor(parseInt(target)).toLocaleString();
        return;
      }
      
      // Calculate current value based on easing
      const progress = elapsedTime / duration;
      // Use easeOutQuad for smoother finish: t*(2-t)
      const easedProgress = progress * (2 - progress);
      
      const currentValue = Math.floor(startValue + (parseInt(target) * easedProgress));
      
      // Format the number according to its type
      element.textContent = target.includes('+') 
        ? currentValue + '+' 
        : target.includes('%')
          ? currentValue + '%'
          : currentValue.toLocaleString();
      
      requestAnimationFrame(updateCounter);
    }
    
    requestAnimationFrame(updateCounter);
  }
  
  // Observer specifically for achievement cards
  document.addEventListener('DOMContentLoaded', function() {
    const achievementObserver = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          const valueElements = entry.target.querySelectorAll('.achievement-card h3');
          
          valueElements.forEach(element => {
            // Get the target value from the HTML
            const targetValue = element.textContent;
            
            // Reset to zero first
            element.textContent = '0';
            
            // Start animation
            animateCounter(element, targetValue, 1500); // 1.5 seconds duration
          });
          
          // Unobserve after triggering animation
          achievementObserver.unobserve(entry.target);
        }
      });
    }, {
      threshold: 0.3,
      rootMargin: '0px'
    });
    
    // Observe the achievements section
    const achievementsSection = document.querySelector('.achievements-section');
    if (achievementsSection) {
      achievementObserver.observe(achievementsSection);
    }
  });
//---------------------------------------------------------------------------------- 


//Recycle Program Page Scroll animation

document.addEventListener('DOMContentLoaded', function() {
    // Add animation classes to elements
    const animateElements = {
        '.menu': 'fade-up',
        '.global_class': 'fade-up',
        '.three_R_class': 'scale',
        '.reduce_class': 'fade-left',
        '.reuse_class': 'fade-right',
        '.recycle_class': 'fade-left',
        '.LRP_class': 'fade-up',
        '.types_class': 'scale',
        '.dd_class': 'fade-up',
        '.do_and_donts': 'scale',
        '.Malaysia_RP_class': 'fade-up'
    };

    // Apply initial classes
    Object.entries(animateElements).forEach(([selector, animation]) => {
        const elements = document.querySelectorAll(selector);
        elements.forEach(element => {
            element.classList.add('scroll-animate', animation);
        });
    });

    // Create Intersection Observer
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                // Add active class when element is in view
                entry.target.classList.add('active');
                // Unobserve after animation
                observer.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.2, // Trigger when 20% of element is visible
        rootMargin: '0px' // Trigger exactly when element enters viewport
    });

    // Observe all animated elements
    document.querySelectorAll('.scroll-animate').forEach(element => {
        observer.observe(element);
    });

    // Handle global content button animations
    const buttons = document.querySelectorAll('.global_buttons button');
    buttons.forEach(button => {
        button.addEventListener('click', function() {
            const contentId = this.getAttribute('onclick').match(/'([^']+)'/)[1];
            const content = document.getElementById(contentId);
            
            // Hide all content first
            document.querySelectorAll('.global_content').forEach(el => {
                el.style.display = 'none';
                el.classList.remove('show');
            });
            
            // Show and animate the selected content
            if (content) {
                content.style.display = 'block';
                setTimeout(() => {
                    content.classList.add('show');
                }, 10);
            }
        });
    });
});
