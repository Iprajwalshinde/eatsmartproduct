function openShareMenu(event) {
    event.preventDefault(); // Prevent default action if needed
  
    // Retrieve the custom message from data-message attribute
    const shareElement = event.currentTarget; // Get the clicked element
    const customMessage = encodeURIComponent(shareElement.getAttribute('data-message'));
    const url = encodeURIComponent(window.location.href);
    const title = encodeURIComponent(document.title);

    const shareMenuHTML = `
      <div class="share-options" style="position: absolute; z-index: 1000;">
      <a href="https://api.whatsapp.com/send?text=${customMessage}%20${url}" target="_blank">WhatsApp</a>
        <a href="https://www.facebook.com/sharer/sharer.php?u=${url}&quote=${customMessage}" target="_blank">Facebook</a>
        <a href="https://twitter.com/intent/tweet?url=${url}&text=${customMessage}" target="_blank">Twitter</a>
        <a href="https://www.linkedin.com/shareArticle?mini=true&url=${url}&title=${title}&summary=${customMessage}&source=${url}" target="_blank">LinkedIn</a>
        <a href="https://reddit.com/submit?url=${url}&title=${customMessage}" target="_blank">Reddit</a>
      </div>
    `;
  
    // Create and show the share menu
    const shareMenu = document.createElement('div');
    shareMenu.innerHTML = shareMenuHTML;
    shareMenu.style.position = 'absolute';
    shareMenu.style.top = `${event.clientY + 5}px`; // 5 pixels below the cursor
    shareMenu.style.left = `${event.clientX}px`; // At the cursor's horizontal position
    document.body.appendChild(shareMenu);
  
    // Optional: Remove menu when clicking elsewhere
    document.addEventListener('click', function closeMenu(e) {
      if (!shareMenu.contains(e.target) && e.target !== shareElement) {
        shareMenu.remove();
        document.removeEventListener('click', closeMenu);
      }
    });
  }
  