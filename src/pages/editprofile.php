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

$majorsql = "SELECT * FROM major";
$majorresults = $conn -> query($majorsql);
$rolesql = "SELECT * FROM role";
$roleresults = $conn -> query($rolesql);

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
        <div class="two-fields">
        <div class="field">
            <label for="fname">First name:
            <img src="../assets/icons/star.png">
            </label>
            <?php
            echo "<input type= 'text' id='fname' name='fname' class='filled' placeholder ='" . $fname  ."' required>";
            ?>
        </div>
        <div class="field">
            <label for="lname">Last name:
                <img src="../assets/icons/star.png"></label>
            <?php
            echo "<input type= 'text' id='lname' name='lname' class='filled' placeholder ='" . $lname  ."' required >";
            ?>
        </div>
        </div>

        <div class="two-fields">
            <div class="field">
                <label for="fname">Pronouns

                </label>
                <?php
                echo "<input type= 'text' id='fname' name='fname' class='filled' placeholder ='" . $fname  ."'>";
                ?>
            </div>
            <div class="field">

            </div>
        </div>

        <div class="two-fields">
            <div class="field">
                <label for="major">Major
                    <img src="../assets/icons/star.png">
                </label>
                <select name="major" id="major" required >
                    <option value="ALL" >Select a major</option>
                    <option disabled >–––</option>
                <?php

                    while($currentrow = $majorresults->fetch_assoc()){
                        if($major1 == $currentrow["major"]){
                            echo "<option selected>" . $currentrow["major"] . "</option>";
                        }else{
                            echo "<option>" . $currentrow["major"] . "</option>";
                        }


                    }
                ?>
                </select>

            </div>
            <div class="field">
                <label for="major2">Second Major
                    <img src="../assets/icons/star.png">
                </label>
                <select name="major2" id="major2" required >
                    <?php
                    if($major2 == null){
                        echo "<option value='ALL' selected >Select a major</option>
                    <option disabled >–––</option>";
                    }else{
                        echo "<option value='ALL' >Select a major</option>
                    <option disabled >–––</option>";
                    }

                    while($currentrow = $majorresults->fetch_assoc()){
                        if($major2 == $currentrow["major"]){
                            echo "<option selected>" . $currentrow["major"] . "</option>";
                        }else{
                            echo "<option>" . $currentrow["major"] . "</option>";
                        }

                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="two-fields">
            <div class="field">
                <label for="fname">Graduation Year
                    <img src="../assets/icons/star.png">
                </label>
                <?php
                echo "<input type= 'text' id='fname' name='fname' class='filled' placeholder ='" . $grad
                    ."'>";
                ?>
            </div>
            <div class="field">

            </div>
        </div>

        <div class="two-fields">
            <div class="field">
                <label for="role1">Role 1
                    <img src="../assets/icons/star.png">
                </label>
                <select name="role1" id="role1" required >
                    <option value="ALL" >Select a major</option>
                    <option disabled >–––</option>
                    <?php

                    while($currentrow = $roleresults->fetch_assoc()){
                        if($role1 == $currentrow["role_name"]){
                            echo "<option selected>" . $currentrow["role_name"] . "</option>";
                        }else{
                            echo "<option>" . $currentrow["role_name"] . "</option>";
                        }


                    }
                    ?>
                </select>

            </div>
            <div class="field">
                <label for="role2">Role 2

                </label>
                <select name="role2" id="role2"  >

                    <?php
                    if($role2 == null){
                        echo "<option value='ALL' selected >Select a role</option>
                    <option disabled >–––</option>";
                    }else{
                        echo "<option value='ALL' >Select a role</option>
                    <option disabled >–––</option>";
                    }

                    while($currentrow = $roleresults->fetch_assoc()){
                        if($role2 == $currentrow["role_name"]){
                            echo "<option selected>" . $currentrow["role_name"] . "</option>";
                        }else{
                            echo "<option>" . $currentrow["role_name"] . "</option>";
                        }


                    }
                    ?>
                </select>

            </div>
            <div class="field">
                <label for="role3">Role 3

                </label>
                <select name="role3" id="role3"  >

                    <?php
                    if($role3 == null){
                        echo "<option value='ALL' selected >Select a role</option>
                    <option disabled >–––</option>";
                    }else{
                        echo "<option value='ALL' >Select a role</option>
                    <option disabled >–––</option>";
                    }

                    while($currentrow = $roleresults->fetch_assoc()){
                        if($role3 == $currentrow["role_name"]){
                            echo "<option selected>" . $currentrow["role_name"] . "</option>";
                        }else{
                            echo "<option>" . $currentrow["role_name"] . "</option>";
                        }


                    }
                    ?>
                </select>

            </div>
        </div>

        <div class="field" id="bio">
            <label for="about">About

            </label>
            <?php
                echo "<input type='text' id='about' name='about' class='filled'placeholder = " . $bio . ">";
            ?>


        </div>

        <div class="two-fields">
            <div class="field">
                <label for="website1">Website 1
                </label>

                <?php
                if($website1){
                    echo "<input type='text' id='website1' name='website1' class='filled' placeholder = " . $website1 . ">";
                }else{
                    echo "<input type='text' id='website1' name='website1'  placeholder = 'Website 1'>";
                }

                ?>

            </div>
            <div class="field">
                <label for="website2">Website 2
                </label>

                <?php
                if($website2){
                    echo "<input type='text' id='website2' name='website2' class='filled' placeholder = " . $website2 . ">";
                }else{
                    echo "<input type='text' id='website2' name='website2'  placeholder = 'Website 2'>";
                }

                ?>

            </div>
        </div>
        <div class="two-fields">
            <div class="field">
                <label for="instagram">Instagram
                </label>

                <?php
                if($instagram){
                    echo "<input type='text' id='instagram' name='instagram' class='filled' placeholder = " . $instagram . ">";
                }else{
                    echo "<input type='text' id='instagram' name='instagram'  placeholder = 'Instagram'>";
                }

                ?>

            </div>
            <div class="field">
                <label for="linkedin">LinkedIn
                </label>

                <?php
                if($linkedin){
                    echo "<input type='text' id='linkedin' name='linkedin' class='filled' placeholder = " . $linkedin . ">";
                }else{
                    echo "<input type='text' id='linkedin' name='linkedin'  placeholder = 'Website 2'>";
                }

                ?>

            </div>
        </div>
        <input type="submit" value="submit">


    </form>

    <?php

    ?>
</div>
</body>


</html>
