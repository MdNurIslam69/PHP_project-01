<?php
require_once './components/header.php';
?>


<style>
    * body {
        background-color: azure;
    }

    .containers {
        max-width: 900px;
        background-color: skyblue;
        margin: 40px auto;
        padding: 10px 0;
        border-radius: 20px;

    }

    h1 {
        text-align: center;
        margin-bottom: 2rem;
        text-decoration: underline;
    }

    .contact-wrapper {
        display: flex;
        flex-wrap: wrap;
        gap: 3rem;
        padding: 20px;
        align-items: center;
    }

    .contact-info,
    .contact-form {
        flex: 1 1 300px;
    }

    .contact-info {
        max-width: 400px;
        margin-top: -50px;
        border: 2px dotted lightgoldenrodyellow;
        padding: 20px;
        border-radius: 10px;
    }

    .contact-form {
        max-width: 400px;

    }

    .contact-info h2 {
        margin-bottom: 1rem;
    }

    .contact-info p {
        margin-bottom: 0.5rem;
    }

    form label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: bold;
    }

    form input,
    form textarea {
        width: 100%;
        padding: 0.75rem;
        margin-bottom: 1rem;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 1rem;
    }

    form button {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 0.75rem 1.5rem;
        font-size: 1rem;
        border-radius: 4px;
        cursor: pointer;
    }

    form button:hover {
        background-color: #0056b3;
    }

    @media (max-width: 768px) {
        .contact-wrapper {
            flex-direction: column;
        }

        h1 {
            margin: 50px 0;
        }

        .contact-info {
            margin-top: 5px;
            max-height: 250px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
</style>



<div class="containers">
    <h1>Contact Us</h1>
    <div class="contact-wrapper">
        <div class="contact-info">
            <h2>Get in Touch</h2>
            <p><strong>Address:</strong> 123 Web Street, Dev City, JS 45678</p>
            <p><strong>Phone:</strong> +1 (234) 567-8901</p>
            <p><strong>Email:</strong> info@example.com</p>
            <p><strong>Working Hours:</strong> Mon - Fri: 9:00 AM - 6:00 PM</p>
        </div>
        <div class="contact-form">
            <form action="#" method="post">
                <label for="name">Your Name</label>
                <input type="text" id="name" name="name" required />

                <label for="email">Your Email</label>
                <input type="email" id="email" name="email" required />

                <label for="message">Your Message</label>
                <textarea id="message" name="message" rows="6" required></textarea>

                <button type="submit">Send Message</button>
            </form>
        </div>
    </div>
</div>






<?php
require_once './components/footer.php';
?>