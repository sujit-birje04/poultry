
$(document).ready(function() {
	    jQuery(document).on("click", ".save_show_message", function (e) {
	    	show_loading();
			var frm_id=$(this).attr("frm_id");
			var frm_call_link=$(this).attr("call_link");
			save_show_message(frm_id, frm_call_link);	
        });

        jQuery(document).on("click", ".btn_save_close", function (e) {
                show_loading();
                var frm_id=$(this).attr("frm_id");
                var frm_call_link=$(this).attr("call_link");
                save_and_close(frm_id, frm_call_link);
        });

        jQuery(document).on("click", ".edit_show_message", function (e) {
            show_loading();
            var frm_id=$(this).attr("frm_id");
            var frm_call_link=$(this).attr("call_link");
            edit_show_message(frm_id, frm_call_link);   
        });

        jQuery(document).on("click", ".btn_delete", function (e) {
            var frm_call_link=$(this).attr("call_link");
            var is_confirm = confirm("Are you sure you want delete this item?");
            if(is_confirm){
                delete_from_link(frm_call_link);   
            }
        });

        jQuery(document).on("click", ".btn_change", function (e) {
            var frm_call_link=$(this).attr("call_link");
            var is_confirm = confirm("Are you sure you want change status?");
            if(is_confirm){
                delete_from_link(frm_call_link);   
            }
        });

        jQuery(document).on("change", ".upload_image", function (e) {
                var image_wrapper_id =$(this).attr("image_output_id");
                var image_link_id=$(this).attr("image_id");
                var frm_id=$(this).attr("frm_id");
                var input_name=$(this).attr("name");
                var is_thumb = 0;
                if(image_link_id == 'cat_logo_path'){
                    is_thumb = 1;
                }
                upload_image(frm_id,image_wrapper_id,image_link_id,input_name,is_thumb);
        });

        jQuery(document).on("change", ".change_on_select", function (e) {
            var frm_id=$(this).attr("frm_id");
            var target_id=$(this).attr("target_id");
            var call_link=$(this).attr("call_link");
            change_on_select(frm_id,target_id,call_link);
        });

        jQuery(document).on("click", "#btn_cancel", function (e) {
            var call_url=$(this).attr("call_url");
            window.location = call_url;
        });

        jQuery(document).on("click", "#btn_login", function (e) {
            show_loading();
            var frm_id=$(this).attr("frm_id");
            var frm_call_link=$(this).attr("call_link");
            login(frm_id, frm_call_link);   
        });

        jQuery(document).on("keyup", "#txt_username, #txt_password", function (e) {
            if(event.keyCode == 13){
                show_loading();
                var frm_id=$("#btn_login").attr("frm_id");
                var frm_call_link=$("#btn_login").attr("call_link");
                login(frm_id, frm_call_link);
            }
        });

        jQuery(document).on("click", "#menu_type", function (e) {
            var menu_type=$(this).val();
            $(".unique_menu").find("input, select").attr("disabled", true);
            $(".unique_menu").hide();
            $("#menu_"+menu_type).show();  
            $("#menu_"+menu_type).find("input, select").attr("disabled", false); 

        });


        /****************************************************
         ** Below functions are used for product management**
         ****************************************************/
        jQuery(document).on("click", "#btn_next_comman, #btn_next_comman_edit", function (e) {
            var click_btn=$(this).attr("click_btn");
            var show_btn=$(this).attr("show_btn");
            var frm_id=$(this).attr("frm_id");
            var frm_call_link=$(this).attr("call_link");
            save_product_comman(click_btn, show_btn, frm_id, frm_call_link, $(this));
            
        });

        jQuery(document).on("change", "#product_image_upload", function (e) {
            var image_wrapper_id ="product_gallery";
            var frm_id=$(this).attr("frm_id");
            var upload_link=$(this).attr("call_link");
            upload_product_image(frm_id,image_wrapper_id,upload_link);
        });


        jQuery(document).on("change", "#product_image_upload_unique", function (e) {
            var image_wrapper_id = $(this).attr("output_wrapper");
            var frm_id=$(this).attr("frm_id");
            var upload_link=$(this).attr("call_link");
            upload_product_image(frm_id,image_wrapper_id,upload_link);
        });
        

        jQuery(document).on("click", "#add_new_feature", function (e) {
            var lable =$("#add_new_feature_lable").val();
            var order =$("#add_new_feature_order").val();
            var counter=parseInt($(this).attr("counter"));
            if(lable == ""){
                $("#add_new_feature_lable").hide();
                $("#add_new_feature_lable").fadeIn(); 
            } else if(order == ""){
                $("#add_new_feature_order").hide();
                $("#add_new_feature_order").fadeIn();
            } else {
                var html = '<div class="form-group" id="feature_inner_'+counter+'" >'                
                     +'<div class="col-md-5 col-sm-5 col-xs-12">'
                     +'   <input type="text" name="productFeatureLable[]" value="'+lable+'" placeholder="lable" class="form-control col-md-7 col-xs-12">'
                     +'</div>'
                     +'<div class="col-md-5 col-sm-5 col-xs-12">'
                     +'   <input type="text" name="productFeatureOrder[]" value="'+order+'" placeholder="Sort Order"   class="form-control col-md-7 col-xs-12">'
                     +'</div>'
                     +'<button type="button" class="btn btn-primary btn remove_feature" counter="'+counter+'" ><i class="fa fa-close"></i></button>'
                +'</div>';
                $("#feature_wrapper").append(html);
                $(this).attr("counter",counter+1);
                $("#add_new_feature_lable").val('');
                $("#add_new_feature_order").val('');
            }
        });

        jQuery(document).on("click", ".remove_feature", function (e) {
            var counter = $(this).attr("counter");
            $("#feature_inner_"+counter).remove();
        });

        jQuery(document).on("click", "#add_new_specification", function (e) {
            var lable =$("#add_new_spec_lable").val();
            var value =$("#add_new_spec_value").val();
            var order =$("#add_new_spec_order").val();
            var counter=parseInt($(this).attr("counter"));
            if(lable == ""){
                $("#add_new_spec_lable").hide();
                $("#add_new_spec_lable").fadeIn(); 
            } else if(value == ""){
                $("#add_new_spec_value").hide();
                $("#add_new_spec_value").fadeIn();
            }else if(order == ""){
                $("#add_new_spec_order").hide();
                $("#add_new_spec_order").fadeIn();
            } else {
                var html = ''
                +'<div class="form-group" id="specification_'+counter+'" >'
                 +'<div class="col-md-4 col-sm-4 col-xs-12">'
                    +'<input type="text" value="'+lable+'" name="SpecificationLable[]" class="form-control col-md-7 col-xs-12">'
                 +'</div>'
                 +'<div class="col-md-3 col-sm-3 col-xs-12">'
                    +'<input  value="'+value+'" type="text" name="SpecificationValue[]" class="form-control col-md-7 col-xs-12">'
                 +'</div>'
                 +'<div class="col-md-3 col-sm-3 col-xs-12">'
                    +'<input  value="'+order+'" type="text" name="SpecificationOrder[]" class="form-control col-md-7 col-xs-12">'
                 +'</div>'
                 +'<button type="button" wrapper_id="specification_'+counter+'" class="btn btn-primary btn remove_spec" counter="'+counter+'" ><i class="fa fa-close"></i></button>'
              +'</div>';
                $("#specification_wrapper").append(html);
                $(this).attr("counter",counter+1);
                $("#add_new_spec_lable").val('');
                $("#add_new_spec_value").val('');
                $("#add_new_spec_order").val('');
            }
        });

        jQuery(document).on("click", ".add_new_spec_unique", function (e) {
            var web_id =$(this).attr("web_id"); 
            var lable =$("#add_new_spec_lable_u"+web_id).val();
            var value =$("#add_new_spec_value_u"+web_id).val();
            var order =$("#add_new_spec_order_u"+web_id).val();
            var counter=parseInt($(this).attr("counter"));
            if(lable == ""){
                $("#add_new_spec_lable_u"+web_id).hide();
                $("#add_new_spec_lable_u"+web_id).fadeIn(); 
            } else if(value == ""){
                $("#add_new_spec_value_u"+web_id).hide();
                $("#add_new_spec_value_u"+web_id).fadeIn();
            }else if(order == ""){
                $("#add_new_spec_order_u"+web_id).hide();
                $("#add_new_spec_order_u"+web_id).fadeIn();
            } else {
                var html = ''
                +'<div class="form-group" id="specification_u_'+web_id+'_'+counter+'" >'
                 +'<div class="col-md-4 col-sm-4 col-xs-12">'
                    +'<input type="text" value="'+lable+'" name="SpecificationLableUnique['+web_id+'][]" class="form-control col-md-7 col-xs-12">'
                 +'</div>'
                 +'<div class="col-md-3 col-sm-3 col-xs-12">'
                    +'<input  value="'+value+'" type="text" name="SpecificationValueUnique['+web_id+'][]" class="form-control col-md-7 col-xs-12">'
                 +'</div>'
                 +'<div class="col-md-3 col-sm-3 col-xs-12">'
                    +'<input  value="'+order+'" type="text" name="SpecificationOrderUnique['+web_id+'][]" class="form-control col-md-7 col-xs-12">'
                 +'</div>'
                 +'<button type="button" wrapper_id="specification_u_'+web_id+'_'+counter+'" class="btn btn-primary btn remove_spec" counter="'+counter+'" ><i class="fa fa-close"></i></button>'
              +'</div>';
                $("#specification_wrapper_u"+web_id).append(html);
                $(this).attr("counter",counter+1);
                $("#add_new_spec_lable_u"+web_id).val('');
                $("#add_new_spec_value_u"+web_id).val('');
                $("#add_new_spec_order_u"+web_id).val('');
            }
        });


        jQuery(document).on("click", ".add_new_feature_unique", function (e) {
            var web_id =$(this).attr("web_id"); 
            var lable =$("#add_new_feature_lable_u"+web_id).val();
            var order =$("#add_new_feature_order_u"+web_id).val();
            var counter=parseInt($(this).attr("counter"));
            if(lable == ""){
                $("#add_new_feature_lable_u"+web_id).hide();
                $("#add_new_feature_lable_u"+web_id).fadeIn(); 
            } else if(order == ""){
                $("#add_new_feature_order_u"+web_id).hide();
                $("#add_new_feature_order_u"+web_id).fadeIn();
            } else {
                var html = '<div class="form-group" id="feature_inner_u_'+web_id+'_'+counter+'" >'                
                     +'<div class="col-md-5 col-sm-5 col-xs-12">'
                     +'   <input type="text" name="productFeatureLableUnique['+web_id+'][]" value="'+lable+'" placeholder="lable" class="form-control col-md-7 col-xs-12">'
                     +'</div>'
                     +'<div class="col-md-5 col-sm-5 col-xs-12">'
                     +'   <input type="text" name="productFeatureOrderUnique['+web_id+'][]" value="'+order+'" placeholder="Sort Order"   class="form-control col-md-7 col-xs-12">'
                     +'</div>'
                     +'<button type="button" class="btn btn-primary btn remove_spec" wrapper_id="feature_inner_u_'+web_id+'_'+counter+'" counter="'+counter+'" ><i class="fa fa-close"></i></button>'
                +'</div>';
                $("#feature_wrapper_u_"+web_id).append(html);
                $(this).attr("counter",counter+1);
                $("#add_new_feature_lable_u"+web_id).val('');
                $("#add_new_feature_order_u"+web_id).val('');
            }
        });


        jQuery(document).on("click", ".remove_spec", function (e) {
            var counter = $(this).attr("counter");
            var remove_id = $(this).attr("wrapper_id");
            $("#"+remove_id).remove();
        });


        jQuery(document).on("click", "#btn_back_unique", function (e) {
            var click_btn=$(this).attr("click_btn");
            $("#"+click_btn).click();
        });


        jQuery(document).on("click", "#btn_save_unique", function (e) {
            var frm_id=$(this).attr("frm_id");
            var frm_call_link=$(this).attr("call_link");
            save_product_unique(frm_id, frm_call_link, 0, $(this));
            
        });


        jQuery(document).on("click", "#btn_save_close_unique", function (e) {
            var frm_id=$(this).attr("frm_id");
            var frm_call_link=$(this).attr("call_link");
            save_product_unique(frm_id, frm_call_link, 1, $(this));
        });

        jQuery(document).on("click", ".delete_product_item", function (e) {
            var frm_call_link=$(this).attr("call_link");
            var remove_id = $(this).attr("wrapper_id");
            
            var is_confirm = confirm("Are you sure you want delete this item?");
            if(is_confirm){
                delete_product_item(frm_call_link, remove_id);   
            }
        });


        jQuery(document).on("click", ".delete_and_hide_item", function (e) {
            var frm_call_link=$(this).attr("call_link");
            var input_id = $(this).attr("input_id");
            var output_id = $(this).attr("output_id");
            
            var is_confirm = confirm("Are you sure you want delete this item?");
            if(is_confirm){
                delete_and_hide_item(frm_call_link, input_id, output_id);   
            }
        });

        


        jQuery(document).on("click", ".unlink_unsaved", function (e) {
            var frm_call_link=$(this).attr("call_link");
            var remove = $(this).parent();
            
            var is_confirm = confirm("Are you sure you want delete this item?");
            if(is_confirm){
                delete_unsaved_image(frm_call_link, remove);   
            }
        });
        

        jQuery(document).on("click", ".btn_perform_redirect", function (e) {
                show_loading();
                var frm_id='';
                var is_redirect='';
                var call_link=$(this).attr("call_link");
                perform_and_redirect(frm_id, is_redirect, call_link);
        });
        

});


