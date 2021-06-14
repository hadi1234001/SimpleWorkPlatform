$(document).ready(function(){
	$("#btn").on('click',function(){
		var username=$("#username").val();
		var password=$("#password").val();
		if(username==''){
			alert('Enter the Username');
		}
		else if(password==''){
			alert('Enter the Password');
		}
		else{
			$.ajax({
				method:'post',
				url:'check_admin.php',
				data:{
					username:username,
					password:password,
				},
				success:function(f){
					if(f==true){
						alert('Welcome');
						window.location.href='table_request.php';
					}
					else
						alert('Error');
				}
			})
		}
	})
})