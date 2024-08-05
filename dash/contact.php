<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Page</title>
    <link rel="stylesheet" href="contact.css">
</head>
<body>
     <!-- Navbar -->
     <?php include "./nav.php" ?>

<div class="contact-container">
        <div class="contact-description">
            <h1 class="contact">Contact Us</h1>
            <p>If you have any questions or need support, please reach out to us using the form on the right. We are here to help you with any inquiries or issues you may have.</p>
            <p><strong>Email:</strong> support@example.com</p>
            <p><strong>Phone:</strong> +91-234-567-890</p>
        </div>
        <div class="contact-form">
            <h2>Send us a Message</h2>
            <form id="contactForm" method="post" action="send_message.php">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>

                <label for="message">Message:</label>
                <textarea id="message" name="message" required></textarea>

                <button type="submit">Send Message</button>
            </form>
        </div>
    </div>


    <!-- footer  -->
<?php include "./footer.php" ?>

</body>
</html>