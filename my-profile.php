<?php
ob_start();
require_once './components/header.php';
$countries = ["Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegovina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia", "Cuba", "Cyprus", "Czechia", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Eswatini", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Federated States of Micronesia", "Fiji", "Finland", "France", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard Island and McDonald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libya", "Liechtenstein", "Lithuania", "Luxembourg", "Macao", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Moldova", "Monaco", "Mongolia", "Montenegro", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "North Macedonia", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Palestine, State of", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Barthelemy", "Saint Helena", "Saint Kitts and Nevis", "Saint Lucia", "Saint Martin", "Saint Pierre and Miquelon", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Serbia", "Seychelles", "Sierra Leone", "Singapore", "Sint Maarten", "Slovakia", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "South Sudan", "Spain", "Sri Lanka", "Sudan", "Suriname", "Svalbard and Jan Mayen", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Timor-Leste", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Türkiye", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States", "Uzbekistan", "Vanuatu", "Venezuela", "Viet Nam", "Virgin Islands, British", "Virgin Islands, U.S.", "Wallis and Futuna", "Western Sahara", "Yemen", "Zambia", "Zimbabwe"];

$genderList = ['Male', 'Female', 'Others'];



if (!isset($_SESSION['link3Tech'])) {
    header('location: sign-in.php');
    exit();
}


$userId = $_SESSION['link3Tech']['id'];
$userInfo = $conn->query("SELECT * FROM users WHERE id = '$userId'")->fetch_assoc();




if (isset($_POST['updateBTN'])) {

    $name = sanitize($_POST['name']);
    $email = sanitize($_POST['email']);
    $gender = isset($_POST['gender']) ? sanitize($_POST['gender']) : null;
    $address = sanitize($_POST['address']);
    $countryName = isset($_POST['country']) ? sanitize($_POST['country']) : null;

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
        $errGender = "invalid gender";
    } else {
        $crrGender = $conn->real_escape_string($gender);
    }


    // <!-- Country section  -->
    if (empty($countryName)) {
        $countryErr = "Select your country";
    } elseif (!in_array($countryName, $countries)) {
        $countryErr = "Invalid your Countries";
    } else {
        $countryCorrect = $conn->real_escape_string($countryName);
    }


    // address section 
    if (empty($address)) {
        $errAddress = "Address is required";
    } else {
        $crrAddress = $conn->real_escape_string($address);
    }




    // check if all fields are set
    if (!isset($errName) && !isset($errEmail) && !isset($errGender) && !isset($countryErr) && !isset($errAddress)) {
        $updateQuery = "UPDATE users SET name = '$crrName', email = '$crrEmail', gender = '$crrGender', address = '$crrAddress', country = '$countryCorrect' WHERE id = '$userId'";
        $updateResult = $conn->query($updateQuery);
        if ($updateResult) {
            header('location: my-profile.php');
            exit();
        }
    }
}

?>




<div class="container mt-5 ">

    <div class="row">
        <div class="col-md-6 mx-auto my-5 border rounded shadow p-4">
            <h1>My Profile</h1>

            <form action="" method="post">

                <!-- Name section  -->
                <div class="mb-3">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" class="form-control <?= isset($errName) ? 'is-invalid' : null; ?>" name="name"
                        value="<?= isset($userInfo['name']) ? $userInfo['name'] : null; ?>">
                    <div class="invalid-feedback">
                        <?= isset($errName) ? $errName : null ?>
                    </div>
                </div>

                <!-- Email section  -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control <?= isset($errEmail) ? 'is-invalid' : null; ?>" name="email"
                        value="<?= isset($userInfo['email']) ? $userInfo['email'] : null; ?>">
                    <div class="invalid-feedback">
                        <?= isset($errEmail) ? $errEmail : null ?>
                    </div>
                </div>

                <!-- gender section  -->
                <div class="mb-3">
                    <label for="gender" class="form-label">Gender:</label>
                    <select class="form-select <?= isset($errGender) ? 'is-invalid' : null; ?>" name="gender">
                        <option value="">Select Gender</option>
                        <?php foreach ($genderList as $allGenderName) { ?>
                            <option value="<?= $allGenderName ?>"
                                <?= isset($userInfo['gender']) && $userInfo['gender'] == $allGenderName ? "selected" : null ?>>
                                <?= $allGenderName ?></option>
                        <?php } ?>
                    </select value="<?= isset($userInfo['gender']) ? $userInfo['gender'] : null; ?>">
                    <div class="invalid-feedback">
                        <?= isset($errGender) ? $errGender : null; ?>
                    </div>
                </div>


                <!-- country section  -->
                <div class="mb-3">

                    <label for="country" class="form-label">Country:</label>
                    <select class="form-select <?= isset($countryErr) ? 'is-invalid' : null; ?>" name="country">
                        <option value="">Select Country</option>
                        <?php foreach ($countries as $allCountryName) { ?>
                            <option value="<?= $allCountryName ?>"
                                <?= isset($userInfo['country']) && $userInfo['country'] == $allCountryName ? "selected" : null ?>>
                                <?= $allCountryName ?></option>
                        <?php } ?>
                    </select value="<?= isset($userInfo['country']) ? $userInfo['country'] : null; ?>">
                    <div class="invalid-feedback">
                        <?= isset($countryErr) ? $countryErr : null; ?>
                    </div>
                </div>


                <!-- address section -->
                <div class="mb-3">
                    <label for="address" class="form-label">Address:</label>
                    <textarea class="form-control <?= isset($errAddress) ? 'is-invalid' : null; ?>" name="address"
                        value="<?= isset($userInfo['address']) ? $userInfo['address'] : null; ?>"><?= isset($userInfo['address']) ? $userInfo['address'] : null; ?></textarea>
                    <div class="invalid-feedback">
                        <?= isset($errAddress) ? $errAddress : null; ?>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary" name="updateBTN">Update</button>

            </form>

        </div>





    </div>


</div>




<?php
require_once './components/footer.php';
?>