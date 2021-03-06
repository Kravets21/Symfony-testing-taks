function hideOtherForms(form){
    $(form).click(function (e) {
	let exept = "div:not("+form+"_form)";
	$(exept).removeClass("open");
	$(form+"_form").addClass('open');
    });
}
	   
hideOtherForms(".add-product");
hideOtherForms(".catalog");


