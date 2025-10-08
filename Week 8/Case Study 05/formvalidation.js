document.addEventListener("DOMContentLoaded", function () {
  const form = document.getElementById("jobForm");
  const nameInput = document.getElementById("name");
  const emailInput = document.getElementById("email");
  const startDateInput = document.getElementById("date");
  const expInput = document.getElementById("experience");

  form.addEventListener("submit", function (e) {
    let errors = [];

    const name = nameInput.value.trim();
    const email = emailInput.value.trim();
    const startDateValue = startDateInput.value;
    const exp = expInput.value.trim();

    if (name === "") {
      errors.push("Name is required.");
    } 
    else {
      const nameRegex = /^[A-Z a-z]+$/;
      if (!nameRegex.test(name)) {
        errors.push("Name must contain only letters and spaces.");
      }
    }

    if (email === "") {
      errors.push("Email is required.");
    } 
    else {
      const emailRegex = /^[\w.-]+@(\w+\.){1,3}\w{2,3}$/;
      if (!emailRegex.test(email)) {
        errors.push("Enter a valid email address.");
      }
    }

    const startDate = new Date(startDateValue);
    const today = new Date();
    today.setHours(0, 0, 0, 0);
    startDate.setHours(0, 0, 0, 0);
    if (startDateValue != "") {
      if (startDate <= today) {
          errors.push("Start date must be a future date.");
      }
    }

    if (exp === "") {
      errors.push("Experience field cannot be empty.");
    }

    if (errors.length > 0) {
      e.preventDefault();
      alert(errors.join("\n"));
    }
  });
});
