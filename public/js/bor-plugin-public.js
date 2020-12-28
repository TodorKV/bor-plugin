(function( $ ) {
	$(document).ready(function() {
	var ajaxurl = todor_bor.ajaxurl;
	
	$(".edit-project-div").hide();


	if(jQuery('#table-list-project').length > 0){
		jQuery('#table-list-project').DataTable();

		// delete project row from datatable
		jQuery(document).on("click", ".btn-delete-project", function(){

			var project_id = jQuery(this).attr("data-id");
	
			var postdata="action=public_ajax_request&param=delete_project&project_id=" + project_id;
			
			var conf = confirm("Are you sure you want to delete this project?");
	
			if(conf) {
				jQuery.post(ajaxurl, postdata, function(response){				
					var data = jQuery.parseJSON(response);
				
					if(data.status == 1){
						alert(data.message);
					
						setTimeout(function(){
							location.reload();
						}, 1000);
					}else{
						alert(data.message);
					
					}
				
				});
			}
		});

		// edit project row from datatable
		jQuery(document).on("click", ".btn-edit-project", function(){

			var project_id = jQuery(this).attr("data-id");
	
			var postdata="action=public_ajax_request&param=edit_project&project_id=" + project_id;
			
			//var conf = confirm("Are you sure you want to edit this project?");
	
			//if(conf) {/
				
				jQuery.post(ajaxurl, postdata, function(response){				
					var data = jQuery.parseJSON(response);
					console.log(response);
					if(data.status == 1){
						//alert(data.message);
					
						setTimeout(function(){
							$(".list-projects-div").hide();
							$(".text-name-input").val(data.name);
							$(".text-desc-input").text(data.description);
							var date = new Date(data.end_date);
							console.log(date);
							date.setDate(date.getDate() + 1);
							date = date.toISOString().substring(0, 10);
							$("#frm-update-book").attr('data-id',data.project_id);
							$(".date-input").val(date);
							$(".edit-project-div").show();
						}, 1000);
					}else{
						alert(data.message);
					
					}
				
				});
			//}
		});
	}
	//cancel project edition
	jQuery(document).on("click", ".cancel-btn", function(){
		$(".list-projects-div").show();
		$(".edit-project-div").hide();
	});

	//UPDATE PROJECT
	jQuery("#frm-update-book").validate({		
		submitHandler: function(){
			
			var project_id = jQuery("#frm-update-book").attr("data-id");
			console.log(project_id);
			var postdata = jQuery("#frm-update-book").serialize();
			postdata += "&action=public_ajax_request&param=update_project&project_id=" + project_id;
			//console.log($(".txt-name-input").val());
			console.log(postdata);
			jQuery.post(ajaxurl, postdata, function(response){

				var data = jQuery.parseJSON(response);

				if(data.status == 1){
					alert(data.message);

					setTimeout(function(){
						location.reload();
					}, 1000);
				}else{
					alert(data.message);
				
				}
			});
		}
	});

	//CREATE PROJECT
	jQuery("#frm-create-book").validate({
				
		submitHandler: function(){
			var postdata = jQuery("#frm-create-book").serialize();

			postdata += "&action=public_ajax_request&param=create_project";

			console.log(postdata);
			jQuery.post(ajaxurl, postdata, function(response){

				var data = jQuery.parseJSON(response);

				if(data.status == 1){
					alert(data.message);

					setTimeout(function(){
						location.reload();
					}, 1000);
				}else{
					alert(data.message);
				
				}
			});
		}
	});


	//btn-front-end-ajax
	$(document).ready(function() {

		jQuery(document).on("click", "#btn-front-end-ajax", function(){
			var postdata = "action=public_ajax_request&param=first_ajax_request";
			jQuery.post(ajaxurl, postdata, function(response){
				var data = jQuery.parseJSON(response);
					
				if(data.status == 1){
					alert(data.message);
				
					setTimeout(function(){
						location.reload();
					}, 1000);
				}else{
					alert(data.message);
				
				}
			});
		});

	});
});
})( jQuery );
