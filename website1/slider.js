document.addEventListener('DOMContentLoaded', function () {
    // Image Slider Logic
    const slides = document.querySelectorAll('.slide');
    const prevButton = document.getElementById('prev');
    const nextButton = document.getElementById('next');
    const slider = document.querySelector('.image-slider');
    let currentIndex = 0;

    function showSlide(index) {
        currentIndex = (index + slides.length) % slides.length;
        const offset = -currentIndex * 100;
        slider.style.transform = `translateX(${offset}%)`;
    }

    prevButton.addEventListener('click', function () {
        showSlide(currentIndex - 1);
    });

    nextButton.addEventListener('click', function () {
        showSlide(currentIndex + 1);
    });

    setInterval(function () {
        showSlide(currentIndex + 1);
    }, 5000);

    // Swiper Initialization
    new Swiper('.swiper-container', {
        loop: true,
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });
});
