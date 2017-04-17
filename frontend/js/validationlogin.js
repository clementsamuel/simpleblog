function checkForm(){
	var x = document.forms["myForm"]["email"].value;
	if (x==null || x=="") {
	    alert("Enter your email address");
	    return false;
	}
	    
	    var x = document.forms["myForm"]["psword"].value;
	    if (x==null || x=="") {
	        alert("Enter your password");
	        return false;
	    }
}
