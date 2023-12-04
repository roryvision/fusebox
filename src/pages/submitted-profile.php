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
$connected = true;

$profileId = $_SESSION['user_id'];

if (empty($_FILES["profile"]["name"])) {

} else {

    $targetDir = "../assets/uploads/";
    $targetFilePath = $targetDir . basename($_FILES["profile"]["name"]);

    if (move_uploaded_file($_FILES["profile"]["tmp_name"], $targetFilePath)) {
        $profileId = $_SESSION['user_id'];
        $insertQuery = "UPDATE profile SET profile_pic = ? WHERE profile_id = ?";
        $stmt = $conn->prepare($insertQuery);

        if (!$stmt) {
            $connected = false;

            die('Error preparing statement: ' . $conn->error);
        }

        $stmt->bind_param("si", $targetFilePath, $profileId);

        if ($stmt->execute()) {
            $connected = false;

            echo "File content inserted into the database for profile ID: " . $profileId;
        } else {
            $connected = false;

            echo "Error inserting file content: " . $conn->error;
        }
    } else {
        $connected = false;

        echo "Error uploading the file.";
    }
}

$fname = $_REQUEST['fname'];
$fnameQuery = "UPDATE profile SET fname = ? WHERE profile_id = ?";
$stmtfname = $conn->prepare($fnameQuery);

if (!$stmtfname) {
    $connected = false;

    die('Error preparing statement: ' . $conn->error);
}

$stmtfname->bind_param("si", $fname, $profileId);

if ($stmtfname->execute()) {
} else {
    $connected = false;
    echo "Error updating profile: " . $conn->error;
}

$lname = $_REQUEST['lname'];
$lnameQuery = "UPDATE profile SET lname = ? WHERE profile_id = ?";
$stmtlname = $conn->prepare($lnameQuery);

if (!$stmtlname) {
    $connected = false;

    die('Error preparing statement: ' . $conn->error);
}

$stmtlname->bind_param("si", $lname, $profileId);

if ($stmtlname->execute()) {

} else {
    $connected = false;
    echo "Error updating profile: " . $conn->error;
}

$pronoun = $_REQUEST['pronouns'];
if($pronoun!='ALL') {
    $prQuery = "UPDATE profile SET pronoun_id = ? WHERE profile_id = ?";
    $stmtlpr = $conn->prepare($prQuery);

    if (!$stmtlpr) {
        $connected = false;
        die('Error preparing statement: ' . $conn->error);
    }

    $stmtlpr->bind_param("si", $pronoun, $profileId);

    if ($stmtlpr->execute()) {
    } else {
        $connected = false;
        echo "Error updating profile: " . $conn->error;
    }
}

$major1 = $_REQUEST['major'];
$m1Query = "UPDATE profile SET major_id = ? WHERE profile_id = ?";
$stmtm1 = $conn->prepare($m1Query);

if (!$stmtm1) {
    $connected = false;

    die('Error preparing statement: ' . $conn->error);
}

$stmtm1->bind_param("si", $major1, $profileId);

if ($stmtm1->execute()) {

} else {
    $connected = false;
    echo "Error updating profile: " . $conn->error;
}

$major2 = $_REQUEST['major2'];
if($major2!='ALL'){
    $m2Query = "UPDATE profile SET major2_id = ? WHERE profile_id = ?";
    $stmtm2 = $conn->prepare($m2Query);

    if (!$stmtm2) {
        $connected = false;

        die('Error preparing statement: ' . $conn->error);
    }

    $stmtm2->bind_param("si", $major2, $profileId);

    if ($stmtm2->execute()) {

    } else {
        $connected = false;
        echo "Error updating profile: " . $conn->error;
    }

}

$grad = $_REQUEST['grad'];
$gradQuery = "UPDATE profile SET gradyear = ? WHERE profile_id = ?";
$stmtgrad = $conn->prepare($gradQuery);

