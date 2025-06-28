<?php
session_start();
$pageName = basename($_SERVER['PHP_SELF']);


function sanitize($data)
{
    if (is_array($data)) {
        return array_map('sanitize', $data); // Recursively sanitize array elements
    }
    return htmlspecialchars(stripslashes($data));
}

$conn = mysqli_connect('127.0.0.1', 'root', '', 'imran_store');

?>



<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?? basename($_SERVER['PHP_SELF']); ?></title>

    <!-- favicon link -->
    <link rel="shortcut icon" href="./admin-panel/images/favicon.png" type="image/x-icon">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">

    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />



    <!-- bootstrap css link   -->
    <link rel="stylesheet" href="assets/css/bootstrap.css">


    <!-- css link  -->
    <link rel="stylesheet" href="./assets/css/style.css">


    <!-- toastr css link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">



    <!-- jquery js link -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- toastr js link -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


    <!-- toastr customaization start  -->
    <script>
    toastr.options = {
        "progressBar": true,
        "positionClass": "toast-top-center",
        "timeOut": "2000",
        "showMethod": "slideDown",

        // custom css
        "toastClass": "toastr",
    }
    </script>
    <!-- toastr customaization end  -->


    <!-- quill editor css link  -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>



    <!-- data table css link (for front-end)-->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.0/css/dataTables.dataTables.min.css">

    <script src="https://cdn.datatables.net/2.3.0/js/dataTables.min.js"> </script>


</head>

<body>

    <?php
    require_once './components/navbar.php';
    ?>