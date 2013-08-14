(function ($) {


  $(document).ready(function(){
  
  
    var menu_style_defaukt_value = $('#edit-menu-style').val();
    $('.form-item-menu-color').hide();
    if(menu_style_defaukt_value == 'custom'){
      $('.form-item-menu-color').show();
    }
    $('#edit-menu-style').change(function(){
      $item = $(this);
    
      if($item.val() == 'custom'){
        $('.form-item-menu-color').show();
      }else{
        $('.form-item-menu-color').hide();
      }
    });
  
  
    $('.form-item-bg-color').hide();
  
    var default_bg_image = $('#edit-bg-image').val();
    if(default_bg_image == 'none'){
      $('.form-item-bg-color').show();
    }
    $('#edit-bg-image').change(function(){
      $item_bg = $(this);
    
      if($item_bg.val() == 'none'){
        $('.form-item-bg-color').show();
      }else{
        $('.form-item-bg-color').hide();
      }
    });
    
    
    $('.color').after(('<div class="ls-colorpicker" />'));
  
    jQuery('.ls-colorpicker').each(function() {
      var $item = $(this);
      
      $item.farbtastic( function(color) {

        // Set color code in the input
        // jQuery('.color').val(color);
        
        $item.parent('.form-item.form-type-textfield').find('.color').val(color);

        // Set input background
        //jQuery('.color').css('background-color', color);
        $item.parent('.form-item.form-type-textfield').find('.color').css('background-color', color);

      // Update preview
        
      }).hide();
    });

    // Show color picker on focus
    jQuery('.color').focus(function() {
      jQuery(this).next().slideDown();
    });

    // Show color picker on blur
    jQuery('.color').blur(function() {
      jQuery(this).next().slideUp();
    });
        
        
  });

            
})(jQuery);