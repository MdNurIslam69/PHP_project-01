<?php
$title = "Contact us | Imran_Store";
require_once './components/header.php';


if (isset($_POST['send_message'])) {

    $name = sanitize($_POST['name']);
    $email = sanitize($_POST['email']);
    $phone = sanitize($_POST['phone']);
    $message = sanitize($_POST['message']);


    // name section
    if (empty($name)) {
        $errName = "please write your name";
    } elseif (!preg_match("/^[a-zA-Z-_.' ]*$/", $name)) {
        $errName = "Only letters and white space allowed";
    } else {
        $crrName = $name;
    }

    // email section
    if (empty($email)) {
        $errEmail = "please write your email";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errEmail = "Invalid Email";
    } else {
        $crrEmail = $email;
    }

    // phone section
    if (empty($phone)) {
        $errPhone = "please write your phone number";
    } elseif (!preg_match("/^[0-9]*$/", $phone)) {
        $errPhone = "Only numbers allowed";
    } else {
        $crrPhone = $phone;
    }

    // message section
    if (empty($message)) {
        $errMessage = "please write your message";
    } else {
        $crrMessage = $message;
    }



    if (isset($crrName) && isset($crrEmail) && isset($crrPhone) && isset($crrMessage)) {

        // this section only for, when i submit contact-us form, Then those data will send to my email directly
        //
        //
        //
        // email mdnurislam6995@gmail.com the destails
        //
        // $to = "mdnurislam6995@gmail.com";
        // $subject = "Contact-Us Form Submission from $crrName";
        // $body = "Name: $crrName\nEmail: $crrEmail\nPhone: $crrPhone\nMessage: $crrMessage";
        // $headers = "From: $crrEmail";
        // mail($to, $subject, $body, $headers);

        // show success message
        // echo "<script>toastr.success('Message Sent Successfully'); setTimeout(() => {
        //     window.location.href = './';}, 2000);</script>";



        // save data to contact_us table in database
        $sql = "INSERT INTO `contact-us_form` (`name`, `email`, `phone`, `message`) VALUES ('$crrName', '$crrEmail', '$crrPhone', '$crrMessage')";

        if (mysqli_query($conn, $sql)) {
            echo "<script>toastr.success('Message Sent Successfully!'); setTimeout(() => { window.location.href = './';}, 2000);</script>";
        } else {
            echo "<script>toastr.error('Failed to Send Message!');</script>";
        }
    }
}


?>



