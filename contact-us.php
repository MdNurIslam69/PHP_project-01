<?php
$title = "Contact Us | Imran_Store";
require_once './components/header.php';
?>


<style>
* body {
    background-color: aliceblue;
}

.containers {
    max-width: 900px;
    background-color: #d9ebea;
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
    border: 2px dotted #6d5ce8;
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
}
</style>



<div class="containers">
    <h1>Contact Us</h1>
    <div class="contact-wrapper">
        <div class="contact-info">
            <h2>Get in Touch</h2>
            <p><strong>Address:</strong> 1212 Dhaka, Banani City, Bangladesh</p>
            <p><strong>Phone:</strong> +88 (018) 28426031</p>
            <p><strong>Email:</strong> info.mdnurislam5@gmail.com</p>
            <p><strong>Working Hours:</strong> Sat - Fri: 9:00 AM - 6:00 PM (BST) Local</p>
        </div>
        <div class="contact-form">
            <form action="#" method="post">
                <label for="name">Your Name</label>
                <input type="text" id="name" name="name" required />

                <label for="email">Your Email</label>
                <input type="email" id="email" name="email" required />

                <label for="message">Your Message</label>
                <textarea id="message" name="message" rows="3" required></textarea>

                <button type="submit" class="viewDetailsBtnsSingle1">Send Message</button>
            </form>
        </div>
    </div>
</div>






<?php
require_once './components/footer.php';
?>