// Function used to login and redirect it to new link
function login(frm_id, call_link){
    var form = $('#'+frm_id);
    $.ajax({
      type: "POST",
      url: call_link,
      data: form.serialize(),
      success: function( response ) {
        var outArr = JSON.parse(response);
        if(outArr.status){
            hide_loading();
            document.getElementById(frm_id).reset();
            window.location = outArr.next_url;
            show_message(outArr.msg, outArr.status);
        } else {
            hide_loading();
            show_message(outArr.msg, outArr.status);
        }
      }
    });
}



// Function used to save the forms and shows message
function save_show_message(frm_id, call_link){
    CKupdate();
	var form = $('#'+frm_id);
	$.ajax({
	  type: "POST",
	  url: call_link,
	  data: form.serialize(),
	  success: function( response ) {
	    var outArr = JSON.parse(response);
        //alert(frm_id);
        if(outArr.status){
        	$('.hide_after_save').hide();
	    	hide_loading();
        	document.getElementById(frm_id).reset();
        	show_message(outArr.msg, outArr.status);
    	} else {
        	hide_loading();
        	show_message(outArr.msg, outArr.status);
    	}
	  }
	});
}


// Function used to save the edited forms and shows message
function edit_show_message(frm_id, call_link){
    CKupdate();
    
    var form = $('#'+frm_id);
    $.ajax({
      type: "POST",
      url: call_link,
      data: form.serialize(),
      success: function( response ) {
        var outArr = JSON.parse(response);
        if(outArr.status){
            $('.hide_after_save').hide();
            hide_loading();
            show_message(outArr.msg, outArr.status);
        } else {
            hide_loading();
            show_message(outArr.msg, outArr.status);
        }
      }
    });
}


