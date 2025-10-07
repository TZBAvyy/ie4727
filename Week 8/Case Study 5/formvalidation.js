const name_input = document.getElementById("name");
const email_input = document.getElementById("email");
const start_date_input = document.getElementById("date");
const exp_input = document.getElementById("experience");
const form = document.getElementById("form");

const name_exp = /^[A-Z][a-z]+ [A-Z][a-z]+/;
const email_exp = /^[\w.-]+@(\w+\.){1,3}\w{2,3}$/;

form.addEventListener("submit", (e) => {
    const name_val = name_input.value; 
    const email_val = email_input.value;
    const start_date_val = start_date_input.value ?? ""; 
    const exp_val = exp_input.value ?? "";

    if (exp_val == "") {
        alert("Please do not leave your experience blank");
        e.preventDefault();
        return;
    }

    const regexValid = name_exp.test(name_val) && email_exp.test(email_val);

    if (!regexValid) {
        alert("Please enter a valid name and/or email");
        e.preventDefault();
        return;
    }

    if (date != "") {
        let currentDate = new Date();
        let inputDate = new Date(date);
        currentDate.setHours(0,0,0,0);
        inputDate.setHours(0,0,0,0);

        if (inputDate <= currentDate) {
            alert("Please enter a start date in the future");
            e.preventDefault();
            return;
        }  
    }
})

