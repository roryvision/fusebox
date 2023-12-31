<?php
session_start();

require_once(__DIR__ . '/../../helpers/db-connection.php');
$conn = openCon();

//check for user_id value, if it is set,
//if (!isset($_SESSION["user_id"])) {
//    die();
//}

//for Hello, name
//$sql = sprintf("SELECT * FROM profile
//                    WHERE email = '%s'", //%s placeholder
//    //avoid sql attack
//    $conn->real_escape_string($_GET["email"]));
//$result = $conn->query($sql);
////grab user data in array
//if(!$result) {
//    echo "SQL error: ". $conn->error;
//    exit();
//}
//$user = $result->fetch_assoc();


?>

<!DOCTYPE html>
<html>
    <head>
        <title>Onboarding</title>
        <link rel="stylesheet" href="../../styles/global.css">
        <link rel="stylesheet" href="../../styles/onboarding.css">

<!--        <script src='onboard.js' type='text/javascript'></script>-->
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const buttons = document.querySelectorAll('[data-onboard-target]');

                buttons.forEach((button) => {
                    button.addEventListener('click', function () {
                        const targetId = button.getAttribute('data-onboard-target');
                        const currentOnboard = document.querySelector('.step-card.show');
                        const nextOnboard = document.getElementById(targetId);

                        if (currentOnboard && nextOnboard) {
                            currentOnboard.classList.remove('show');
                            nextOnboard.classList.add('show');
                        }
                    });
                });
            });
        </script>

    </head>
    <body>
        <div id='container'>
            <form method="post" action="sql_injection.php" enctype="multipart/form-data">
                <div id="onboard-1" class="step-card show">
                    <img src="../../assets/icons/icon_profile.svg" alt="profile icon">
                    <h1>Hello!</h1>
    <!--                <h1>Hello, --><?php //= htmlspecialchars($user["fname"]) ?><!--</h1>-->
                    <p class="center">Help us set up your business card to show your peers by answering the next few questions.</p>
                        <input type="button" value="Next" class="button" id="click-1" data-onboard-target="onboard-2">
                </div>


                <div id="onboard-2" class="step-card">
                    <h1>What's your major?</h1>
                    <label for="major1">Major 1</label><br>
                    <select name="major1" id="major1">
                        <option value="NULL">Select a major</option>
                        <?php

                        $sql = "SELECT * FROM major";

                        $results = $conn->query($sql);

                        if(!$results) {
                            echo "SQL error: ". $conn->error;
                            exit();
                        }

                        while($currentrow = $results->fetch_assoc()) {
                            echo "<option value='" . $currentrow['major_id'] . "'>" . $currentrow['major'] . "</option>";
                        }
                        ?>
                    </select>

                    <br>

                    <label for="major2">Major 2</label><br>
                    <select name="major2" id="major2">
                        <option value="NULL">None</option>
                        <?php

                        $sql = "SELECT * FROM major";

                        $results = $conn->query($sql);

                        if(!$results) {
                            echo "SQL error: ". $conn->error;
                            exit();
                        }

                        while($currentrow = $results->fetch_assoc()) {
                            echo "<option value='" . $currentrow['major_id'] . "'>" . $currentrow['major'] . "</option>";
                        }
                        ?>
                    </select>
                    <br>
                        <input type="button" value="Next" class="button" id="click-2" data-onboard-target="onboard-3">
                </div>

                <div id="onboard-3" class="step-card">
                    <h1>What do you do?</h1>
                    <label for="primaryRole">Primary</label><br>
                    <select name="primaryRole" id="primaryRole">
                        <option value="NULL">Select your primary role.</option>
                        <?php

                        $sql = "SELECT * FROM role";

                        $results = $conn->query($sql);

                        if(!$results) {
                            echo "SQL error: ". $conn->error;
                            exit();
                        }

                        while($currentrow = $results->fetch_assoc()) {
                            echo "<option value='" . $currentrow['role_id'] . "'>" . $currentrow['role_type'] . ": " . $currentrow['role_name'] . "</option>";
                        }
                        ?>
                    </select>

                    <br>

                    <label for="secondaryRole">Secondary</label><br>
                    <select name="secondaryRole" id="secondaryRole">
                        <option value="NULL">Select your secondary role.</option>
                        <?php

                        $sql = "SELECT * FROM role";

                        $results = $conn->query($sql);

                        if(!$results) {
                            echo "SQL error: ". $conn->error;
                            exit();
                        }

                        while($currentrow = $results->fetch_assoc()) {
                            echo "<option value='" . $currentrow['role_id'] . "'>" . $currentrow['role_type'] . ": " . $currentrow['role_name'] . "</option>";
                        }
                        ?>
                    </select>

                    <br>
                    <label for="tertiaryRole">Tertiary</label><br>
                    <select name="tertiaryRole" id="tertiaryRole">
                        <option value="NULL">Select your tertiary role.</option>
                        <?php

                        $sql = "SELECT * FROM role";

                        $results = $conn->query($sql);

                        if(!$results) {
                            echo "SQL error: ". $conn->error;
                            exit();
                        }

                        while($currentrow = $results->fetch_assoc()) {
                            echo "<option value='" . $currentrow['role_id'] . "'>" . $currentrow['role_type'] . ": " . $currentrow['role_name'] . "</option>";
                        }
                        ?>
                    </select>
                    <br>

                        <input type="button" value="Next" class="button" id="click-3" data-onboard-target="onboard-4">

                </div>

    <!--            <div id="onboard-4" class="step-card">-->
    <!--                <h1>What are your skills?</h1>-->
    <!--                <label for="primarySkill">Primary</label><br>-->
    <!--                <select name="primarySkill" id="primarySkill">-->
    <!--                    <option value="NULL">Select your primary skill.</option>-->
    <!--                    --><?php
    //
    //                    $sql = "SELECT * FROM skill";
    //
    //                    $results = $conn->query($sql);
    //
    //                    if(!$results) {
    //                        echo "SQL error: ". $conn->error;
    //                        exit();
    //                    }
    //
    //                    while($currentrow = $results->fetch_assoc()) {
    //                        echo "<option value='" . $currentrow['skill_id'] . "'>" . $currentrow['skills'] . "</option>";
    //                    }
    //                    ?>
    <!--                </select>-->
    <!---->
    <!--                <br>-->
    <!---->
    <!--                <label for="secondarySkill">Secondary</label><br>-->
    <!--                <select name="secondarySkill" id="secondarySkill">-->
    <!--                    <option value="NULL">Select your secondary skill.</option>-->
    <!--                    --><?php
    //
    //                    $sql = "SELECT * FROM skill";
    //
    //                    $results = $conn->query($sql);
    //
    //                    if(!$results) {
    //                        echo "SQL error: ". $conn->error;
    //                        exit();
    //                    }
    //
    //                    while($currentrow = $results->fetch_assoc()) {
    //                        echo "<option value='" . $currentrow['skill_id'] . "'>" . $currentrow['skills'] . "</option>";
    //                    }
    //                    ?>
    <!--                </select>-->
    <!---->
    <!--                <br>-->
    <!--                <label for="tertiarySkill">Tertiary</label><br>-->
    <!--                <select name="tertiarySkill" id="tertiarySkill">-->
    <!--                    <option value="NULL">Select your tertiary skill.</option>-->
    <!--                    --><?php
    //
    //                    $sql = "SELECT * FROM skill";
    //
    //                    $results = $conn->query($sql);
    //
    //                    if(!$results) {
    //                        echo "SQL error: ". $conn->error;
    //                        exit();
    //                    }
    //
    //                    while($currentrow = $results->fetch_assoc()) {
    //                        echo "<option value='" . $currentrow['skill_id'] . "'>" . $currentrow['skills'] . "</option>";
    //                    }
    //                    ?>
    <!--                </select>-->
    <!--                <br>-->
    <!--                    <input type="button" value="Next" class="button" id="click-34" data-onboard-target="onboard-5">-->
    <!--            </div>-->

                <div id="onboard-4" class="step-card">
                    <h1>What year do you expect to graduate?</h1>
                    <label for="gradyear"></label>
                    <input type="text" name="gradyear" placeholder="20XX">
                        <input type="button" value="Next" class="button" id="click-4" data-onboard-target="onboard-5">

                </div>

                <div id="onboard-5" class="step-card">
                    <h1>Fine tune your profile.</h1>
                    <p class="center">Navigate to your account profile to add a profile picture, skills, and more.</p>
                        <input type="button" value="Next" class="button" id="click-5" data-onboard-target="onboard-6">

                </div>

                <div id="onboard-6" class="step-card">
                    <img src="../../assets/icons/icon_profile.svg" alt="profile icon">
                    <h1>Welcome to Fusebox!</h1>
    <!--                <h1>Welcome to Fusebox, --><?php //= htmlspecialchars($user["fname"]) ?><!--</h1>-->
                    <div>
                    <input type="submit" value="Start Browsing Projects"  id="click-6" class='button1'>
    <!--                    <a href="../dashboard.php"><input type="submit" value="Start Browsing Projects"  id="click-7"></a>-->
                    </div>
                </div>

            </form>
        </div>
    </body>
</html>
<?php closeCon($conn);?>