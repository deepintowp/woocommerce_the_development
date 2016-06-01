jQuery(document).ready(function($){
	
	
  var frame;
      
  // ADD IMAGE LINK
  $('#add_cat_img').on( 'click', function( event ){
    
    event.preventDefault();
    
    // If the media frame already exists, reopen it.
    if ( frame ) {
      frame.open();
      return;
    }
    
    // Create a new media frame
    frame = wp.media({
      title: 'Add Category Image',
      button: {
        text: 'Insert Into Category'
      },
      multiple: false  
    });

    
  
    frame.on( 'select', function() {
      
      
      var attachment = frame.state().get('selection').first().toJSON();

    
      $('.cat-img-con').html( '<img src="'+attachment.url+'" alt="" style="width:40%;"/>' );

      
      $('#cat_term_img').val( attachment.url );

      
    });

    
    frame.open();
  });
	
	// DELETE IMAGE LINK
  $('#remove_cat_img').on( 'click', function( event ){

    event.preventDefault();
  $('.cat-img-con').html( '' );

    $('#cat_term_img').val( '' );

  });
	
	
});