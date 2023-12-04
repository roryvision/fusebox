<?php
session_start();
?>

<html lang='en' dir='ltr'>
    <head>
        <meta charset='utf-8'>
        <title>Profile</title>
        <link rel='stylesheet' href='../styles/global.css'>
        <link rel='stylesheet' href='../styles/profile.css'>
        <link href='https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap' rel='stylesheet'>
        <script src='../components/Header/HeaderNav.js' type='text/javascript'></script>
        <script src='../helpers/CardHelper.js' type='module'></script>
        <script src='../components/Card/CardProject.js' type='text/javascript'></script>
        <script src='../components/Card/CardPerson.js' type='text/javascript'></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src='../pages/profile.js' type='module'></script>
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
            <div id="outer-card">
                <div id="border-card">
                    <div id="profile-content">
                        <div id="content-left">
                            <div class='img-container'>
                                <?php
                                   echo "<img src='../assets/images/chuubear.jpeg'>";
                                ?>
                            </div>
                            <div id="major-1" class="majors"><?php
                                    echo $major1;
                                ?></div>
                            <div id="major-2" class="majors">
                                <?php
                                echo $major2;
                                ?>
                            </div>
                            <div class="b2">
                                <?php
                                echo "Graduating " . $grad;
                                ?>
                            </div>
                            <?php
                            echo "<a class= 'link' href = " . $website1 . ">" . $website1 . "</a>";
                            if($website2 != null){
                                echo "<a class= 'link' href = " . $website2 . ">" . $website2 . "</a>";
                            }
                            ?>
                            <div id="social-links">
                                <?php
                                if($instagram != null){
                                    echo "<a href = 'https://instagram.com/". $instagram . "'><img src='../assets/icons/instagram.png'></a>";
                                }
                                if($linkedin != null){
                                    echo "<a href = ". $linkedin . "><img src='../assets/icons/linkedin.png'></a>";
                                }

                                ?>
                            </div>
                        </div>
                        <div id="content-right" class="w-100">
                            <div id="profile-section" class="w-100">
                                    <?php
                                        echo "<h1>" . $fname . " " . $lname . "</h1>";
                                    ?>
                                <hr>

                                    <?php
                                    if($pronouns!=null){
                                        echo "<div class='sides'>";
                                        echo $pronouns;
                                        echo $email;
                                        echo "</div>";
                                    }else{
                                        echo "<div id='email'><a href='mailto:'" . $email . ">";
                                        echo $email;
                                        echo "</a></div>";
                                    }


                                    ?>

                            </div>
                            <div id="roles">
                                <?php
                                $roleclass = '';

                                switch ($roletype1) {
                                    case 'Tech':
                                        $roleclass = 'tech-role';
                                        break;
                                    case 'Visual':
                                        $roleclass = 'visual-role'; // Assign a specific class for Type B
                                        break;
                                    case 'Business':
                                        $roleclass = 'business-role'; // Assign a specific class for Type B
                                        break;
                                    case 'Film':
                                        $roleclass = 'film-role'; // Assign a specific class for Type B
                                        break;
                                    case 'Performing':
                                        $roleclass = 'performing-role'; // Assign a specific class for Type B
                                        break;
                                    default:
                                        $roleclass = 'general-role'; // Default color class
                                        break;
                                }
                                echo "<div class='". $roleclass . "'>" . $role1 . "</div>";

                                if($role2 != null ){
                                    switch ($roletype2) {
                                        case 'Tech':
                                            $roleclass = 'tech-role';
                                            break;
                                        case 'Visual':
                                            $roleclass = 'visual-role'; // Assign a specific class for Type B
                                            break;
                                        case 'Business':
                                            $roleclass = 'business-role'; // Assign a specific class for Type B
                                            break;
                                        case 'Film':
                                            $roleclass = 'film-role'; // Assign a specific class for Type B
                                            break;
                                        case 'Performing':
                                            $roleclass = 'performing-role'; // Assign a specific class for Type B
                                            break;
                                        default:
                                            $roleclass = 'general-role'; // Default color class
                                            break;
                                    }
                                    echo "<div class='". $roleclass . "'>" . $role2 . "</div>";
                                }
                                if($role3 != null ){
                                    switch ($roletype3) {
                                        case 'Tech':
                                            $roleclass = 'tech-role';
                                            break;
                                        case 'Visual':
                                            $roleclass = 'visual-role'; // Assign a specific class for Type B
                                            break;
                                        case 'Business':
                                            $roleclass = 'business-role'; // Assign a specific class for Type B
                                            break;
                                        case 'Film':
                                            $roleclass = 'film-role'; // Assign a specific class for Type B
                                            break;
                                        case 'Performing':
                                            $roleclass = 'performing-role'; // Assign a specific class for Type B
                                            break;
                                        default:
                                            $roleclass = 'general-role'; // Default color class
                                            break;
                                    }
                                    echo "<div class='". $roleclass . "'>" . $role3 . "</div>";
                                }
                                ?>
                            </div>
                            <div id="profile-section" class="w-100">
                                <h2>About</h2>
                                <hr>
                                <?php
                                echo $bio;
                                ?>

                            </div>
                            <div id="profile-section" class="w-100">
                                <h2>Skills</h2>
                                <?php

                                ?>
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <a href="editprofile.php"><div class="button-basic">Edit Profile</div></a>
            <ul class='flex-btwn' id='select-menu'>
                <li class='cursor-pointer selected' value='created'>created</li>
                <li class='cursor-pointer' value='saved'>saved</li>
                <li class='cursor-pointer' value='applied'>applied</li>
            </ul>
            <div id='cards-container'></div>

        </div>
    </body>


</html>