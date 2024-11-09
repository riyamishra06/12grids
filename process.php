<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST['name'];
    $organization = $_POST['organization'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];
    
    // Validate data
    $errors = array();
    
    if (empty($name)) {
        $errors['name'] = "Name is required";
    }
    
    if (empty($email)) {
        $errors['email'] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format";
    }
    
    if (empty($phone)) {
        $errors['phone'] = "Phone number is required";
    }
    
    // If no errors, process the form
    if (empty($errors)) {
        // You can add your email sending logic here
        // For example, using mail() function or PHPMailer
        
        $to = "your-email@example.com";
        $subject = "New Contact Form Submission";
        $email_content = "Name: $name\n";
        $email_content .= "Organization: $organization\n";
        $email_content .= "Email: $email\n";
        $email_content .= "Phone: $phone\n";
        $email_content .= "Message: $message\n";
        
        // Send email
        mail($to, $subject, $email_content);
        
        // Return success response
        echo json_encode(array("success" => true));
    } else {
        // Return error response
        echo json_encode(array("success" => false, "errors" => $errors));
    }
}
?>