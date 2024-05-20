import Swiper from "swiper/bundle";

// import styles bundle
import "swiper/css/bundle";

import { Navigation, Pagination } from "swiper/modules";
import "swiper/css";
import "swiper/css/navigation";
import "swiper/css/pagination";


const swiper = new Swiper(".swiper", {
    modules: [Navigation, Pagination],
    direction: "horizontal",
    loop: true,
    autoplay: {
        delay: 2500,
        disableOnInteraction: false,
    },

    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },

    // Navigation arrows
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
});