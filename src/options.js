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
	    $('#pegus-html-example').toggle();
	});
	
	// Si l'input Exit Social est coché on affiches les options
	 if($("input[name='exit-html']").is(':checked')){
		    $('.show_options_html').show();
		    $('#pegus-html-example').show();
	    }
	    
	// Charger le code HTML d'exemple
	
	$("#pegus-html-example").on('click', function(e){
		e.preventDefault();
		$('.pegus_textarea').empty().text('<div class="pegus-html"> \n <img class="pegus" src="http://www.antoinebrossault.com/pegus/demo/pegus-animal.png">\n <img class="logo" src="http://www.antoinebrossault.com/pegus/demo/pegus-logo.png">\n </div>\n \n <a href="http://www.antoinebrossault.com/pegus/pegus-exit-popup-V01-beta.zip">\n <button class="bouton pegus-btn"> Télecharger </button>\n </a>\n \n <style>\n \n .pegus_popup{\n height:400px!important; \n width:600px!important;}\n\n .pegus-html{\n position:relative!important;}\n\n .pegus-html .pegus{\n position:absolute;\n top:22px;\n left:-16px;\n width:300px;\n height:auto;}\n \n .pegus-html .logo{\n position:absolute;\n top:95px;\n width:251px;\n right:10px;\n height:auto}\n \n .pegus-btn{\n position:absolute;\n bottom:39px;\n width:290px;\n right:16px;\n height:45px;\n line-height:45px;\n opacity:1;\n text-align:center;\n color:#FFF;\n background-color:#e5c070}\n \n .pegus_title{\n color:#FFF}</style>\n\n');
	});
	
	
     
})( jQuery );