// Function used to save the forms and redirect it to new link
function save_and_close(frm_id, call_link){
    CKupdate();
    
	var form = $('#'+frm_id);
	$.ajax({
	  type: "POST",
	  url: call_link,
	  data: form.serialize(),
	  success: function( response ) {
	    var outArr = JSON.parse(response);
        if(outArr.status){
        	$('.hide_after_save').hide();
	    	hide_loading();
        	document.getElementById(frm_id).reset();
        	window.location = outArr.next_url;
        	show_message(outArr.msg, outArr.status);
    	} else {
        	hide_loading();
        	show_message(outArr.msg, outArr.status);
    	}
	  }
	});
}

// Function used to save the forms and redirect it to new link
function perform_and_redirect(frm_id, is_redirect, call_link){
    CKupdate();
    var data_send = '';
    if(frm_id){
        var form = $('#'+frm_id); 
        data_send = form.serialize();  
    }
    $.ajax({
      type: "POST",
      url: call_link,
      data: data_send,
      success: function( response ) {
        var outArr = JSON.parse(response);
        if(outArr.status){
            hide_loading();
            if(is_redirect == true){
                window.location = outArr.next_url;
            }
            show_message(outArr.msg, outArr.status);
        } else {
            hide_loading();
            show_message(outArr.msg, outArr.status);
        }
      }
    });
}



