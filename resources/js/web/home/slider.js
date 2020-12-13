import Swiper, {Navigation, Pagination} from 'swiper';

Swiper.use([Navigation, Pagination]);

(() => {
    const slider = document.querySelector('#homepage-slider');

    if (!slider) {
        return;
    }

    const sliderSwiper = new Swiper(slider, {
        loop: true,
        speed: 500,
        autoplay: true,
        pagination: {
            el: '.homepage-slider-pagination',
        },
        navigation: {
            nextEl: '.homepage-slider-button-next',
            prevEl: '.homepage-slider-button-prev',
        },
    });
})()
