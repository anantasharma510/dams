document.getElementById("registrationForm").addEventListener("submit", function(event) {
    let errors = {};
    let hasErrors = false;

    // Full Name validation
    const fullname = document.getElementById("fullname").value.trim();
    if (fullname === "") {
        errors.fullname = "Full name is required.";
        hasErrors = true;
    }

    // Address validation
    const address = document.getElementById("address").value.trim();
    if (address === "") {
        errors.address = "Address is required.";
        hasErrors = true;
    }

    // City validation
    const city = document.getElementById("city").value.trim();
    if (city === "") {
        errors.city = "City is required.";
        hasErrors = true;
    }

    // Gender validation
    const gender = document.getElementById("gender").value;
    if (gender === "") {
        errors.gender = "Gender is required.";
        hasErrors = true;
    }

    // Email validation
    const email = document.getElementById("email").value.trim();
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (email === "") {
        errors.email = "Email is required.";
        hasErrors = true;
    } else if (!emailPattern.test(email)) {
        errors.email = "Invalid email format.";
        hasErrors = true;
    }

    // Phone validation
    const phone = document.getElementById("phone").value.trim();
    const phonePattern = /^[0-9]{10}$/;
    if (phone === "") {
        errors.phone = "Phone number is required.";
        hasErrors = true;
    } else if (!phonePattern.test(phone)) {
        errors.phone = "Phone number must be 10 digits.";
        hasErrors = true;
    }

    // Password validation
    const password = document.getElementById("password").value.trim();
    if (password.length < 6) {
        errors.password = "Password must be at least 6 characters.";
        hasErrors = true;
    }

    // Confirm Password validation
    const confirm_password = document.getElementById("confirm_password").value.trim();
    if (password !== confirm_password) {
        errors.confirm_password = "Passwords do not match.";
        hasErrors = true;
    }

    // Display errors
    if (hasErrors) {
        event.preventDefault();
        Object.keys(errors).forEach(key => {
            document.getElementById(`${key}-error`).textContent = errors[key];
        });
    }
});


