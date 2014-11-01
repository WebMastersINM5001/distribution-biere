function validateFormLogin(){
	if(document.getElementById("userName").value == "" || document.getElementById("password").value == "" ){
		document.getElementById("userName").style.border="1px solid red";
		document.getElementById("password").style.border="1px solid red";
	}
}