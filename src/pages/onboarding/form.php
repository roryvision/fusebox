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

        <script>
            //event listener on all ids starting with "click"
            //onclick:
            //set a variable = id name step EX: let stepId = this.id.splitafter"_"
            //remove.show class from["onboard-" . stepId] EX: lookforthis =onboard-stepId;
            //add show class to ["onboard-" . stepId] EX: $(lookforthis).addClass(show);

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
                <img src="../../assets/icons/icon_profile.svg" alt="profile icon" class='margin-auto'>
                <h1>Hello!</h1>
<!--                <h1>Hello, --><?php //= htmlspecialchars($user["fname"]) ?><!--</h1>-->
                <p>Help us set up your business card to show your peers by answering the next few questions.</p>
                <br>                  
                <input type="button" value="Next" class="button" id="click-1" data-onboard-target="onboard-2">
            </div>

            <div id="onboard-2" class="step-card">
                <h1>What's your major?</h1>
                <label for="major">Major 1</label><br>
                <select name="major" id="major">
                    <option value="ALL">Select a major</option>
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
                    <option value="null">None</option>
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
                <label for="primary-role">Primary</label><br>
                <select name="primary" id="primary">
                    <option value="none">Select your primary role.</option>
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

                <label for="secondary">Secondary</label><br>
                <select name="secondary-role" id="secondary">
                    <option value="none">Select your secondary role.</option>
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
                <label for="tertiary">Tertiary</label><br>
                <select name="tertiary-role" id="tertiary">
                    <option value="none">Select your tertiary role.</option>
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

            <div id="onboard-4" class="step-card">
                <h1>What are your skills?</h1>
                <label for="-skill">Primary</label><br>
                <select name="primary" id="primary">
                    <option value="none">Select your primary skill.</option>
                    <?php

                    $sql = "SELECT * FROM skill";

                    $results = $conn->query($sql);

                    if(!$results) {
                        echo "SQL error: ". $conn->error;
                        exit();
                    }

                    while($currentrow = $results->fetch_assoc()) {
                        echo "<option value='" . $currentrow['skill_id'] . "'>" . $currentrow['skills'] . "</option>";
                    }
                    ?>
                </select>

                <br>

                <label for="secondary-skill">Secondary</label><br>
                <select name="secondary" id="secondary">
                    <option value="none">Select your secondary skill.</option>
                    <?php

                    $sql = "SELECT * FROM skill";

                    $results = $conn->query($sql);

                    if(!$results) {
                        echo "SQL error: ". $conn->error;
                        exit();
                    }

                    while($currentrow = $results->fetch_assoc()) {
                        echo "<option value='" . $currentrow['skill_id'] . "'>" . $currentrow['skills'] . "</option>";
                    }
                    ?>
                </select>

                <br>
                <label for="tertiary-skill">Tertiary</label><br>
                <select name="tertiary" id="tertiary">
                    <option value="none">Select your tertiary skill.</option>
                    <?php

                    $sql = "SELECT * FROM skill";

                    $results = $conn->query($sql);

                    if(!$results) {
                        echo "SQL error: ". $conn->error;
                        exit();
                    }

                    while($currentrow = $results->fetch_assoc()) {
                        echo "<option value='" . $currentrow['skill_id'] . "'>" . $currentrow['skills'] . "</option>";
                    }
                    ?>
                </select>
                <br>
                <input type="button" value="Next" class="button" id="click-34" data-onboard-target="onboard-5">
            </div>

            <div id="onboard-5" class="step-card">
                <h1>What year do you expect to graduate?</h1>
                <label for="gradyear"></label>
                <input type="text" name="gradyear" placeholder="20XX">
                <input type="button" value="Next" class="button" id="click-5" data-onboard-target="onboard-6">
            </div>

            <div id="onboard-6" class="step-card">
                <h1>Remember to upload a profile picture!</h1>
                <p>Navigate to your account profile to add a profile picture.</p>                    <input type="button" value="Next" class="button" id="click-6" data-onboard-target="onboard-7">
            </div>

            <div id="onboard-7" class="step-card">
                <img src="../../assets/icons/icon_profile.svg" alt="profile icon" class='margin-auto'>
                <h1>Welcome to Fusebox!</h1>
<!--                <h1>Welcome to Fusebox, --><?php //= htmlspecialchars($user["fname"]) ?><!--</h1>-->

                <div style='position: absolute; bottom: 80px;'>
                    <a href="../dashboard.php"><input type="submit" value="Start Browsing Projects" class="button1" id="click-7"></a>
                    <a href="../dashboard.php"><input type="submit"  value="Create a Project" class="button2" id="click-8">
                </div>
            </div>
        </div>
        </form>
    </body>
</html>
<?php closeCon($conn);?>

