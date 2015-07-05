function checkemail(email) {
	emailpat=/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
	if(!emailpat.test(email))
	{
	return true;
	}else{
	return false;
	}
}
function regform_validation(formObj){
	console.log(formObj);

			
			var uname =		formObj.genUserName.value,
			password =		formObj.genUserPass.value,
			confpassword =	formObj.genUserConfPass.value,
			phone =			formObj.genUserPhone.value,
			email =			formObj.genUserEmail.value,
			isUserName 	= formObj.hdn_successSubmit.value;
			
			if(uname == ""){
				alert("Enter User name");
				formObj.genUserName.focus();
				return false;
			}else{
				if(isUserName == 100){
					alert("User Name already Taken");
					formObj.genUserName.value = "";
					formObj.genUserName.focus();
					return false;
					}
				}
			if(password == ""){
				alert("Enter password");
				formObj.genUserPass.focus();
				return false;
			}			
			if(confpassword == ""){
				alert("Enter Confirm password");
				formObj.genUserConfPass.focus();
				return false;
			}
			if(password != confpassword){
				alert("Password and Confirm Password Should be same");
				formObj.genUserPass.value = "";
				formObj.genUserConfPass.value = "";
				formObj.genUserPass.focus();
				return false;
			}
			if(phone == ""){
				alert("Enter Phone number");
				formObj.genUserPhone.focus();
				return false;
			}else if(isNaN(phone) || phone.length < 10){
				alert("please enter Valid Phone Number");
				formObj.genUserPhone.value = "";
				formObj.genUserPhone.focus();
				return false;
			}
			if(email == ""){
				alert("Enter email");
				formObj.genUserEmail.focus();
				return false;
			}else{
				if(checkemail(email)){
					alert("Wrong email pattern");
					formObj.genUserEmail.focus();
					return false;
				}
			}
}		

function formStateValidate(formObj){
	var stateName = formObj.stateName,
	sltdCountry = formObj.selectCountry;

	if(sltdCountry.value == ""){
		alert("Select a Country for State Entry");
		sltdCountry.focus();
		return false;
	}		
	
	if(stateName.value == ""){
		alert("Enter State Name");
		stateName.focus();
		return false;
	}	

}