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
    <script>

    </script>
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
    $skill_sql = "SELECT skills, ps_id
                  FROM profiles_x_skills AS pxs
                  LEFT JOIN skill AS s ON pxs.skill_id = s.skill_id
                  WHERE " . $_SESSION['user_id'] . " = pxs.profile_id";
    $skill_results = $conn->query($skill_sql);
    if (!$skill_results) {
        echo "SQL error: " . $conn->error;
        exit();
    }
    $skills = array();
    $ps_ids = array();
    while ($skill_row = $skill_results->fetch_assoc()) {
        $skills[] = $skill_row['skills'];
        $ps_ids[] = $skill_row['ps_id'];
    }
    $row['skills'] = $skills;

$skill1 = $skills[0];
$ps1_id = $ps_ids[0];
$skill2 = $skills[1];
$ps2_id = $ps_ids[1];
$skill3 = $skills[2];
$ps3_id = $ps_ids[2];

echo $skill1 . ", " . $skill2 . ", " . $skill3;



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
            echo "<input type= 'text' id='fname' name='fname' class='filled' value ='" . $fname  ."' required>";
            ?>
        </div>
        <div class="field">
            <label for="lname">Last name:
                <img src="../assets/icons/star.png"></label>
            <?php
            echo "<input type= 'text' id='lname' name='lname' class='filled' value ='" . $lname  ."' required >";
            ?>
        </div>
        </div>

        <div class="two-fields">
            <div class="field">
                <label for="pronouns">Pronouns

                </label>
                <select name="pronouns" id="pronouns" required >
                    <?php
                    if($pronouns == null){
                        echo "<option value='ALL' selected>Select a pronoun</option>
                    <option disabled >–––</option>";
                    }else{
                        echo "<option value='ALL' >Select a pronoun</option>
                    <option disabled >–––</option>";
                    }

                    $pronounsql = "SELECT * FROM pronoun";
                    $pronounresults = $conn -> query($pronounsql);
                while($currentrow = $pronounresults->fetch_assoc()){
                    if($pronouns == $currentrow["pronouns"]){
                        echo "<option selected value =" . $currentrow["pronoun_id"]. " >" . $currentrow["pronouns"] . "</option>";
                    }else{
                        echo "<option value =" . $currentrow["pronoun_id"]. " >" . $currentrow["pronouns"] . "</option>";
                    }


                }
                ?>
                </select>
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
                $majorsql = "SELECT * FROM major";
                $majorresults = $conn -> query($majorsql);
                    while($currentrow = $majorresults->fetch_assoc()){
                        if($major1 == $currentrow["major"]){
                            echo "<option selected value =" . $currentrow["major_id"]. " >" . $currentrow["major"] . "</option>";
                        }else{
                            echo "<option value =" . $currentrow["major_id"]. " >" . $currentrow["major"] . "</option>";
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
                    $majorsql = "SELECT * FROM major";
                    $majorresults = $conn -> query($majorsql);
                    while($currentrow = $majorresults->fetch_assoc()){
                        if($major2 == $currentrow["major"]){
                            echo "<option selected value =" . $currentrow["major_id"]. " >" . $currentrow["major"] . "</option>";
                        }else{
                            echo "<option value =" . $currentrow["major_id"]. " >" . $currentrow["major"] . "</option>";
                        }

                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="two-fields">
            <div class="field">
                <label for="grad">Graduation Year
                    <img src="../assets/icons/star.png">
                </label>
                <?php
                echo "<input type= 'text' id='grad' name='grad' class='filled' value ='" . $grad
                    ."'>";
                ?>
            </div>
            <div class="field">

            </div>
        </div>

        <div class="two-fields">
            <div class="field">
                <label for="role1">Role 1
                </label>
                <select name="role1" id="role1" >
                    <option value="ALL" >Select a role</option>
                    <option disabled >–––</option>
                    <?php
                    $rolesql = "SELECT * FROM role";
                    $roleresults = $conn -> query($rolesql);
                    while($currentrow = $roleresults->fetch_assoc()){
                        if($role1 == $currentrow["role_name"]){
                            echo "<option selected value =" . $currentrow["role_id"]. " >" . $currentrow["role_name"] . "</option>";
                        }else{
                            echo "<option value =" . $currentrow["role_id"]. " >" . $currentrow["role_name"] . "</option>";
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
                    $rolesql = "SELECT * FROM role";
                    $roleresults = $conn -> query($rolesql);
                    while($currentrow = $roleresults->fetch_assoc()){
                        if($role2 == $currentrow["role_name"]){
                            echo "<option selected value =" . $currentrow["role_id"]. " >" . $currentrow["role_name"] . "</option>";
                        }else{
                            echo "<option value =" . $currentrow["role_id"]. " >" . $currentrow["role_name"] . "</option>";
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
                    $rolesql = "SELECT * FROM role";
                    $roleresults = $conn -> query($rolesql);
                    while($currentrow = $roleresults->fetch_assoc()){
                        if($role3 == $currentrow["role_name"]){
                            echo "<option selected value =" . $currentrow["role_id"]. " >" . $currentrow["role_name"] . "</option>";
                        }else{
                            echo "<option value =" . $currentrow["role_id"]. " >" . $currentrow["role_name"] . "</option>";
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
                echo "<textarea id='about' name='about' class='filled'> " . $bio . "</textarea>";
            ?>


        </div>

        <div class="two-fields">
            <div class="field">
                <label for="website1">Website 1
                </label>

                <?php
                if($website1){
                    echo "<input type='text' id='website1' name='website1' class='filled' value = " . $website1 . ">";
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
                    echo "<input type='text' id='website2' name='website2' class='filled' value = " . $website2 . ">";
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
                    echo "<input type='text' id='instagram' name='instagram' class='filled' value = " . $instagram . ">";
                }else{
                    echo "<input type='text' id='instagram' name='instagram'  value = 'Instagram'>";
                }

                ?>

            </div>
            <div class="field">
                <label for="linkedin">LinkedIn
                </label>

                <?php
                if($linkedin){
                    echo "<input type='text' id='linkedin' name='linkedin' class='filled' value = " . $linkedin . ">";
                }else{
                    echo "<input type='text' id='linkedin' name='linkedin'  value = 'Website 2'>";
                }

                ?>

            </div>
        </div>

        <div class="two-fields">
            <div class="field">
                <label for="skill1">Skill 1
                </label>
                <select name="skill1" id="skill1"  >
                    <?php
                    if($skill1 == null){
                    echo "<option value='ALL' selected >Select a skill</option>
                    <option disabled >–––</option>";
                    }else{
                    echo "<option value='ALL' >Select a skill</option>
                    <option disabled >–––</option>";
                    }
                    $skillsql = "SELECT * FROM skill";
                    $skillresults = $conn -> query($skillsql);
                    while($currentrow = $skillresults->fetch_assoc()){
                    if($skill1 == $currentrow["skills"]){
                    echo "<option selected value =" . $currentrow["skill_id"]. " >" . $currentrow["skills"] . "</option>";
                    }else{
                    echo "<option value =" . $currentrow["skill_id"]. " >" . $currentrow["skills"] . "</option>";
                    }


                    }
                    ?>
                </select>

                <input type="hidden" name="ps1_id" value="<?php echo $ps1_id; ?>">

            </div>
            <div class="field">
                <label for="skill2">Skill 2

                </label>
                <select name="skill2" id="skill2"  >

                    <?php
                    if($skill2 == null){
                    echo "<option value='ALL' selected >Select a skill</option>
                    <option disabled >–––</option>";
                    }else{
                    echo "<option value='ALL' >Select a skill</option>
                    <option disabled >–––</option>";
                    }
                    $skillsql = "SELECT * FROM skill";
                    $skillresults = $conn -> query($skillsql);
                    while($currentrow = $skillresults->fetch_assoc()){
                    if($skill2 == $currentrow["skills"]){
                    echo "<option selected value =" . $currentrow["skill_id"]. " >" . $currentrow["skills"] . "</option>";
                    }else{
                    echo "<option value =" . $currentrow["skill_id"]. " >" . $currentrow["skills"] . "</option>";
                    }


                    }
                    ?>
                </select>
                <input type="hidden" name="ps2_id" value="<?php echo $ps2_id; ?>">

            </div>
            <div class="field">
                <label for="skill3">Skill 3

                </label>
                <select name="skill3" id="skill3"  >

                    <?php
                    if($skill3 == null){
                    echo "<option value='ALL' selected >Select a skill</option>
                    <option disabled >–––</option>";
                    }else{

                        echo "<option value='ALL' >Select a skill</option>
                    <option disabled >–––</option>";
                    }
                    $skillsql = "SELECT * FROM skill";
                    $skillresults = $conn -> query($skillsql);
                    while($currentrow = $skillresults->fetch_assoc()){
                    if($skill3 == $currentrow["skills"]){
                    echo "<option selected value =" . $currentrow["skill_id"]. " >" . $currentrow["skills"] . "</option>";
                    }else{
                    echo "<option value =" . $currentrow["skill_id"]. " >" . $currentrow["skills"] . "</option>";
                    }


                    }
                    ?>
                </select>

                <input type="hidden" name="ps3_id" value="<?php echo $ps3_id; ?>">

            </div>
        </div>
        <input type="submit" value="submit">


    </form>

</div>
</body>


</html>
