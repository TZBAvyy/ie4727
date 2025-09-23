document.addEventListener("DOMContentLoaded", function () {
  const form = document.getElementById("jobForm");

  // Cache DOM references once
  const nameInput = document.getElementById("name");
  const emailInput = document.getElementById("email");
  const startDateInput = document.getElementById("date");
  const expInput = document.getElementById("experience");

  form.addEventListener("submit", function (e) {
    let errors = [];

    // Get current values
    const name = nameInput.value.trim();
    const email = emailInput.value.trim();
    const startDateValue = startDateInput.value; // string
    const exp = expInput.value.trim();

    // --- Name check ---
    if (name === "") {
      errors.push("Name is required.");
    } 
    else {
      const nameRegex = /^[A-Za-z ]+$/;
      if (!nameRegex.test(name)) {
        errors.push("Name must contain only letters and spaces.");
      }
    }

    // --- Email check ---
    if (email === "") {
      errors.push("Email is required.");
    } 
    else {
      const emailRegex = /^[\w.-]+@([\w-]+\.)+[\w-]{2,3}$/;
      if (!emailRegex.test(email)) {
        errors.push("Enter a valid email address.");
      }
    }

    // --- Start date check ---
    if (startDateValue === "") {
      errors.push("Start date is required.");
    } 
    else {
      const startDate = new Date(startDateValue);
      const today = new Date();
      today.setHours(0, 0, 0, 0);
      if (isNaN(startDate.getTime()) || startDate <= today) {
        errors.push("Start date must be a future date.");
      }
    }

    // --- Experience check ---
    if (exp === "") {
      errors.push("Experience field cannot be empty.");
    }

    // --- Show errors ---
    if (errors.length > 0) {
      e.preventDefault();
      alert(errors.join("\n"));
    }
  });
});
