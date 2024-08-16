         $('.heru-slider').owlCarousel({
         loop:true,
         margin:0,
         autoplay: true,
             autoPlaySpeed: 5000,
             autoPlayTimeout: 7000,
             smartSpeed:1000,
             autoplayHoverPause: true,
             navText:["<i class=\"fa-solid fa-arrow-left\"></i>","<i class=\"fa-solid fa-arrow-right\"></i>"],
         nav:true,
         responsive:{
             0:{
                 items:1
             },
             600:{
                 items:1
             },
             1000:{
                 items:1
             }
         }
         });

         $('.mainslider-car').owlCarousel({
         loop:true,
         margin:0,
         autoplay: true,
             autoPlaySpeed: 5000,
             autoPlayTimeout: 7000,
             smartSpeed:1000,
             autoplayHoverPause: true,
             navText:["<i class=\"fa-solid fa-arrow-left\"></i>","<i class=\"fa-solid fa-arrow-right\"></i>"],
         nav:true,
         responsive:{
             0:{
                 items:1
             },
             600:{
                 items:1
             },
             1000:{
                 items:1
             }
         }
         });
        
         $('.slider-product').owlCarousel({
         loop:true,
         margin:20,
         autoplay: true,
             autoPlaySpeed: 5000,
             autoPlayTimeout: 7000,
             smartSpeed:1000,
             nav:true,
             dots:true,
             autoplayHoverPause: true,
             navText:["<i class=\"fa-solid fa-angle-left\"></i>","<i class=\"fa-solid fa-angle-right\"></i>"],
         nav:true,
         responsive:{
             0:{
                 items:1
             },
             600:{
                 items:2
             },
             1000:{
                 items:4
             }
         }
         });


         $('.testimonial-carousel').owlCarousel({
         loop:true,
         margin:20,
         autoplay: true,
             autoPlaySpeed: 5000,
             autoPlayTimeout: 7000,
             smartSpeed:1000,
             autoplayHoverPause: true,
             navText:["<i class=\"fa-solid fa-arrow-left\"></i>","<i class=\"fa-solid fa-arrow-right\"></i>"],
         nav:true,
         responsive:{
             0:{
                 items:1
             },
             600:{
                 items:2
             },
             1000:{
                 items:3
             }
         }
         });

             $('.sponsors-carousel').owlCarousel({
             loop:true,
             margin:20,
             autoplay: true,
                 autoPlaySpeed: 5000,
                 autoPlayTimeout: 7000,
                 smartSpeed:1000,
                 autoplayHoverPause: true,
                 navText:["<i class=\"fa-solid fa-arrow-left\"></i>","<i class=\"fa-solid fa-arrow-right\"></i>"],
             nav:true,
             responsive:{
                 0:{
                     items:1
                 },
                 600:{
                     items:2
                 },
                 1000:{
                     items:5
                 }
             }
             });
             
            $('.home-slides').owlCarousel({
                loop: true,
                nav: true,
                dots: false,
                autoplayHoverPause: true,
                items: 1,
                smartSpeed: 750,
                autoplay: false,
                navText: [
                    "<i class='fa-solid fa-arrow-left'></i>",
                    "<i class='fa-solid fa-arrow-right'></i>"
                ],
            });