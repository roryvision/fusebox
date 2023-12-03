<?php
session_start();
?>

<html lang='en' dir='ltr'>
    <head>
        <meta charset='utf-8'>
        <title>Fusebox</title>
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
    $sql = "SELECT p.profile_id, p.fname, p.lname, p.email, pr.pronouns, p.bio, p.profile_pic, p.portfolio, p.portfolio, p.website, p.instagram,  m1.major AS major1, m2.major AS major2
        FROM profile p
        INNER JOIN major m1 ON p.major_id = m1.major_id
        INNER JOIN major m2 ON p.major2_id = m2.major_id
        INNER JOIN pronoun pr ON p.pronoun_id = pr.pronoun_id
        WHERE p.profile_id =" . $_SESSION["user_id"];

    $result = $conn->query($sql);

    if(!$result) {
        echo "SQL error: ". $conn->error;
        exit();
    }
    $user = $result->fetch_assoc();
    $result = $conn->query($sql);


    if (!$result) {
        echo "SQL error: " . $conn->error;
        exit();
    }

        $user = $result->fetch_assoc(); // Fetch data

        $pfp = $user['profile_pic']; // Access profile_pic if it exists in the query

            $major1 = $user['major1']; // Accessing the data using the alias major1
            $major2 = $user['major2']; // Accessing the data using the alias major2



    closeCon($conn);

    ?>
        <div id='container'>
            <header-nav></header-nav>
<!--            <div id="outer-card">-->
<!--                <div id="border-card">-->
<!--                    <div id="profile-content">-->
<!--                        <div id="content-left">-->
<!--                            <div class='img-container'>-->
<!--                                --><?php
//                                   echo "<img src='../assets/images/chuubear.jpeg'>";
//                                ?>
<!--                            </div>-->
<!--                            <div id="major-1" class="majors">--><?php
//                                    echo $major1;
//                                ?><!--</div>-->
<!--                            <div id="major-2" class="majors">-->
<!--                                --><?php
//                                echo $major2;
//                                ?>
<!--                            </div>-->
<!--                            <div class="b2">-->
<!--                                Graduating: 2026-->
<!--                            </div>-->
<!--                            <div>Graduating: 2026</div>-->
<!--                        </div>-->
<!--                        <div id="content-right">-->
<!---->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
            <ul class='flex-btwn' id='select-menu'>
                <li class='cursor-pointer selected' value='created'>created</li>
                <li class='cursor-pointer' value='saved'>saved</li>
                <li class='cursor-pointer' value='applied'>applied</li>
            </ul>
            <div id='cards-container'></div>

        </div>
    </body>


</html>