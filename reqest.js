	$(document).ready(function () {
		$("#btn").on("click", function () {
			if($('#details').val()==''){
				alert("Enter ther details");
			}
			else{
				var id_room=$('#id_room').val();
				var details=$('#details').val();
				//alert (details+' '+id_room);
				
				$.ajax({
					type:"POST",
					url:"Add_request.php",
					data:{
						id_room:id_room,
						details:details,
					},
					success:function(f){
						if(f==true){
							alert("Success");
							window.location.href='chat.php';
						}
						else{
							alert("We are processing your request");
							window.location.href='request.php?id_room='+id_room;
						}
					}
					
				});
				
			}
		});
	});
