function checkForm(){
	var x = document.forms["myForm"]["title"].value;
	if (x==null || x=="") {
	    alert("Blog is untitled");
	    return false;
	}
	var x = document.forms["myForm"]["content"].value;
	if (x==null || x=="") {
	    alert("No content to post");
	    return false;
	}
	
	
var x = document.forms["myForm"]["imgurl"].value;
if (x==null || x=="") {
    alert("upload your profile picture");
    return false;
}


}

