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



if (empty($_FILES["profile"]["name"])) {
    // Either the form is loading for the first time
    // OR it was submitted with no file
    // Stop the page and give the user a message
    exit("No file was uploaded.");
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

//        if ($stmt->execute()) {
//            echo "File content inserted into the database for profile ID: " . $profileId;
//        } else {
//            echo "Error inserting file content: " . $conn->error;
//        }
    } else {
        echo "Error uploading the file.";
    }
}

$sql = "SELECT p.profile_id, p.profile_pic, m1.major AS major1, m2.major AS major2, p.fname, p.lname, p.email, pr.pronouns, p.bio, p.website1, p.website2, p.gradyear, p.linkedin, p.instagram, r1.role_name AS r1name, r2.role_name AS r2name, r3.role_name AS r3name, r1.role_type AS r1type, r2.role_type AS r2type, r3.role_type AS r3type
        FROM profile p
        INNER JOIN major m1 ON p.major_id = m1.major_id
        INNER JOIN major m2 ON p.major2_id = m2.major_id
        LEFT JOIN role r1 ON p.role1_id = r1.role_id
        LEFT JOIN role r2 ON p.role2_id = r2.role_id
        LEFT JOIN role r3 ON p.role3_id = r3.role_id
        LEFT JOIN pronoun pr ON p.pronoun_id = pr.pronoun_id
        WHERE p.profile_id =" . $_SESSION["user_id"];
$result = $conn->query($sql);

if (!$result) {
    echo "SQL error: " . $conn->error;
    exit();
}

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc(); // Fetch data

    $pfp = $user['profile_pic'];


} else {
    echo "No results found.";
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