// Function used to upload the image
function upload_image(frm_id,image_wrapper,image_link,input_name,is_thumb) {
    console.log("submit event");
    var fd = new FormData(document.getElementById(frm_id));
    fd.append("label", "WEBUPLOAD");
    $.ajax({
      url: "../controller/upload-controller.php?input_name="+input_name+"&is_thumb="+is_thumb,
      type: "POST",
      data: fd,
      processData: false,  // tell jQuery not to process the data
      contentType: false   // tell jQuery not to set contentType
    }).done(function( data ) {
        var outArr = JSON.parse(data);
        if(outArr.status){
            //alert(image_wrapper);
        	$('#'+image_wrapper).attr("src", "../"+outArr.link);
        	$('#'+image_wrapper).show();
        	$('#'+image_link).val(outArr.link_in);
        	show_message(outArr.msg, outArr.status);
    	} else {
        	$('#'+image_wrapper).attr("src", "");
        	$('#'+image_wrapper).hide();
        	$('#'+image_link).val("");
        	show_message(outArr.msg, outArr.status);
    	}
    });
    return false;
}


// Function used to delete the row on the link
function delete_from_link(call_link){
    $.ajax({
      type: "POST",
      url: call_link,
      success: function( response ) {
        var outArr = JSON.parse(response);
        if(outArr.status){
            if(outArr.next_url){
                window.location = outArr.next_url;   
            }
            show_message(outArr.msg, outArr.status);
        } else {
            hide_loading();
            show_message(outArr.msg, outArr.status);
        }
      }
    });
}

    function CKupdate(){
        for ( instance in CKEDITOR.instances )
            CKEDITOR.instances[instance].updateElement();
    }


