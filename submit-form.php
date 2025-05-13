
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize form inputs
    $firstName = htmlspecialchars(trim($_POST['First_Name'] ?? ''));
    $lastName = htmlspecialchars(trim($_POST['Last_Name'] ?? ''));
    $email = htmlspecialchars(trim($_POST['Email'] ?? ''));
    $whatsapp = htmlspecialchars(trim($_POST['Whatsapp_Number'] ?? ''));
    $puppyName = htmlspecialchars(trim($_POST['Name_of_Puppy'] ?? ''));
    $paymentMethod = htmlspecialchars(trim($_POST['Payment_Method'] ?? ''));
    $address = htmlspecialchars(trim($_POST['Address'] ?? ''));
    $message = nl2br(htmlspecialchars(trim($_POST['Message'] ?? ''))); // Allow line breaks

    // Destination email
    $to = "brandonasah11@gmail.com";
    $subject = "🐶 New Puppy Application from $firstName $lastName";

    // HTML email body
    $body = "
    <html>
    <head>
      <style>
        body { font-family: Arial, sans-serif; background-color: #f9f9f9; padding: 20px; }
        .email-container { background-color: #ffffff; padding: 20px; border-radius: 8px; }
        h2 { color: #333; }
        .info { margin-bottom: 12px; }
        .label { font-weight: bold; color: #555; }
      </style>
    </head>
    <body>
      <div class='email-container'>
        <h2>New Puppy Application</h2>
        <div class='info'><span class='label'>Name:</span> $firstName $lastName</div>
        <div class='info'><span class='label'>Email:</span> $email</div>
        <div class='info'><span class='label'>WhatsApp Number:</span> $whatsapp</div>
        <div class='info'><span class='label'>Puppy's Name:</span> $puppyName</div>
        <div class='info'><span class='label'>Payment Method:</span> $paymentMethod</div>
        <div class='info'><span class='label'>Address:</span> $address</div>
        <div class='info'><span class='label'>Message:</span><br>$message</div>
      </div>
    </body>
    </html>
    ";

    // Email headers for HTML
    $headers  = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=UTF-8\r\n";
    $headers .= "From: no-reply@yourdomain.com\r\n";
    $headers .= "Reply-To: $email\r\n";

    // Send email and redirect
    if (mail($to, $subject, $body, $headers)) {
        header("Location: form.html");
        exit();
    } else {
        echo "❌ Email sending failed. Please try again.";
    }
} else {
    // Redirect if accessed without submitting the form
    header("Location: index.html");
    exit();
}
?>
