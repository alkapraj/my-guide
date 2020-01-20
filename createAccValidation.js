function emptyFieldChk(form)
{
	var result 	  = 	emptyString(form.username.value,'Username')
	result 			+= 	emptyString(form.email.value,'Email')
	result 			+= 	emptyString(form.firstname.value,'firstname')
	result 			+= 	emptyString(form.lastname.value,'lastname')
	result	 		+= 	emptyString(form.password1.value,'Password')
	result	 		+= 	emptyString(form.password2.value,'Confirm Password')
	result 			+= equateFields(form.password1.value,form.password2.value,'Passwords do not match')
	
	if(result!="") 
	{
		errAlert(result)
		return false;	//stop form from being submitted
	}	
}