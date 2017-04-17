//alert("validaton working!");
function checkForm(){
  

var x = document.forms["myForm"]["uname"].value;
if (x==null || x=="") {
    alert("Name must be filled out");
    return false;
}

var x = document.forms["myForm"]["email"].value;
if (x==null || x=="") {
    alert("Email must be filled out");
    return false;
}

var x = document.forms["myForm"]["psword1"].value;
if (x==null || x=="") {
    alert("password must be filled out");
    return false;
}

var x = document.forms["myForm"]["psword2"].value;
if (x==null || x=="") {
    alert("Confirm your password");
    return false;
}

var x = document.forms["myForm"]["imgurl"].value;
if (x==null || x=="") {
    alert("upload your profile picture");
    return false;
}

var x=document.forms["myForm"]["terms"].checked;
if (x === false) {
    alert("You forgot to agree to the terms and Conditions");
    return false;
}



}