// Used to update 
    function change_on_select(frm_id,target_id,call_link){
        var form = $('#'+frm_id);
        $.ajax({
          type: "POST",
          url: call_link,
          data: form.serialize(),
          success: function( response ) {
            var outArr = JSON.parse(response);
            if(outArr.status){
                $("#"+target_id).html(outArr.data);
                $("#unique_prop_wrapper").html(outArr.html_unique);
                    
            }
          },
          fail: function(){
            alert("Some error");
          }

        });
    }

    function save_product_comman(click_btn, show_btn, frm_id, call_link, btn){
        CKupdate();
        btn.hide();
        var form = $('#'+frm_id);
        $.ajax({
          type: "POST",
          url: call_link,
          data: form.serialize(),
          success: function( response ) {
            var outArr = JSON.parse(response);
            if(outArr.status){
                $("#"+click_btn).click();
                $("#"+show_btn).removeClass("product_tab_hidden");
                show_message(outArr.msg, outArr.status);
                $('.product_id_hidden').val(outArr.product_id);
                $("#btn_next_comman").hide();
                $(".btn_next_comman_edit").show();
                if(outArr.next_url){
                    window.location = outArr.next_url;
                }
            } else {
                show_message(outArr.msg, outArr.status);
            }
            btn.fadeIn();
          },
          fail: function(){
            alert("Some error");
            btn.fadeIn();
          }

        });   
    }


    function save_product_unique(frm_id, call_link, is_redirect, btn){
        CKupdate();
        btn.html("Working..");
        var form = $('#'+frm_id);
        $.ajax({
          type: "POST",
          url: call_link,
          data: form.serialize(),
          success: function( response ) {
            var outArr = JSON.parse(response);
            if(outArr.status){
                show_message(outArr.msg, outArr.status);
                btn.html("Save");
                if(is_redirect == 1){
                    btn.html("Save & Close");
                    window.location = outArr.next_url;
                } else {
                    window.location = 'edit_product.php?id='+outArr.product_id+"&tab=unique";
                }
                
            } else {
                show_message(outArr.msg, outArr.status);
                btn.html("Save");
                if(is_redirect == 1){
                    btn.html("Save & Close");
                }
            }
          },
          fail: function(){
            alert("Some error"); 
            btn.html("Save");
            if(is_redirect == 1){
                btn.html("Save & Close");
            }
          }

        });   
    }

    function delete_product_item(call_link, remove_id){
        CKupdate();
        $.ajax({
          type: "POST",
          url: call_link,
          success: function( response ) {
            var outArr = JSON.parse(response);
            //alert("ddf");
            if(outArr.status){
                //window.location = outArr.next_url;
                //alert(remove_id);
                $("#"+remove_id).remove();
                //show_message(outArr.msg, outArr.status);
            } else {
                hide_loading();
                show_message(outArr.msg, outArr.status);
            }
          }
        });
    }

    function delete_and_hide_item(call_link, input_id, output_id){
        CKupdate();
        $.ajax({
          type: "POST",
          url: call_link,
          success: function( response ) {
            var outArr = JSON.parse(response);
            if(outArr.status){
                $("#"+output_id).hide();
                $("#"+input_id).val("");
                if(outArr.next_url){
                    window.location = outArr.next_url;
                }
            } else {
                hide_loading();
                show_message(outArr.msg, outArr.status);
            }
          }
        });
    }



    function delete_unsaved_image(call_link, parent_div){
        CKupdate();
        $.ajax({
          type: "POST",
          url: call_link,
          success: function( response ) {
            var outArr = JSON.parse(response);
            if(outArr.status){
                parent_div.remove();
            } else {
                hide_loading();
                show_message(outArr.msg, outArr.status);
            }
          }
        });
    }

    



    // Function used to upload the image
    function upload_product_image(frm_id,image_wrapper,call_link) {
        console.log("submit event");
        var fd = new FormData(document.getElementById(frm_id));
        fd.append("label", "WEBUPLOAD");
        $.ajax({
          url: call_link,
          type: "POST",
          data: fd,
          processData: false,  // tell jQuery not to process the data
          contentType: false   // tell jQuery not to set contentType
        }).done(function( data ) {
            var outArr = JSON.parse(data);
            if(outArr.status){
                $('#'+image_wrapper).html(outArr.html);
                show_message(outArr.msg, outArr.status);
            } else {
                show_message(outArr.msg, outArr.status);
            }
        });
        return false;
    }





/*
    Comman functions
*/
function show_loading(){
	$("#wait_loader").fadeIn();
}

function hide_loading(){
	$("#wait_loader").fadeOut();
}

function show_message(msg, type){
	$(".frm_error_message").removeClass("alert-success");
	$(".frm_error_message").removeClass("alert-error");
	if(type){
		$(".frm_error_message").addClass("alert-success");
	} else {
		$(".frm_error_message").addClass("alert-error");
	}
	$(".frm_error_message").html(msg);
	$(".frm_error_message").show();
	setTimeout('$(".frm_error_message").fadeOut();',3000)
}