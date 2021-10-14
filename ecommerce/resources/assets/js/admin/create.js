
(function(){
	'use strict';
	ACMESTORE.admin.create = function(){
		
		//create subcategory	
		$(".add-subcategory").on('click', function(e){
			var token = $(this).data('token');
			var category_id = $(this).attr('id');
			var name = $("#subcategory-name-"+ category_id).val();
			$.ajax({
				type: 'POST',
				/*URLhas to constains slash at the beginning of url record*/
				url: '/admin/products/subcategory/create',
				data: {token: token, name: name, category_id: category_id},
				success: function(data){
					var response = jQuery.parseJSON(data);
//					console.log('Result is ' + response);
					$(".notification").css("display",'block').delay(4000).slideUp(300).html(response.success);
				},
				error: function(request, error){
					var errors = jQuery.parseJSON(request.responseText);
//if I need to find a bug in JS		console.log(errors);
					var ul = document.createElement('ul');
					//loop in JS
					$.each(errors, function(key, value) {
						var li = document.createElement('li');
						li.appendChild(document.createTextNode(value));
						ul.appendChild(li);
					});
			 		$(".notification").css("display",'block').removeClass('primary').addClass('alert').delay(6000).slideUp(300).html(ul);
				}
			});
			e.preventDefault();
		})
	};
})();