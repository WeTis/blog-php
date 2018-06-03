(function($){
   // 注册获取表单值
  let username = $('input[name="username"]');
  let reallname = $('input[name="reallname"]');
  let password = $('input[name="password"]');
  let againpassword = $('input[name="againpassword"]');
  let tell = $('input[name="tell"]');
  let email = $('input[name="email"]');
  let showimg = $('.showhide');
  let zhuce = $('#zhuce');
  let xiugai = $('#xiugai');
   // 修改信息
if(window.location.href.split('?')[1]){
  let url = (window.location.href.split('?'))[1].split('=');
   if(url[0] === 'id' && url[1]){
         // 是点击编辑跳转过来的
         // 获取对应值填入表单
      console.log('满足');
      $.ajax({
        type: 'POST',
        url: './php/queryuser.php',
        data: {
          id: url[1]
        },
        success: function(res){
          console.log(res);
          console.log(JSON.parse(res));
          let data = JSON.parse(res);
          if(data.username){
            // 获取成功
            console.log('成功');
            username.val(data.username);
            reallname.val(data.nickname);
            tell.val(data.tell);
            email.val(data.email);
            showimg.attr('src','./common/img/'+data.img);
            showimg.show();
            zhuce.css('display','none');
            xiugai.css('display','block');
          }else{
            console.log('失败');
          }
        }
      })
   }
    // 修改
  xiugai.click(function(){
    let formData = new FormData();
    formData.append('file', $('#file')[0].files[0]);
    formData.append('username', username.val());
    formData.append('reallname', reallname.val());
    formData.append('password', password.val());
    formData.append('tell', tell.val());
    formData.append('email', email.val());
    formData.append('modify', 1);
    formData.append('id',url[1]);
    $.ajax({
       type: 'POST',
       url: './php/sign.php',
       data: formData,
       cache: false,
       processData: false,
       contentType: false,
       success: function(res){
        console.log(res);
        if(res>0){
          alert('修改成功');
        }else{
          alert('修改失败');
        }
       }
     })
  })
}
   
  
  // let filename = $('input[name="filename"]');
  // 前端表单验证
 input()
  function input(){
  	// 不能包含非法字符
  	username.keyup(function(){
		let value = $(this).val();
		let str = new RegExp(/[!@#%&*.//\\]/);
        if(str.test(value)){
        	console.log('不能包含非法字符(!@#%&*./\\)');
        	$(this).next().text('不能包含非法字符').css('color','red');
        }else{
        	$(this).next().text('输入合法').css('color','#03ac62');
        	
        } 
  	})
  	username.blur(function(){
  		$.ajax({
        		type: 'POST',
        		url: './php/sign.php?isuser=1',
        		data: {
        			name: username.val()
        		},
        		success: function(res){
                   if(res!=1){
                   	username.next().text('输入合法').css('color','#03ac62');
                   }else{
                   	username.next().text('用户名已经占用').css('color','red');
                   }
        		}
        	})
  	})
  	reallname.keyup(function(){
		let value = $(this).val();
		let str = new RegExp(/[!@#%&*.//\\]/);
        if(str.test(value)){
        	console.log('不能包含非法字符(!@#%&*./\\)');
        	$(this).next().text('不能包含非法字符').css('color','red');
        }else{
        	$(this).next().text('输入合法').css('color','#03ac62');
        } 
  	})
  	password.keyup(function(even){
         	let value = $(this).val();
            let str = new RegExp(/\./);
            if(str.test(value)){
            	
            	$(this).next().text('不能包含非法字符').css('color','red');
            }else if(value.length<8 || value.length>20){
            	$(this).next().text('密码长度错误').css('color','red');
            }else{
            	$(this).next().text('输入合法').css('color','#03ac62');
            }

         })
    againpassword.keyup(function(even){
     	let value = $(this).val().split("");
     	
        let str = password.val().split("");
        
        for(let i = 0; i<value.length; i++){
        	
        	if( value[i] != str[i] )
        	{
        		$(this).next().text('两次密码不一致').css('color','red');
        		return false;
        	}
        }
       

     })
     againpassword.blur(function(){
     	let value = $(this).val();
        let str = password.val();
        if(value===str)
        {
        	$(this).next().text('密码正确').css('color','#03ac62');
        }else{
        	$(this).next().text('两次密码不一致').css('color','red');
        }
     })
     tell.keyup(function(){
     	let value = $(this).val();
     	let str = new RegExp(/[0-9]/);
        if(!str.test(value) || value.length>11){
        	$(this).next().text('电话格式错误').css('color','red');
        }else{
        	$(this).next().text('格式正确').css('color','#03ac62');
        }

     })
     email.keyup(function(){
     	let value = $(this).val();
     	let str = new RegExp(/^[a-z0-9]+([._\\-]*[a-z0-9])*@([a-z0-9]+[-a-z0-9]*[a-z0-9]+\.){1,63}[a-z0-9]+$/)
     	if(!str.test(value)){
        	$(this).next().text('邮箱格式错误').css('color','red');
        }else{
        	$(this).next().text('邮箱格式正确').css('color','#03ac62');
        }
     })
  	 
  }
  
  $('#zhuce').click(function(){
 
	let formData = new FormData();
	formData.append('file', $('#file')[0].files[0]);
	formData.append('username', username.val());
	formData.append('reallname', reallname.val());
	formData.append('password', password.val());
	formData.append('tell', tell.val());
	formData.append('email', email.val());
  	 $.ajax({
	   	 type: 'POST',
	   	 url: './php/sign.php',
	   	 data: formData,
	   	 cache: false,
         processData: false,
      	 contentType: false,
	   	 success: function(res){
	   	 	console.log(res);
	   	 	if(res>0){
	   	 		alert('注册成功');
	   	 	}else{
	   	 		alert('注册失败');
	   	 	}
	   	 }
	   })
  })

})(jQuery)