//Owl carosel added in  aboutus template
      jQuery(document).ready(function(){
        jQuery('#hiw').owlCarousel({
            loop:true,
            margin:10,
            responsiveClass:true,
            responsive:{
                0:{
                    items:1,
                    dots:true
                },
                600:{
                    items:3,
                    nav:false
                },
                1000:{
                    items:3,
                    nav:true,
                    loop:false
                }
            }
        })
      });

      //Owl carosel for partners logos
      jQuery(document).ready(function(){
        jQuery('.partners-strip').owlCarousel({
			loop:true,
			dots:false,
			nav:false,
            margin:10,
			responsiveClass:true,
			autoplayTimeout: 3000,
			autoplaySpeed: 3000,
			autoplay:true,
    		autoplayHoverPause:true,
			responsive:{
                0:{
                    items:1
                    
                },
                400:{
                    items:2
                    
                },
                600:{
                    items:3
                   
                },
                1000:{
                    items:4
                    
                  
                }
            }
        })
      });

      //Popover content used in ourteam template
      jQuery(function () {
        jQuery('[data-toggle="popover"]').popover({
         html: true
        })
      });

      //Bootstrap menu to mmenu support
      jQuery(document).ready(function() {
        jQuery(".navbar-collapse").mmenu({
            wrappers: ["bootstrap4"],
            "extensions": ["position-right", "position-front"],
       });
      });

      //Tooltip added in map in aboutus template
       jQuery(function () {
        jQuery('[data-toggle="tooltip"]').tooltip()
      });



