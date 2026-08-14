<?php

session_start();


// ==================================================
// ERROR REPORTING
// ==================================================

error_reporting(E_ALL);
ini_set("display_errors", 1);


// ==================================================
// DATABASE CONNECTION - LARAGON
// ==================================================

$host = "127.0.0.1";
$port = 3306;

$dbUser = "root";
$dbPassword = "";
$database = "arcalinbsis3c";


// Create connection

$conn = new mysqli(
    $host,
    $dbUser,
    $dbPassword,
    $database,
    $port
);


// Check connection

if ($conn->connect_error) {

    die(
        "Database Connection Failed!<br><br>" .
        "Error: " . $conn->connect_error
    );

}


// Set UTF-8

$conn->set_charset("utf8mb4");


// ==================================================
// ONLY ALLOW POST REQUEST
// ==================================================

if ($_SERVER["REQUEST_METHOD"] !== "POST") {

    header("Location: index.php");
    exit();

}


// ==================================================
// GET USERNAME AND PASSWORD
// ==================================================

$username = trim(
    $_POST["username"] ?? ""
);

$loginPassword = trim(
    $_POST["password"] ?? ""
);


// ==================================================
// CHECK EMPTY INPUT
// ==================================================

if ($username === "" || $loginPassword === "") {

    echo "<script>
            alert('Please enter your username and password.');
            window.location.href = 'index.php';
          </script>";

    exit();

}


// ==================================================
// FIND PATIENT
// ==================================================

$sql = "SELECT
        PatientID,
        LastName,
        FirstName,
        DoctorID,
        UserName,
        Password
    FROM patient
    WHERE UserName = ?
    LIMIT 1";


$stmt = $conn->prepare($sql);


// Check SQL

if (!$stmt) {

    die(
        "SQL Prepare Error: " .
        $conn->error
    );

}


// BIND USERNAME PARAM



$stmt->bind_param("s", $username);


// EXECUTE


if (!$stmt->execute()) {

    die(
        "SQL Execute Error: " .
        $stmt->error
    );

}


// GET RESULT

$result = $stmt->get_result();


// CHECK IF PATIENT EXISTS

if ($result->num_rows === 1) {

    $patient = $result->fetch_assoc();


    // ==================================================
    // CHECK PASSWORD
    // ==================================================

 

    if ($loginPassword === $patient["Password"]) {


        // ==================================================
        // LOGIN SUCCESS- CREATE SESSION
        // ==================================================

        session_regenerate_id(true);


        // LOGIN SUCCESS- CREATE SESSION

          $_SESSION["UserName"] = $patient["UserName"];
          $_SESSION["PatientID"] = $patient["PatientID"];
          $_SESSION["LastName"] = $patient["LastName"];
          $_SESSION["FirstName"] = $patient["FirstName"];
          $_SESSION["DoctorID"] = $patient["DoctorID"];
         

        // ==================================================
        // LOGIN SUCCESSFULLY
        // ==================================================

        header("Location: home.php");
        exit();

    }

}


// ==================================================
// LOGIN FAILED
// ==================================================

$stmt->close();
$conn->close();

echo "<script>
        alert('Invalid UserName or Password!');
        window.location.href = 'index.php';
      </script>";

exit();

?>