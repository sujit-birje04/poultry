$(document).ready(function() {
        jQuery(document).on("click", ".frm_submit", function (e) {
	    	var frm_id=$(this).attr("frm_id");
			var form = $('#'+frm_id);
            var isValid = form.valid();
            if(isValid){
                $('#'+frm_id).submit();
            }
        });

});