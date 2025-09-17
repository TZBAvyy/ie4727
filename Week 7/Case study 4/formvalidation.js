const name = document.getElementById("name");
const email = document.getElementById("email");
const date = document.getElementById("date");
const experience = document.getElementById("experience");
const exp = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;


function chkEmail(){
    var checkEmail = email.value.toString();
    var emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    if(!exp.test(checkEmail)){
        alert('Your email is not correct');
        inputEmail.focus();
        inputEmail.select()
        return false;
    }
    else{
        return true;
    }
}