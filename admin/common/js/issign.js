(function($){
   $.ajax({
   	type: 'POST',
   	url: './php/getcookie.php',
   	success: function(res){
   		console.log(res);
   		if(res){
   			
   			$('.author').text(res);
   		}else{
   			window.location.href='./sign.html';
   		}
   	}
   })
})(jQuery)