<!-- Contact 6 - Bootstrap Brain Component -->
<section class="py-3 mb-5 mt-1">
    <div class="container">
        <h2 class="display-5 mt-4 text-center fw-bold text-decoration-underline forSame-color">Contact us</h2>

        <hr class="w-50 mx-auto border-dark-subtle mb-5">


    </div>

    <div class="container row mx-auto">



        <div class="row col-md-7 border border-2 border-dark-subtle shadow m-0 p-0 getInTouchBorder1">


            <div class="col-lg-5 col-md-6 bg-dark pt-2 getInTouchBorder2 align-content-center">

                <h3 class="h3 mb-3 text-light text-center text-decoration-underline">Get in
                    Touch</h3>


                <div class="mb-3">
                    <h5 class="mb-1 text-light">Address:</h5>
                    <address class="mb-0 text-light opacity-75"><i class="fa-solid fa-location-dot"></i>
                        1212 Dhaka, Banani
                        City, Bangladesh</address>
                </div>


                <div class="mb-3">
                    <h5 class="mb-1 text-light">Phone:</h5>
                    <address class="mb-0 text-light opacity-75"><i class="fa-solid fa-phone"></i> +88
                        (018) 28426031</address>
                </div>


                <div class="mb-3">
                    <h5 class="mb-1 text-light">Email:</h5>
                    <address class="mb-0 text-light opacity-75"><i class="fa-solid fa-envelope"></i>
                        info.mdnurislam5@gmail.com
                    </address>
                </div>


                <div class="mb-3">
                    <h5 class="mb-1 text-light">Working Hours:</h5>
                    <address class="mb-0 text-light opacity-75"><i class="fa-solid fa-laptop-code"></i>
                        Sat - Fri: 9:00 AM -
                        6:00 PM <span class="BSTlocal">(BST) Local</span></address>
                </div>



            </div>


            <!-- form section -->
            <div class="col-lg-7 col-md-6 align-content-center getInTouchBorder3" style="background-color: #d9ebea;">


                <form action="" method="post">
                    <div class="row  p-3">

                        <!-- name section -->
                        <div class="col-12 mb-3">
                            <label for="text" class="form-label">Your Full Name <span
                                    class="text-danger">*</span></label>

                            <input type="text" class="form-control <?= isset($errName) ? 'is-invalid' : null ?>"
                                name="name" placeholder="e.g. John Doe" value="<?= $name ?? null ?>">

                            <div class="invalid-feedback">
                                <?= $errName ?? null ?>
                            </div>
                        </div>

                        <!-- email section -->
                        <div class="col-lg-6 col-md-12 mb-sm-2">
                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span
                                    class="input-group-text <?= !isset($errEmail) ? 'is-invalid' : 'border-danger' ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-envelope" viewBox="0 0 16 16">
                                        <path
                                            d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z" />
                                    </svg>
                                </span>
                                <input type="email"
                                    class="form-control rounded-end <?= isset($errEmail) ? 'is-invalid' : null ?>"
                                    name="email" placeholder="example@gmail" value="<?= $email ?? null ?>">
                                <div class="invalid-feedback">
                                    <?= $errEmail ?? null ?>
                                </div>
                            </div>

                        </div>

                        <!-- phone section -->
                        <div class="col-lg-6 col-md-12">
                            <label for="phone" class="form-label">Phone <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span
                                    class="input-group-text <?= !isset($errPhone) ? 'is-invalid' : 'border-danger' ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-telephone" viewBox="0 0 16 16">
                                        <path
                                            d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z" />
                                    </svg>
                                </span>
                                <input type="tel"
                                    class="form-control rounded-end <?= isset($errPhone) ? 'is-invalid' : null ?>"
                                    name="phone" placeholder="01XXXXXXXXX" value="<?= $phone ?? null ?>">
                                <div class="invalid-feedback">
                                    <?= $errPhone ?? null ?>
                                </div>
                            </div>
                        </div>

                        <!-- message section -->
                        <div class="col-12 my-2">
                            <label for="message" class="form-label">Message <span class="text-danger">*</span></label>
                            <textarea class="form-control <?= isset($errMessage) ? 'is-invalid' : null ?>"
                                placeholder="Write Your Message..." name="message"
                                rows="2"><?= $message ?? null ?></textarea>

                            <div class="invalid-feedback">
                                <?= $errMessage ?? null ?>
                            </div>
                        </div>

                        <!-- button section -->
                        <div class="mb-2 mt-4">
                            <button type="submit" name="send_message" class="btn btn-primary">Send
                                Message</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>


        <!-- this internal css is for responsive contact us-> Get In Touch section -->
        <style>
            @media screen and (max-width: 1750px) {
                .getInTouch {
                    padding-left: 40px !important;
                }

                .getInTouchBorder1 {
                    border-radius: 12px !important;
                }

                .getInTouchBorder2 {
                    border-top-left-radius: 10px !important;
                    border-bottom-left-radius: 10px !important;

                }

                .getInTouchBorder3 {
                    border-top-right-radius: 10px !important;
                    border-bottom-right-radius: 10px !important;

                }

                .BSTlocal {
                    display: block;
                }
            }

            @media screen and (max-width: 992px) {
                .getInTouch {
                    padding-left: 30px !important;
                }

                .getInTouchBorder1 {
                    border-radius: 12px !important;
                }

                .getInTouchBorder2 {
                    border-top-right-radius: 0px !important;
                    border-bottom-left-radius: 10px !important;

                }

                .getInTouchBorder3 {
                    border-bottom-left-radius: 0px !important;
                    border-bottom-right-radius: 10px !important;
                    border-top-right-radius: 10px !important;

                }
            }

            @media screen and (max-width: 767px) {

                .getInTouchBorder2 {
                    border-top-right-radius: 10px !important;
                    border-bottom-left-radius: 0px !important;

                }

                .getInTouchBorder3 {
                    border-bottom-left-radius: 10px !important;
                    border-bottom-right-radius: 10px !important;
                    border-top-right-radius: 0px !important;

                }

                .getInTouch {
                    padding-left: 0px !important;
                    margin-top: 50px !important;
                }


            }

            @media screen and (max-width: 1200px) {
                .BSTlocal {
                    display: inline-block;
                }
            }
        </style>

        <div class="row col-md-5 m-0 p-0 align-content-center getInTouch">
            <!-- google map iframe in dhaka -->

            <h2 class="h3 mb-3 text-dark fw-bold text-center text-decoration-underline forSame-color">Our Location</h2>
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d233668.06396625793!2d90.25487806434207!3d23.780753032189303!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b8b087026b81%3A0x8fa563bbdd5904c2!2sDhaka!5e0!3m2!1sen!2sbd!4v1750934735485!5m2!1sen!2sbd"
                width="100%" height="300" style="border: 1px solid #6d5ce8; margin-bottom: 10px !important;"
                allowfullscreen="" loading="lazy" class="m-0 p-0 rounded"
                referrerpolicy="no-referrer-when-downgrade"></iframe>

        </div>

    </div>
</section>








<?php
require_once './components/footer.php';
?>