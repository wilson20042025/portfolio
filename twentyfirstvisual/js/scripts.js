document.addEventListener('DOMContentLoaded', () => {
    // Burger menu toggle
    const burger = document.getElementById('burger');
    const navLinks = document.getElementById('nav-links');
    
    if (burger && navLinks) {
        // Toggle menu when burger is clicked
        burger.addEventListener('click', (e) => {
            e.stopPropagation(); // Prevents immediate close on open
            navLinks.classList.toggle('active');
        });

        // Close menu when clicking outside
        document.addEventListener('click', (e) => {
            const isClickInsideNav = navLinks.contains(e.target);
            const isClickOnBurger = burger.contains(e.target);

            if (!isClickInsideNav && !isClickOnBurger) {
                navLinks.classList.remove('active');
            }
        });
    }

    // Lightbox logic
    const lightbox = document.getElementById('lightbox');
    const lightboxImg = document.querySelector('.lightbox img'); // Ensure your HTML contains <img> in .lightbox
    const closeBtn = document.querySelector('.close-lightbox');
    const prevBtn = document.querySelector('.prev-slide');
    const nextBtn = document.querySelector('.next-slide');

    const filterButtons = document.querySelectorAll('.filter-button');
    const galleryItems = document.querySelectorAll('.gallery-item');

    let filteredImages = [];
    let currentIndex = 0;

    const updateFilteredImages = () => {
        filteredImages = Array.from(galleryItems)
            .filter(item => item.style.display !== 'none')
            .map(item => item.querySelector('img'));
    };

    updateFilteredImages();

    const showImage = (index) => {
        if (filteredImages.length === 0) return;

        if (index < 0) index = filteredImages.length - 1;
        if (index >= filteredImages.length) index = 0;

        currentIndex = index;
        lightboxImg.src = filteredImages[currentIndex].src;
        lightbox.classList.add('active');
    };

    galleryItems.forEach((item) => {
        const img = item.querySelector('img');
        img.addEventListener('click', () => {
            updateFilteredImages();
            currentIndex = filteredImages.findIndex(i => i === img);
            showImage(currentIndex);
        });
    });

    // Slide buttons
    if (prevBtn) {
        prevBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            showImage(currentIndex - 1);
        });
    }

    if (nextBtn) {
        nextBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            showImage(currentIndex + 1);
        });
    }

    // Close lightbox by clicking outside image
    if (lightbox) {
        lightbox.addEventListener('click', (e) => {
            if (e.target === lightbox) {
                lightbox.classList.remove('active');
                lightboxImg.src = '';
            }
        });
    }

    if (closeBtn) {
        closeBtn.addEventListener('click', () => {
            lightbox.classList.remove('active');
            lightboxImg.src = '';
        });
    }

    // Close on ESC key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && lightbox.classList.contains('active')) {
            lightbox.classList.remove('active');
            lightboxImg.src = '';
        }
    });

    // Filter logic
    filterButtons.forEach(button => {
        button.addEventListener('click', () => {
            filterButtons.forEach(btn => btn.classList.remove('active'));
            button.classList.add('active');

            const category = button.getAttribute('data-category');
            galleryItems.forEach(item => {
                const match = item.getAttribute('data-category') === category || category === 'all';
                item.style.display = match ? '' : 'none';
            });

            updateFilteredImages();
        });
    });
});
