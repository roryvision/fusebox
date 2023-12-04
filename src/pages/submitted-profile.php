<?php
session_start();
?>

<html lang='en' dir='ltr'>
<head>
    <meta charset='utf-8'>
    <title>Edit Profile</title>
    <link rel='stylesheet' href='../styles/global.css'>
    <link rel='stylesheet' href='../styles/editprofile.css'>

    <link href='https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap' rel='stylesheet'>
    <script src='../components/Header/HeaderNav.js' type='text/javascript'></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<div id='container'>
    <header-nav></header-nav>

    <div id="content">
<?php

require_once('../helpers/db-connection.php');
$conn = openCon();

$profileId = $_SESSION['user_id'];

if (empty($_FILES["profile"]["name"])) {
    // Either the form is loading for the first time
    // OR it was submitted with no file
    // Stop the page and give the user a message
    echo "No file was uploaded.";

} else {
    // There is an uploaded file from
    // a form object named "profile"

    // Target directory where the file will be stored
    $targetDir = "../assets/uploads/";
    $targetFilePath = $targetDir . basename($_FILES["profile"]["name"]);

    // Move the uploaded file to the target directory
    if (move_uploaded_file($_FILES["profile"]["tmp_name"], $targetFilePath)) {
        echo "<h3>Successfully updated profile!</h3>";

        // Get the file content to store in the database
        ;

        // Insert the file content into the database for a specific profile
        $profileId = $_SESSION['user_id']; // Replace with your profile ID
        $insertQuery = "UPDATE profile SET profile_pic = ? WHERE profile_id = ?";
        $stmt = $conn->prepare($insertQuery);

        if (!$stmt) {
            die('Error preparing statement: ' . $conn->error);
        }

        $stmt->bind_param("si", $targetFilePath, $profileId);

        if ($stmt->execute()) {
            echo "File content inserted into the database for profile ID: " . $profileId;
        } else {
            echo "Error inserting file content: " . $conn->error;
        }
    } else {
        echo "Error uploading the file.";
    }
}

$fname = $_REQUEST['fname'];
$fnameQuery = "UPDATE profile SET fname = ? WHERE profile_id = ?";
$stmtfname = $conn->prepare($fnameQuery);

if (!$stmtfname) {
    die('Error preparing statement: ' . $conn->error);
}

$stmtfname->bind_param("si", $fname, $profileId);

if ($stmtfname->execute()) {
    // Update successful
    echo "First name updated successfully!";
} else {
    // Update failed
    echo "Error updating profile: " . $conn->error;
}

$lname = $_REQUEST['lname'];
$lnameQuery = "UPDATE profile SET lname = ? WHERE profile_id = ?";
$stmtlname = $conn->prepare($lnameQuery);

if (!$stmtlname) {
    die('Error preparing statement: ' . $conn->error);
}

$stmtlname->bind_param("si", $lname, $profileId);

if ($stmtlname->execute()) {
    // Update successful
    echo "Last name updated successfully!";
} else {
    // Update failed
    echo "Error updating profile: " . $conn->error;
}

$pronoun = $_REQUEST['pronouns'];
$prQuery = "UPDATE profile SET pronoun_id = ? WHERE profile_id = ?";
$stmtlpr = $conn->prepare($prQuery);

if (!$stmtlpr) {
    die('Error preparing statement: ' . $conn->error);
}

$stmtlpr->bind_param("si", $pronoun, $profileId);

if ($stmtlpr->execute()) {
    // Update successful
    echo "Pronouns updated successfully!";
} else {
    // Update failed
    echo "Error updating profile: " . $conn->error;
}


$major1 = $_REQUEST['major'];
$m1Query = "UPDATE profile SET major_id = ? WHERE profile_id = ?";
$stmtm1 = $conn->prepare($m1Query);

if (!$stmtm1) {
    die('Error preparing statement: ' . $conn->error);
}

$stmtm1->bind_param("si", $major1, $profileId);

if ($stmtm1->execute()) {
    // Update successful
    echo "Major 1 updated successfully!";
} else {
    // Update failed
    echo "Error updating profile: " . $conn->error;
}

$major2 = $_REQUEST['major2'];
$m2Query = "UPDATE profile SET major2_id = ? WHERE profile_id = ?";
$stmtm2 = $conn->prepare($m2Query);

if (!$stmtm2) {
    die('Error preparing statement: ' . $conn->error);
}

$stmtm2->bind_param("si", $major2, $profileId);

if ($stmtm2->execute()) {
    // Update successful
    echo "Major 2 updated successfully!";
} else {
    // Update failed
    echo "Error updating profile: " . $conn->error;
}

$grad = $_REQUEST['grad'];
$gradQuery = "UPDATE profile SET gradyear = ? WHERE profile_id = ?";
$stmtgrad = $conn->prepare($gradQuery);

