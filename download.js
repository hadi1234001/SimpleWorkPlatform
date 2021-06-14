$(document).ready(function () {
	$("#Send").on('click', function () {
		//Get all elements in the document with id="#chreck":
	    var checked = document.querySelectorAll('#check');
		var value;
		//to read all values in checked
            for ( ch of checked) {
                if (ch.checked) {
                    value = ch.value;
                    break;
                }
            }
		if(value==null){
			alert('cheked');
		}else{
           // alert(value);
		var id_project=$('#id_project').val();
		//alert(id_project);
			$.ajax({
				method:'POST',
				url:'add_assessment.php',
				data:{
					assessment:value,
					id_projact:id_project,
				},
				success:function(f){
					if(f==true){
						alert("Thank you");
						window.location.href='project.php';
					}
					else{
						alert('Something went wrong');
					}
				}
			})
		}
	});
});
