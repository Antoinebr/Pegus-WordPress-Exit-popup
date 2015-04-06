(function( $ ) {
 
    // Add Color Picker to all inputs that have 'color-field' class
    $(function() {
        $('.color-field').wpColorPicker();
    });
    
    
    $( "input[name='exit-newsletter']" ).on('click', function(){
	    
	    $('.show_options_newsletter').toggle();
	    if($("input[name='exit-newsletter']").attr('value') == "true"){
		    $("input[name='exit-newsletter']").attr('value',"false");
	    }else{
		     $("input[name='exit-newsletter']").attr('value',"true");
	    }
    });

	// On coche la checkbox si la valeur est == true    
    if($("input[name='exit-newsletter']").attr('value') == "true"){
		$("input[name='exit-newsletter']").attr('checked', 'checked');
		$('.show_options_newsletter').show();
	}
    
    
    // SOCIAL 
    
     $( "input[name='exit-social']" ).on('click', function(){
	    $('.show_options_social').toggle();
	});
	
	// Si l'input Exit Social est coché on affiches les options
	 if($("input[name='exit-social']").is(':checked')){
	
		    $('.show_options_social').show();
	    }
	    
	// Exit HTML
	
	 $( "input[name='exit-html']" ).on('click', function(){
	    $('.show_options_html').toggle();
	});
	
	// Si l'input Exit Social est coché on affiches les options
	 if($("input[name='exit-html']").is(':checked')){
	
		    $('.show_options_html').show();
	    }
	
     
})( jQuery );