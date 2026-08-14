<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

// ==========================================
// CHECK IF PATIENT IS LOGGED IN
// ==========================================

if (!isset($_SESSION["PatientID"])) {
    header("Location: index.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Patient Home</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link rel="stylesheet" href="style.css">

</head>

<body>

<div class="container">

    <div class="welcome-box text-center">

        <h1>
            Successfully Logged In!
        </h1>

        <h3>
            Welcome,

            <?php
            echo htmlspecialchars($_SESSION["LastName"] ?? "");
            ?>

            <?php
            echo htmlspecialchars($_SESSION["FirstName"] ?? "");
            ?>
        </h3>

        <p>
            Username:
            <strong>
                <?php
                echo htmlspecialchars($_SESSION["UserName"] ?? "");
                ?>
            </strong>
        </p>

        <p>
            Patient ID:
            <strong>
                <?php
                echo htmlspecialchars($_SESSION["PatientID"] ?? "");
                ?>
            </strong>
        </p>

        <p>
            Doctor ID:
            <strong>
                <?php
                echo htmlspecialchars($_SESSION["DoctorID"] ?? "");
                ?>
            </strong>
        </p>

        <p>
            You have successfully logged in
            as a patient.
        </p>

        <!-- LOGOUT BUTTON -->
        <a href="logout.php" class="btn btn-danger mt-3">
            Logout
        </a>

    </div>

</div>

</body>

</html>