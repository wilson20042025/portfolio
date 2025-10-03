<?php include('includes/header.php'); ?>

<link rel="stylesheet" href="css/contact.css">

<main class="contact-page">
    <section class="contact-header">
        <h1>Contact Me</h1>
        <p>Have a project in mind or just want to say hello? I'd love to hear from you.</p>
    </section>

    <section class="contact-form-section">
        <form action="submit_contact.php" method="POST" class="contact-form">
            <div class="form-group">
                <label for="name">Name*</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="email">Email*</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="subject">Subject*</label>
                <input type="text" id="subject" name="subject" required>
            </div>

            <div class="form-group">
                <label for="message">Message*</label>
                <textarea id="message" name="message" rows="5" required></textarea>
            </div>

            <button type="submit" class="btn-send">Send Message</button>
        </form>
    </section>
</main>

<?php include('includes/footer.php'); ?>
