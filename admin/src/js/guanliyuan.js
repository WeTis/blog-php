(function($){
  $.ajax({
  	type: 'POST',
  	url: './php/getadmin.php',
  	success: function(res){
  	   // 遍历数组插入表格
  	   for(let i = 0, len = res.length; i < len; i++){
  	   	   let html = `<ul class='adminer-list-text'>
		          <li>${res[i].id}</li>
		          <li><img src="./common/img/${res[i].img}"></li>
		          <li>${res[i].nickname}</li>
		          <li>${res[i].username}</li>
		          <li>${res[i].tell}</li>
		          <li>${res[i].email}</li>
		          <li><a href='zhuce.html?id=${res[i].id}' class="edit">编辑</a>|<span class="delect" id='${res[i].id}'>删除</span></li>
		      </ul>`
           $('.right-content').append(html);

  	   }
	  $('.delect').click(function(){
	  	// 获取数据库id
	  	let that = $(this);
	  	let id = $(this).attr('id');
	  	// 删除数据库
	  	$.ajax({
	  		type: 'POST',
	  		url: './php/getadmin.php?delect=1',
	  		data: {
	  			id: id
	  		},
	  		success: function(data){
	  			if(data == 1){
	  				alert('删除成功');
	  				// 删除dom
	  				that.parent().parent().remove();
	  			}
	  		}
	  	})
	  })
	  // 编辑修改信息


  	}
  })

})(jQuery)