if (!$stmtgrad) {
    die('Error preparing statement: ' . $conn->error);
}

$stmtgrad->bind_param("si", $grad, $profileId);

if ($stmtgrad->execute()) {
    // Update successful
    echo "Grad updated successfully!";
} else {
    // Update failed
    echo "Error updating profile: " . $conn->error;
}

$role1 = $_REQUEST['role1'];
$r1Query = "UPDATE profile SET role1_id = ? WHERE profile_id = ?";
$stmtr1 = $conn->prepare($r1Query);

if (!$stmtr1) {
    die('Error preparing statement: ' . $conn->error);
}

$stmtr1->bind_param("si", $role1, $profileId);

if ($stmtr1->execute()) {
    // Update successful
    echo "Role 1 updated successfully!";
} else {
    // Update failed
    echo "Error updating profile: " . $conn->error;
}


$role2 = $_REQUEST['role2'];
$r2Query = "UPDATE profile SET role2_id = ? WHERE profile_id = ?";
$stmtr2 = $conn->prepare($r2Query);

if (!$stmtr2) {
    die('Error preparing statement: ' . $conn->error);
}

$stmtr2->bind_param("si", $role2, $profileId);

if ($stmtr2->execute()) {
    // Update successful
    echo "Role 2 updated successfully!";
} else {
    // Update failed
    echo "Error updating profile: " . $conn->error;
}


$role3 = $_REQUEST['role3'];
$r3Query = "UPDATE profile SET role3_id = ? WHERE profile_id = ?";
$stmtr3 = $conn->prepare($r3Query);

if (!$stmtr3) {
    die('Error preparing statement: ' . $conn->error);
}

$stmtr3->bind_param("si", $role3, $profileId);

if ($stmtr3->execute()) {
    // Update successful
    echo "Role 2 updated successfully!";
} else {
    // Update failed
    echo "Error updating profile: " . $conn->error;
}

$about = $_REQUEST['about'];
$abtQuery = "UPDATE profile SET bio = ? WHERE profile_id = ?";
$stmtabt = $conn->prepare($abtQuery);

if (!$stmtabt) {
    die('Error preparing statement: ' . $conn->error);
}

$stmtabt->bind_param("si", $about, $profileId);

if ($stmtabt->execute()) {
    // Update successful
    echo "Role 2 updated successfully!";
} else {
    // Update failed
    echo "Error updating profile: " . $conn->error;
}


$website1 = $_REQUEST['website1'];
$w1Query = "UPDATE profile SET website1 = ? WHERE profile_id = ?";
$stmtw1 = $conn->prepare($w1Query);

if (!$stmtw1) {
    die('Error preparing statement: ' . $conn->error);
}

$stmtw1->bind_param("si", $website1, $profileId);

if ($stmtw1->execute()) {
    // Update successful
    echo "Role 2 updated successfully!";
} else {
    // Update failed
    echo "Error updating profile: " . $conn->error;
}


$website2 = $_REQUEST['website2'];
$w2Query = "UPDATE profile SET website2 = ? WHERE profile_id = ?";
$stmtw2 = $conn->prepare($w2Query);

if (!$stmtw2) {
    die('Error preparing statement: ' . $conn->error);
}

$stmtw2->bind_param("si", $website2, $profileId);

if ($stmtw2->execute()) {
    // Update successful
    echo "Role 2 updated successfully!";
} else {
    // Update failed
    echo "Error updating profile: " . $conn->error;
}


$insta = $_REQUEST['instagram'];
$instaQuery = "UPDATE profile SET instagram = ? WHERE profile_id = ?";
$stmtinsta = $conn->prepare($instaQuery);

if (!$stmtinsta) {
    die('Error preparing statement: ' . $conn->error);
}

$stmtinsta->bind_param("si", $insta, $profileId);

if ($stmtinsta->execute()) {
    // Update successful
    echo "Role 2 updated successfully!";
} else {
    // Update failed
    echo "Error updating profile: " . $conn->error;
}


$linkedin = $_REQUEST['linkedin'];
$linkedinQuery = "UPDATE profile SET linkedin = ? WHERE profile_id = ?";
$stmtlinked = $conn->prepare($linkedinQuery);

if (!$stmtlinked) {
    die('Error preparing statement: ' . $conn->error);
}

$stmtlinked->bind_param("si", $linkedin, $profileId);

if ($stmtlinked->execute()) {
    // Update successful
    echo "Linkedin updated successfully!";
} else {
    // Update failed
    echo "Error updating profile: " . $conn->error;
}


?>
    <div id="buttons">
    <a href="dashboard.php"><div class="button-basic">Back to Home</div></a>
    <a href="profile.php"><div class="button-red">View Profile</div></a>
    </div>
    </div>
</div>
</body>
</html>

