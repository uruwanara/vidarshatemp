<!DOCTYPE html>
<html>
<head>
    <title>Simple PHP Site</title>
</head>
<body>

<?php
// Define variables to store user input
$name = $email = $message = "";

// Define variables to store error messages
$name_error = $email_error = $message_error = "";

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate name
    if (empty($_POST["name"])) {
        $name_error = "Name is required";
    } else {
        $name = test_input($_POST["name"]);
        // Check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
            $name_error = "Only letters and white space allowed";
        }
    }
    
    // Validate email
    if (empty($_POST["email"])) {
        $email_error = "Email is required";
    } else {
        $email = test_input($_POST["email"]);
        // Check if email address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email_error = "Invalid email format";
        }
    }
    
    // Validate message
    if (empty($_POST["message"])) {
        $message_error = "Message is required";
    } else {
        $message = test_input($_POST["message"]);
    }
}

// Function to sanitize input data
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<h2>Contact Form</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" value="<?php echo $name; ?>">
    <span class="error"><?php echo $name_error; ?></span>
    <br><br>
    
    <label for="email">Email:</label>
    <input type="text" id="email" name="email" value="<?php echo $email; ?>">
    <span class="error"><?php echo $email_error; ?></span>
    <br><br>
    
    <label for="message">Message:</label>
    <textarea id="message" name="message"><?php echo $message; ?></textarea>
    <span class="error"><?php echo $message_error; ?></span>
    <br><br>
    
    <input type="submit" name="submit" value="Submit">
</form>

<?php
// Display submitted data
if ($_SERVER["REQUEST_METHOD"] == "POST" && empty($name_error) && empty($email_error) && empty($message_error)) {
    echo "<h2>Submitted Information:</h2>";
    echo "Name: " . $name . "<br>";
    echo "Email: " . $email . "<br>";
    echo "Message: " . $message . "<br>";
}
?>

</body>
</html>
