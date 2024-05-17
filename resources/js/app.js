import "./bootstrap";
import "flowbite";
import Swiper from "swiper";
import { Navigation, Pagination } from "swiper/modules";
import "swiper/css";
import "swiper/css/navigation";
import "swiper/css/pagination";

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

const swiper = new Swiper(".swiper", {
    modules: [Navigation, Pagination],
    // Optional parameters
    direction: "horizontal",
    loop: true,

    // If we need pagination
    pagination: {
        el: ".swiper-pagination",
    },

    // And if we need scrollbar
    scrollbar: {
        el: ".swiper-scrollbar",
    },
});
