(function($){
  
  $.ajax({
  	type: 'POST',
  	url: './php/gettext.php',
  	data:{

  	},
  	success: function(res){
  		console.log(res);
  		if(res[0].id){
  			let html = '';
  			for(let i = 0, num = res.length; i < num ; i++){
  				let data = res[i];
                html += `
 				  <ul class="list-content">
			   	  	 <li>${data.id}</li>
			   	  	 <li>${data.title}</li>
			   	  	 <li>${data.content}</li>
			   	  	 <li>${data.author}</li>
			   	  	 <li>${data.time}</li>
			   	  	 <li><a href="write.html?id=${data.id}" >编辑</a>|<span class='delect' id='${data.id}'>删除</span></li>
			   	  </ul>
                `;

  			}
  			$('.right-content').append(html);
  			console.log("获取成功");

  		}
	  	$('.delect').click(function(){
		 	// 获取id 和title
		 	let that = $(this);
		 	let id = $(this).attr('id');
		 	let title = $(this).parent().parent().find('li').eq(1).text() ;
		 	console.log(id,title);
		        $.ajax({
		        	type: 'POST',
		        	url: './php/delect.php',
		        	data: {
		        		id: id,
		        		title: title,
		        		delect: 1
		        	},
		        	success: function(data){
		        		if(data == 1)
		        		{
		        			alert('删除成功');
		        			// 删除dom
		        			that.parent().parent().remove();
		        		}else{
		        			alert('删除失败')
		        		}
		        	}
		        })
	 })
  	}
  })
 // 点击删除

})(jQuery)