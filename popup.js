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

// Function to switch between tabs
function showTab(tabId) {
    // Hide all tab containers
    const tabContainers = document.querySelectorAll('.tab-container');
    tabContainers.forEach(container => {
        container.classList.remove('active');
    });

    // Show the selected tab
    document.getElementById(tabId).classList.add('active');

    // Update active menu item
    const menuItems = document.querySelectorAll('.menu-items a');
    menuItems.forEach(item => {
        item.classList.remove('active');
        if (item.getAttribute('onclick').includes(tabId)) {
            item.classList.add('active');
        }
    });
}

// Search functionality
document.querySelector('.search-container input').addEventListener('keyup', function () {
    const searchText = this.value.toLowerCase();
    const menuItems = document.querySelectorAll('.menu-items a');

    menuItems.forEach(item => {
        const itemText = item.textContent.toLowerCase();
        if (itemText.includes(searchText)) {
            item.parentElement.style.display = 'block';
        } else {
            item.parentElement.style.display = 'none';
        }
    });
});
