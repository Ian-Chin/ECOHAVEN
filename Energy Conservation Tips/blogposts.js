document.addEventListener('DOMContentLoaded', function() {
    function shareOnFacebook() {
        const url = window.location.href;
        window.open(`https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(url)}`, 'Share', 'width=600,height=400');
    }

    function shareOnTwitter() {
        const title = document.querySelector('h1')?.textContent || document.title;
        const url = window.location.href;
        window.open(`https://twitter.com/intent/tweet?text=${encodeURIComponent(title)}&url=${encodeURIComponent(url)}`, 'Share', 'width=600,height=400');
    }

    function shareOnLinkedIn() {
        const url = window.location.href;
        window.open(`https://www.linkedin.com/shareArticle?mini=true&url=${encodeURIComponent(url)}`, 'Share', 'width=600,height=400');
    }

    function shareViaEmail() {
        const title = document.querySelector('h1')?.textContent || document.title;
        const url = window.location.href;
        window.location.href = `mailto:?subject=${encodeURIComponent(title)}&body=${encodeURIComponent('Check out this article: ' + url)}`;
    }

    function shareOnWhatsApp() {
        const title = document.querySelector('h1')?.textContent || document.title;
        const url = window.location.href;
        window.open(`https://wa.me/?text=${encodeURIComponent(title + ' ' + url)}`, 'Share', 'width=600,height=400');
    }

    function shareOnInstagram() {
        alert("Sharing to Instagram stories is best done from the mobile app. You can copy the link:\n" + window.location.href);
        window.open('https://www.instagram.com/', '_blank'); 
    }

    const urlParams = new URLSearchParams(window.location.search);
    const postId = urlParams.get('id');
    
    if (!postId) {
        const likeBtn = document.getElementById('likeBtn');
        const likeCount = document.getElementById('likeCount');
    };

    
    // Function to handle like action
    function handleLike() {
        // Check if user has already liked
        if (localStorage.getItem(`post_${postId}_liked`)) {
            alert('You have already liked this post.');
            return;
        }
        
        // Send AJAX request to record like
        const formData = new FormData();
        formData.append('action', 'like');
        formData.append('postId', postId);
        
        fetch('blog-post.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update UI
                likeCount.textContent = parseInt(likeCount.textContent) + 1;
                likeBtn.classList.add('active');
                
                // Store like in local storage to prevent multiple likes
                localStorage.setItem(`post_${postId}_liked`, 'true');
                
                // Disable button
                likeBtn.disabled = true;
            } else {
                alert(data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while liking the post. Please try again.');
        });
    }
    
    // Attach event listener to like button
    if (likeBtn) {
        likeBtn.addEventListener('click', handleLike);
    }
    
    // Check if user has already liked this post
    const previousLike = localStorage.getItem(`post_${postId}_liked`);
    if (previousLike) {
        if (likeBtn) {
            likeBtn.classList.add('active');
            likeBtn.disabled = true;
        }
    }
    
    // Read time calculation
    const postContent = document.querySelector('.post-content');
    if (postContent) {
        const text = postContent.textContent || postContent.innerText;
        const wordCount = text.split(/\s+/).length;
        const WORDS_PER_MINUTE = 200;
        // Average reading speed: 200 words per minute
        const readingTime = Math.ceil(wordCount / WORDS_PER_MINUTE);
        
        const readTimeElement = document.querySelector('.read-time');
        if (readTimeElement) {
            readTimeElement.textContent = `${readingTime} min read`;
        }
    }
    
    // Handle social sharing
    const shareBtns = document.querySelectorAll('.share-btn');
    shareBtns.forEach(btn => {
        btn.addEventListener('click', function(e) {
            //Don't prevent default for mailto: links to allow email client to open
            if (!this.classList.contains('email')) {
                e.preventDefault();
                window.open(this.href, 'Share', 'width=600,height=400');
            }
        });
    });

    // --- Reading Progress Bar Logic ---
    const progressBar = document.getElementById('reading-progress');

    // Function to update the progress bar width
    function updateReadingProgress() {
        // Ensure the progress bar element exists on the page
        if (!progressBar) return;

        // Calculate the total scrollable height of the document
        // scrollHeight is the total height of the content
        // clientHeight is the visible height of the viewport
        const totalScrollableHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;

        // Get the current scroll position from the top
        const scrolled = window.scrollY || window.pageYOffset; // Cross-browser compatibility

        // Calculate the scroll percentage
        let progress = totalScrollableHeight > 0 ? (scrolled / totalScrollableHeight) * 100 : 100;

        // Ensure progress doesn't exceed 100% (handles potential bounce/overscroll)
        const clampedProgress = Math.min(progress, 100);

        console.log(`Scrolled: ${scrolled}, Total Height: ${totalScrollableHeight}, Progress: ${clampedProgress}%`);

        // Update the width of the progress bar element
        progressBar.style.width = clampedProgress + '%';
    }

    // Add event listener for scroll events
    window.addEventListener('scroll', updateReadingProgress);

    // Call the function once on load in case the page loads already scrolled
    updateReadingProgress();
    // --- End Reading Progress Bar Logic ---

});
