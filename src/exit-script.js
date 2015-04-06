(function ( $ ) {
	var cookie = $('#pegus-exit').data('cookie');
	var maxamount = parseInt($('#pegus-exit').data('maxamount'));
	var mintime = $('#pegus-exit').data('mintime');
	
	//console.log('cookie '+cookie);
	//console.log('Max Amount '+maxamount);
	//console.log('Min time '+mintime);
	
$.pegus({
		layer: '#pegus-exit',
		maxamount: maxamount,
		cookie: cookie,
		mintime: mintime,
	});
	
	$("html").on('click', '.pegus_close', function(){
	  	$.pegus_close();
	});
	
	
	// Inscription à la newsletter en Ajax
	$("html").on('click', '#pegus-newsletter-button', function(e){
	  	
           	 e.preventDefault();
             var email = $(".pegus-newsletter-email").val();
             var permalink = $("#permalink").val();
             var nonce = $("#pegus-nonce").val();
       
             $this = $(this);
             console.log(email);
             console.log(permalink);
             
             //alert(prenom+nom+email+permalink);             
            
             $.post(permalink+"/pegus-exit-popup/cibles/newsletter.php", // on détermine le fichier cible
             {
	             email: email, // On met le nom du $_POST['name'] suivi de la valeure (ici la varibale
	             pegusnonce: nonce
	         },
	         function(data, status){ // on récupère le statut (NE PAS ENLEVER DATA)

		         console.log(status);
		         console.log(data);
		         if(status == "success"){    // si le statut est = a success
				      $this.next().empty(); // On remet à zero le message
				      $this.next().append(data);
			     }else{
				  	alert("Hmm c'est embarassant une erreur est apparu.");
				 }
  
			});
	 
		 });
	  	
		 
}( jQuery ));