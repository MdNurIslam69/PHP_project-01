<?php
ob_start();
require_once './components/header.php';

$genderList = ['Male', 'Female', 'Others'];

$allCountryList = ["Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegovina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia", "Cuba", "Cyprus", "Czechia", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Eswatini", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Federated States of Micronesia", "Fiji", "Finland", "France", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard Island and McDonald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libya", "Liechtenstein", "Lithuania", "Luxembourg", "Macao", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Moldova", "Monaco", "Mongolia", "Montenegro", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "North Macedonia", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Palestine, State of", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Barthelemy", "Saint Helena", "Saint Kitts and Nevis", "Saint Lucia", "Saint Martin", "Saint Pierre and Miquelon", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Serbia", "Seychelles", "Sierra Leone", "Singapore", "Sint Maarten", "Slovakia", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "South Sudan", "Spain", "Sri Lanka", "Sudan", "Suriname", "Svalbard and Jan Mayen", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Timor-Leste", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Türkiye", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States", "Uzbekistan", "Vanuatu", "Venezuela", "Viet Nam", "Virgin Islands, British", "Virgin Islands, U.S.", "Wallis and Futuna", "Western Sahara", "Yemen", "Zambia", "Zimbabwe"];





if (!isset($_SESSION['link3Tech'])) {
    header('location: sign-in.php');
    exit();
}

// pg_fetch_object 
$userId = $_SESSION['link3Tech']['id'];
$userInfo = $conn->query("SELECT * FROM `users` WHERE `id` = '$userId'")->fetch_assoc();



if (isset($_POST['updateProfile'])) {
    $name = sanitize($_POST['name']);
    $email = sanitize($_POST['email']);
    $gender = isset($_POST['gender']) ? sanitize($_POST['gender']) : null;
    $countryName = isset($_POST['country']) ? sanitize($_POST['country']) : null;
    $address = $_POST['address'];

    // name section
    if (empty($name)) {
        $errName = "Name is required";
    } elseif (!preg_match("/^[a-zA-Z-_.' ]*$/", $name)) {
        $errName = "Only letters and white space allowed";
    } else {
        $crrName = $conn->real_escape_string($name);
    }


    // email section
    if (empty($email)) {
        $errEmail = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errEmail = "Invalid Email";
    } else {
        $crrEmail = $conn->real_escape_string($email);
    }


    // gender section 
    if (empty($gender)) {
        $errGender = "Select your gender";
    } elseif (!in_array($gender, $genderList)) {
        $errGender = "Invalid Gender";
    } else {
        $crrGender = $conn->real_escape_string($gender);
    }


    // <!-- Country section  -->
    if (empty($countryName)) {
        $errCountry = "Select your country";
    } elseif (!in_array($countryName, $allCountryList)) {
        $errCountry = "Invalid your Countries";
    } else {
        $crrCountry = $conn->real_escape_string($countryName);
    }


    // <!-- Address section -->
    if (preg_match("/<p><br><\/p>/", $address)) {
        $errAddress = "Address is required";
    } else {
        $address = sanitize($address);
        $crrAddress = $conn->real_escape_string($address);
    }



    if (isset($crrName) && isset($crrEmail) && isset($crrGender) && isset($crrCountry) && isset($crrAddress)) {
        $sql = "UPDATE `users` SET `name` = '$crrName', `email` = '$crrEmail', `gender` = '$crrGender', `address` = '$crrAddress', `country` = '$crrCountry' WHERE id = '$userId'";

        if ($conn->query($sql)) {
            $_SESSION['link3Tech'] = $conn->query("SELECT * FROM `users` WHERE `id` = $userId")->fetch_assoc();
            echo "<script>toastr.success('User Update Successfully');
        //  setTimeout(() => {
        //      window.location.href = 'index.php';
        //  }, 3000);
         </script>
         ";
        } else {
            echo "<script>toastr.error('User Update Failed');
            // setTimeout(() => {
            //     window.location.href = 'sign-in.php';
            // }, 3000);
            </script>
            ";
        }
    }
}
?>




<div class="container">

    <div class="row mt-1">
        <div class="col-md-5 mx-auto my-5 border border-2 border-primary-subtle rounded shadow p-4 bg-light">
            <h1 class="mb-4 text-center">My Profile</h1>

            <form action="" method="post">

                <!-- Name section -->
                <div class="mb-3">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" class="form-control <?= isset($errName) ? 'is-invalid' : null ?>" Name="name"
                        value="<?= $userInfo['name'] ?? null ?>">

                    <div class="invalid-feedback">
                        <?= isset($errName) ? $errName : null ?>
                    </div>
                </div>


                <!-- Email section -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control <?= isset($errEmail) ? 'is-invalid' : null ?>" Name="email"
                        value="<?= $userInfo['email'] ?? null ?>">

                    <div class="invalid-feedback">
                        <?= isset($errEmail) ? $errEmail : null ?>
                    </div>
                </div>


                <!-- Gender section -->
                <div class="mb-3">
                    <label for="gender" class="form-label">Gender:</label>

                    <select class="form-select <?= isset($errGender) ? 'is-invalid' : null ?>" name="gender">

                        <option value="">Select Gender</option>

                        <option value="Male" <?= $userInfo['gender'] == 'Male' ? 'selected' : null ?>>Male</option>
                        <option value="Female" <?= $userInfo['gender'] == 'Female' ? 'selected' : null ?>>Female
                        </option>
                        <option value="Others" <?= $userInfo['gender'] == 'Others' ? 'selected' : null ?>>Others
                        </option>
                    </select>

                    <div class="invalid-feedback">
                        <?= isset($errGender) ? $errGender : null ?>
                    </div>
                </div>


                <!-- country section  -->
                <div class="mb-3">

                    <label for="country" class="form-label">Country:</label>
                    <select class="form-select <?= isset($errCountry) ? 'is-invalid' : null; ?>" name="country">
                        <option value="">Select Country</option>

                        <?php foreach ($allCountryList as $countries) { ?>
                            <option value="<?= $countries ?>"
                                <?= isset($userInfo['country']) && $userInfo['country'] == $countries ? "selected" : null ?>>
                                <?= $countries ?></option>
                        <?php } ?>
                    </select>

                    <div class="invalid-feedback">
                        <?= isset($errCountry) ? $errCountry : null; ?>
                    </div>
                </div>


                <!-- Address section -->
                <div class="mb-3">
                    <label for="address" class="form-label">Address:</label>

                    <textarea class="form-control <?= isset($errAddress) ? 'is-invalid' : null; ?>" name="address"
                        rows="3" style="display: none;" id="hiddenAddress">
                    <?= htmlspecialchars_decode($address ?? $userInfo['address'] ?? null); ?>
                    </textarea>

                    <div id="editor" class="<?= isset($errAddress) ? "border border-danger" : null; ?>">
                        <?= htmlspecialchars_decode($address ?? $userInfo['address'] ?? null); ?></div>


                    <div class="invalid-feedback">
                        <?= isset($errAddress) ? $errAddress : null; ?>
                    </div>

                </div>





                <!-- Submit section -->
                <button type="submit" class="btn btn-primary" name="updateProfile">Update Profile</button>

            </form>
        </div>
    </div>
</div>


<!-- quill editor -->
<script>
    const quill = new Quill('#editor', {
        theme: 'snow',

    });
    $('#editor').on('keyup', function() {
        const html = quill.root.innerHTML;
        $('#hiddenAddress').val(html);
    });
</script>


<?php
require_once './components/footer.php';
?>