<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
</head>
<body>
    <h2>Registration</h2>
    <form id="registrationForm" method="post" action="#">
        <label>First Name:</label><input type="text" name="first_name" required><br><br>
        <label>Last Name:</label><input type="text" name="last_name" required><br><br>
        <label>Phone Number:</label><input type="text" name="phone_number" required><br><br>
        <label>Email:</label><input type="email" name="email" required><br><br>
        <label>Password:</label><input type="password" name="password" required><br><br>
        <input type="submit" value="Register">
    </form>
    <div id="registrationMessage"></div>

    <script>
        // JavaScript code to handle form submission using AJAX
        document.getElementById("registrationForm").addEventListener("submit", function(event) {
            event.preventDefault(); // Prevent the default form submission behavior

            // Get form data
            var formData = new FormData(this);

            // Send AJAX request to the registration controller
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "../controllers/RegistrationController.php", true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    // Handle the response from the server
                    document.getElementById("registrationMessage").innerHTML = xhr.responseText;
                    // Redirect to login form if registration is successful
                    if (xhr.responseText.includes("successful")) {
                        setTimeout(function() {
                            window.location.href = "../views/login_form.php";
                        }, 2000); // Redirect after 2 seconds
                    }
                } else {
                    // Handle errors
                    document.getElementById("registrationMessage").innerHTML = "An error occurred.";
                }
            };
            xhr.send(formData);
        });
    </script>
</body>
</html>