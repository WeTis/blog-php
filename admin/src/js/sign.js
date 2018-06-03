(function($){
 $('.sign input').click(function(){
 	let username = $('.username input').val();
 	let password = $('.password input').val();
 	$.ajax({
 		type: 'POST',
 		url: './php/usersign.php',
 		data: {
 			username: username,
 			password: password
 		},
 		success: function(data){
 			if(data==1)
 			{
 				console.log('登录成功');
 				// 跳转到登录页
 				window.location.href='index.html';
 			}else{
 				alert('登录失败');
 			}
 		}
 	})
 })
})(jQuery)