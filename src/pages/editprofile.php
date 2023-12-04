<?php
session_start();
?>
x
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
<?php

require_once('../helpers/db-connection.php');
$conn = openCon();
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

    if ($user) {
        $major1 = $user['major1'];
        $major2 = $user['major2'];
        $fname = $user['fname'];
        $lname = $user['lname'];
        $grad = $user['gradyear'];
        $website1 = $user['website1'];
        $website2 = $user['website2'];
        $instagram = $user['instagram'];
        $linkedin = $user['linkedin'];
        $pronouns = $user['pronouns'];
        $email = $user['email'];
        $role1 = $user['r1name'];
        $roletype1 = $user['r1type'];
        $role2 = $user['r2name'];
        $roletype2 = $user['r2type'];
        $role3 = $user['r3name'];
        $roletype3 = $user['r3type'];
        $bio = $user['bio'];

    }
} else {
    echo "No results found.";
}

closeCon($conn);

?>

<div id='container'>
    <header-nav></header-nav>
    <form action="submitted-profile.php" method="post" enctype="multipart/form-data">

    <div id="title">
            <h1>Edit Profile</h1>
            <div class="b1">Edit the information displayed on your profile business card!</div>

        </div>
        <?php
        if($pfp!=null){
            echo "<img id='pfp' src='" . $pfp . "'>";
        }else{
            echo "<img id='pfp' src='../assets/icons/icon_profile.svg'>";
        }
        ?>
        <input type="file" name="profile">
        <div class="field">
        <label for="fname">First name:</label>
            <input type="text" id="fname" name="fname">
        </div>
        <input type="submit" value="submit">


    </form>

</div>
</body>


</html>
