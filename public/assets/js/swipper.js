const swiper = new Swiper('.swiper-container.two', {
    nextButton: '#js-next1',
    prevButton: '#js-prev1',
    paginationClickable: false,
    effect: 'coverflow',
    loop: true,
    centeredSlides: true,
    autoplay: {
        delay: 2000,
    },
    coverflow: {
        rotate: 0,
        stretch: 50,
        depth: 150,
        modifier: 1.5,
        slideShadows: false,
    },
    breakpoints: {
        // When window width is <= 570px
        768: {
            slidesPerView: 1,
        },
        // When window width is > 570px
        9999: {
            slidesPerView: 2,
        }
    }
});