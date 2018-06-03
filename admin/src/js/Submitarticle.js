(function($){
let title = $('.title input');
let author = $('.author input');
let time = $('.time input');
let content = $('.content textarea');
let urlphp = './php/addarticle.php';
// 判断是否修改文章
if(window.location.href.split('?')[1]){
  console.log('xiugai');
  let url = (window.location.href.split('?'))[1].split('=');
   if(url[0] === 'id' && url[1]){
   	 urlphp = './php/addarticle.php?updata=1&id='+url[1];
   	 $('#fabu').val('更新');
   	 console.log(url[1]);
   	  // 修改文章 获取文章内容
   	  $.ajax({
   	  	type: 'POST',
   	  	url: './php/gettext.php',
   	  	data: {
   	  		id: url[1]
   	  	},
   	  	success: function(data){
            console.log(data);
   	  		if(data.title){
   	  			title.val(data.title);
   	  			author.val(data.author);
   	  			time.val(data.time);
   	  			content.val(data.content);
   	  			ue.addListener("ready", function () {  
		               // editor准备好之后才可以使用  
		             UE.getEditor('container').setContent(data.text); 
		  
		       });  
   	  			
   	  		}
   	  	}
   	  })
   }
}

	$('#fabu').click(function(){
		let text = UE.getEditor('container').getContent();
		//将文章上传至数据库blog-text
		$.ajax({
			type: 'POST',
			url: urlphp,
			data: {
				title:title.val() ,
				author: author.val(),
				time: time.val(),
				content: content.val(),
				text: text 
			},
			success: function(res){
				alert(res);
			}
		})
	})
		

})(jQuery)