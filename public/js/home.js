$(document).ready(function () {
    $('.newest_products_carousel').owlCarousel({
        loop: false,
        margin: 30,
        items: 3,
        responsive: {
            0: {
                items: 1,
            },
            575: {
                items: 2,
            },
            992: {
                items: 2,
            },
            1200: {
                items: 3,
            }
        }
    });
});