if (!$stmtgrad) {
    $connected = false;

    die('Error preparing statement: ' . $conn->error);
}

$stmtgrad->bind_param("si", $grad, $profileId);

if ($stmtgrad->execute()) {
} else {
    $connected = false;
    echo "Error updating profile: " . $conn->error;
}

$role1 = $_REQUEST['role1'];
$r1Query = "UPDATE profile SET role1_id = ? WHERE profile_id = ?";
$stmtr1 = $conn->prepare($r1Query);

if (!$stmtr1) {
    $connected = false;
    die('Error preparing statement: ' . $conn->error);
}

$stmtr1->bind_param("si", $role1, $profileId);

if ($stmtr1->execute()) {

} else {
    $connected = false;
    echo "Error updating profile: " . $conn->error;
}


$role2 = $_REQUEST['role2'];
if($role2!='ALL'){
$r2Query = "UPDATE profile SET role2_id = ? WHERE profile_id = ?";
$stmtr2 = $conn->prepare($r2Query);

if (!$stmtr2) {
    $connected = false;

    die('Error preparing statement: ' . $conn->error);
}

$stmtr2->bind_param("si", $role2, $profileId);

if ($stmtr2->execute()) {

} else {
    $connected = false;
    echo "Error updating profile: " . $conn->error;
}

}
$role3 = $_REQUEST['role3'];

if($role3!='ALL') {

    $r3Query = "UPDATE profile SET role3_id = ? WHERE profile_id = ?";
    $stmtr3 = $conn->prepare($r3Query);

    if (!$stmtr3) {
        die('Error preparing statement: ' . $conn->error);
    }

    $stmtr3->bind_param("si", $role3, $profileId);

    if ($stmtr3->execute()) {

    } else {
        $connected = false;
        echo "Error updating profile: " . $conn->error;
    }
}
$about = $_REQUEST['about'];
$abtQuery = "UPDATE profile SET bio = ? WHERE profile_id = ?";
$stmtabt = $conn->prepare($abtQuery);

if (!$stmtabt) {
    $connected = false;

    die('Error preparing statement: ' . $conn->error);
}

$stmtabt->bind_param("si", $about, $profileId);

if ($stmtabt->execute()) {

} else {
    $connected = false;
    echo "Error updating profile: " . $conn->error;
}


$website1 = $_REQUEST['website1'];
$w1Query = "UPDATE profile SET website1 = ? WHERE profile_id = ?";
$stmtw1 = $conn->prepare($w1Query);

if (!$stmtw1) {
    $connected = false;

    die('Error preparing statement: ' . $conn->error);
}

$stmtw1->bind_param("si", $website1, $profileId);

if ($stmtw1->execute()) {

} else {
    $connected = false;

    echo "Error updating profile: " . $conn->error;
}


$website2 = $_REQUEST['website2'];
$w2Query = "UPDATE profile SET website2 = ? WHERE profile_id = ?";
$stmtw2 = $conn->prepare($w2Query);

if (!$stmtw2) {
    $connected = false;

    die('Error preparing statement: ' . $conn->error);
}

$stmtw2->bind_param("si", $website2, $profileId);

if ($stmtw2->execute()) {
} else {
    $connected = false;
    echo "Error updating profile: " . $conn->error;
}


$insta = $_REQUEST['instagram'];
$instaQuery = "UPDATE profile SET instagram = ? WHERE profile_id = ?";
$stmtinsta = $conn->prepare($instaQuery);

if (!$stmtinsta) {
    $connected = false;

    die('Error preparing statement: ' . $conn->error);
}

$stmtinsta->bind_param("si", $insta, $profileId);

if ($stmtinsta->execute()) {
} else {
    $connected = false;
    echo "Error updating profile: " . $conn->error;
}


$linkedin = $_REQUEST['linkedin'];
$linkedinQuery = "UPDATE profile SET linkedin = ? WHERE profile_id = ?";
$stmtlinked = $conn->prepare($linkedinQuery);

