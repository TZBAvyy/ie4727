const name_input = document.getElementById("name");
const email_input = document.getElementById("email");
const start_date_input = document.getElementById("date");
const exp_input = document.getElementById("experience");
const form = document.getElementById("form");

const name_exp = /^[A-Z][a-z]+ [A-Z][a-z]+/;
const email_exp = /^[\w.-]+@(\w+\.){1,3}\w{2,3}$/;

form.addEventListener("submit", (e) => {
    const name_val = name_input.value; 
})