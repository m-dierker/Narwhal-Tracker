$(document).ready(function() {
	CleanupDateInputs();
	HandleRevenueSourceTypeChange("CHECK");
	$("#RevenueSource0RsType").change(function() { HandleRevenueSourceTypeChange($(this).val()); });
	$("#DonationAddForm").submit(function() { return HandleFormSubmit(); });
});

function CleanupDateInputs() {
	var today = new Date();
	var validYears = [today.getFullYear(), today.getFullYear()-1];
	$("#DonationDonDateYear").children().remove();
	for(year in validYears) {
		$("#DonationDonDateYear").append("<option value='" + validYears[year] + "'>" + validYears[year] + "</option>");
	}
	//might be nice to pre-populate month and day fields
}

function HandleRevenueSourceTypeChange(val) {
	if(val == "CHECK" || val == "CASH") {
		$("#RevenueSource0RsAmt").unbind('change').change(function() {
			$("#RevenueSource0RsDepositAmt").val($("#RevenueSource0RsAmt").val());
		});
		$("#RevenueSource0RsDepositAmt").attr("readonly", "readonly").parent().hide();
	}
	if(val == "PAYPAL") {
		$("#RevenueSource0RsAmt").unbind('change');
		$("#RevenueSource0RsDepositAmt").removeAttr("readonly").parent().show();
	}
	if(val == "CHECK" || val == "PAYPAL") {
		$("#RevenueSource0RsNum").parent().show();
	}
	else {
		$("#RevenueSource0RsNum").parent().hide();
	}
	if(val == "CHECK"){
		$("#checkAddress").show();
	}
	else {
		$("#checkAddress").hide();
	}
}

function HandleFormSubmit() {
	var $form = $("#DonationAddForm");
	$("div.error-message").remove();
	var result = ValidateDonationForm($form);
	if(!result) {
		$form.before("<div class='error-message'>There were some errors with the donation form:</div>");
	}
	return result;
}

function ValidateDonationForm(context) {
	var validated = true;
	
	//make sure a date is set
	if($("#DonationDonDateMonth").val() == "" || $("#DonationDonDateDay").val() == "" || $("#DonationDonDateYear").val() == ""){
		validated = false;
		addValidationError($("p.date-select"), "Please select a date");
	}
	else {
		var received = new Date(
			$("#DonationDonDateYear").val(),
			parseInt($("#DonationDonDateMonth").val()) - 1,
			$("#DonationDonDateDay").val()
		);
		if(received > new Date()) {
			validated = false;
			addValidationError($("p.date-select"), "Date cannot be in the future");
		}
	}
	if($("#DonationDonRId").val() == "-1") {
		validated = false;
		addValidationError($("#DonationDonRId"), "Please select a rider");
	}
	var dollarRegex = new RegExp("^[+-]?[0-9]{1,3}(?:,?[0-9]{3})*(?:\.[0-9]{2})?$");
	$("#DonationDonAmt").val($("#DonationDonAmt").val().replace("$", ""));
	if(!dollarRegex.test($("#DonationDonAmt").val())) {
		validated = false;
		addValidationError($("#DonationDonAmt"), "Please specify a valid dollar amount");
	}
	if($("#Donor0DName").val() == "") {
		validated = false;
		addValidationError($("#Donor0DName"), "Please specify the donor's name");
	}
	if(!dollarRegex.test($("#RevenueSource0RsAmt").val())) {
		validated = false;
		addValidationError($("#RevenueSource0RsAmt"), "Please specify a valid dollar amount");
	}
	if(!dollarRegex.test($("#RevenueSource0RsDepositAmt").val())) {
		validated = false;
		addValidationError($("#RevenueSource0RsDepositAmt"), "Please specify a valid dollar amount");
	}
	if($("#RevenueSource0RsAmt").val() != "" && $("#RevenueSource0RsDepositAmt").val() != "" &&
		parseFloat($("#RevenueSource0RsDepositAmt").val()) > parseFloat($("#RevenueSource0RsAmt").val())
	){
		validated = false;
		addValidationError($("#RevenueSource0RsDepositAmt"), "Deposit amount cannot be greater than the source amount");
	}
	if($("#RevenueSource0RsType").val() != "CASH" && $("#RevenueSource0RsNum").val() == "") {
		validated = false;
		addValidationError($("#RevenueSource0RsNum"), "Please specify the check or PayPal number");
	}
	return validated;
}

function addValidationError($selector, message) {
	$selector.after("<div class='error-message'>" + message + "</div>");
	return false;
}