if (!$stmtlinked) {
    $connected = false;

    die('Error preparing statement: ' . $conn->error);
}

$stmtlinked->bind_param("si", $linkedin, $profileId);

if ($stmtlinked->execute()) {
} else {
    $connected = false;
    echo "Error updating profile: " . $conn->error;
}

$skill1 = $_REQUEST['skill1'];

if(isset($_REQUEST['ps1_id'])){
    $s1Query = "UPDATE profiles_x_skills SET skill_id = ? WHERE ps_id = ?";
    $stmts1 = $conn->prepare($s1Query);

    if (!$stmts1) {
        $connected = false;

        die('Error preparing statement: ' . $conn->error);
    }

    $ps1Id = $_REQUEST['ps1_id'];

    $stmts1->bind_param("ii", $skill1, $ps1Id);

    if ($stmts1->execute()) {
    } else {
        $connected = false;
        echo "Error updating profile: " . $conn->error;
    }
}else if($skill1=='ALL'){

}else{

    $s1Query = "INSERT INTO profiles_x_skills (skill_id, profile_id) VALUES (" . $skill1 .", " . $profileId .")";
    $stmts1 = $conn->prepare($s1Query);

    if (!$stmts1) {
        $connected = false;

        die('Error preparing statement: ' . $conn->error);
    }

    if ($stmts1->execute()) {
    } else {
        $connected = false;
        echo "Error updating profile: " . $conn->error;
    }
}

$skill2 = $_REQUEST['skill2'];

if(isset($_REQUEST['ps2_id'])){
    $s2Query = "UPDATE profiles_x_skills SET skill_id = ? WHERE ps_id = ?";
    $stmts2 = $conn->prepare($s2Query);

    if (!$stmts2) {
        $connected = false;

        die('Error preparing statement: ' . $conn->error);
    }

    $ps2Id = $_REQUEST['ps2_id'];


    $stmts2->bind_param("si", $skill2, $ps2Id);
    if ($stmts2->execute()) {
    } else {
        $connected = false;
        echo "Error updating profile: " . $conn->error;
    }


}else if($skill2=='ALL'){

}else{
    $s2Query = "INSERT INTO profiles_x_skills (skill_id, profile_id) VALUES (" . $skill2 .", " . $profileId .")";
    $stmts2 = $conn->prepare($s1Query);

    if (!$stmts2) {
        $connected = false;

        die('Error preparing statement: ' . $conn->error);
    }

    if ($stmts2->execute()) {
    } else {
        $connected = false;
        echo "Error updating profile: " . $conn->error;
    }
}
$skill3 = $_REQUEST['skill3'];

if(isset($_REQUEST['ps3_id'])){
    $s3Query = "UPDATE profiles_x_skills SET skill_id = ? WHERE ps_id = ?";
    $stmts3 = $conn->prepare($s3Query);

    if (!$stmts3) {
        $connected = false;

        die('Error preparing statement: ' . $conn->error);
    }

    $ps3Id = $_REQUEST['ps3_id'];


    $stmts3->bind_param("si", $skill3, $ps3Id);

    if ($stmts3->execute()) {
    } else {
        $connected = false;
        echo "Error updating profile: " . $conn->error;
    }

    if($connected){
        echo "<h3>Profile has updated successfully!</h3>";
    }else{
        echo "<h3>There was an error when updating.</h3>";
    }

}else if($skill3=='ALL'){

}else{
    $s3Query = "INSERT INTO profiles_x_skills (skill_id, profile_id) VALUES (" . $skill3 .", " . $profileId .")";
    $stmts3 = $conn->prepare($s3Query);

    if (!$stmts3) {
        $connected = false;

        die('Error preparing statement: ' . $conn->error);
    }

    if ($stmts3->execute()) {
    } else {
        $connected = false;
        echo "Error updating profile: " . $conn->error;
    }
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

