function equateFields(pass1, pass2,msg)
{
	if((pass1==pass2) && (pass1!="")) return ""
	else return msg
}
function emptyString(field,fieldname)
{	
	return (field == "") ? "No "+fieldname+" was entered.\n" : ""			
}
function errAlert(msg)
{
	alert(msg)
}