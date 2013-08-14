(function($) {


  $(document).ready(function() {









    $(".pic a[rel^='prettyPhoto']").prettyPhoto({
      animation_speed: 'normal',
      overlay_gallery: false,
      social_tools: false
    });



    $('.breadcrumb a').each(function(index) {

      $item = $(this);
      $item_value = $(this).text();
      $item.html('<span>' + $item_value + '</span>');

    });

    $('.breadcrumb a:first').addClass('first_bc');
    $('.breadcrumb a:last').addClass('last_bc');
    $('ul.links').addClass('arrowed');
    $('.sidebar .block-search .button_search').after($('.sidebar .block-search input[name="search_block_form"]'));


    /*----------------------------------------------------*/
    /*	Isotope Portfolio Filter
     /*----------------------------------------------------*/



    $(function() {
      var $container = $('#portfolio_items');
      //$select = $('#portfolio_filter div');

      // initialize Isotope
      $container.isotope({
        // options...
        resizable: false, // disable normal resizing
        // set columnWidth to a percentage of container width
        masonry: {
          columnWidth: $container.width() / 12
        }
      });

      // update columnWidth on window resize
      $(window).smartresize(function() {
        $container.isotope({
          // update columnWidth to a percentage of container width
          masonry: {
            columnWidth: $container.width() / 12
          }
        });
      });


      $container.isotope({
        itemSelector: '.portfolio-item'
      });

      /*$select.change(function() {
       var filters = $(this).val();
       
       $container.isotope({
       filter: filters
       });
       });*/

      var $optionSets = $('#portfolio_filter'),
              $optionLinks = $optionSets.find('.filter-item');

      $optionLinks.click(function() {

        var $this = $(this);
        // don't proceed if already selected
        if ($this.hasClass('current')) {
          return false;
        }
        var $optionSet = $this.parents('.option-set');
        $optionSet.find('.current').removeClass('current');
        $this.addClass('current');

        // make option object dynamically, i.e. { filter: '.my-filter-class' }
        var options = {},
                key = $optionSet.attr('data-option-key'),
                value = $this.attr('data-option-value');
        // parse 'false' as false boolean
        value = value === 'false' ? false : value;
        options[ key ] = value;
        if (key === 'layoutMode' && typeof changeLayoutMode === 'function') {
          // changes in layout modes need extra logic
          changeLayoutMode($this, options)
        } else {
          // otherwise, apply new options
          $container.isotope(options);
        }

        return false;
      });
    });





    jQuery('#portfolio_carousel').jcarousel({
      scroll: ($(window).width() > 767 ? 4 : 1),
      easing: 'easeInOutExpo',
      animation: 600
    });



    // Reload carousels on window resize to scroll only 1 item if viewport is small
    $(window).resize(function() {
      if ($("#portfolio_carousel").length) {
        var el = $("#portfolio_carousel"), carousel = el.data('jcarousel'), win_width = $(window).width();
        var visibleItems = (win_width > 767 ? 4 : 1);
        carousel.options.visible = visibleItems;
        carousel.options.scroll = visibleItems;
        carousel.reload();
      }
    });





    $('#featured_services_carousel').jcarousel({
      scroll: ($(window).width() > 767 ? 4 : 1),
      easing: 'easeInOutExpo',
      animation: 600
    });


    // Reload carousels on window resize to scroll only 1 item if viewport is small
    $(window).resize(function() {
      if ($("#featured_services_carousel").length) {
        var el = $("#featured_services_carousel"), carousel = el.data('jcarousel'), win_width = $(window).width();
        var visibleItems = (win_width > 767 ? 4 : 1);
        carousel.options.visible = visibleItems;
        carousel.options.scroll = visibleItems;
        carousel.reload();
      }
    });


    jQuery('#testimonials_carousel').jcarousel({
      auto: 4,
      scroll: 1,
      wrap: 'last',
      easing: 'easeInOutExpo',
      animation: 600
    });

    jQuery(window).resize(function() {
      if (jQuery("#testimonials_carousel").length) {
        var el = jQuery("#testimonials_carousel"), carousel = el.data('jcarousel'), win_width = jQuery(window).width();

        carousel.options.visible = 1;
        carousel.options.scroll = 1;
        carousel.reload();
      }
    });



    $('#tabs a').tabs();

    /*$('.atabs .tabs-items li').each(function() {
     var selector = $(this);
     var obj = $(this);
     var a_item = obj.find('a');
     
     // obj.parent().parent().parent().find(".tab-content").hide();
     $(obj.find('a').attr('href')).hide();
     if (obj.children('a').hasClass('selected')) {
     // var tab_content_id = a_item.attr('href');
     
     $(obj.find('a').attr('href')).show();
     
     }
     
     selector.click(function() {
     $(this).parent().parent().parent().find(".tab-content").hide();
     var selected_tab = $(this).find("a").attr("href");
     $(selected_tab).fadeIn();
     $(this).parent().find("a").removeClass('selected');
     $(this).find('a').addClass("selected");
     return false;
     });
     
     
     });*/




    jQuery('#clients_carousel').jcarousel({
      auto: 4,
      scroll: 1,
      easing: 'easeInOutExpo',
      animation: 600
    });

    jQuery(window).resize(function() {
      if (jQuery('#clients_carousel').length) {
        var el = jQuery("#clients_carousel"), carousel = el.data('jcarousel'), win_width = jQuery(window).width();
        var visibleItems = (win_width > 767 ? 4 : 1);
        carousel.options.visible = visibleItems;
        carousel.options.scroll = visibleItems;
        carousel.reload();
      }
    });

    $('.block-layer-slider .ls-container.ls-aqua').hover(function() {

      $this = $(this);
      $this.find('.ls-nav-prev').addClass('prev').html('<span></span>').removeClass('ls-nav-prev');

      $this.find('.ls-nav-next').addClass('next').html('<span></span>').removeClass('ls-nav-next');

    });
    // modify layer slider next, and prev button


    $(".block-layer-slider .ls-container").hover(
            function() {
              $(".prev, .next").stop().animate({
                opacity: 0.7
              }, 300);
            },
            function() {
              $(".prev, .next").stop().animate({
                opacity: 0
              }, 300);
            }
    );

    $(".prev, .next").hover(
            function() {
              $(this).stop().animate({
                opacity: 1
              }, 200);
            },
            function() {
              $(this).stop().animate({
                opacity: 0.7
              }, 200);
            }
    );


    $('#tooltip1').tipsy({
      fade: true,
      gravity: 's'
    });

    $('#tooltip2').tipsy({fade: true, gravity: 's'});
    $('.tooltip').tipsy({fade: true, gravity: 's'});


  });// end document



  //flexslider
  $(window).load(function() {
    $('.flexslider').flexslider({
      animation: "slide",
      controlNav: false,
      start: function(slider) {
        $('body').removeClass('loading');
      }
    });
  });


})(jQuery);