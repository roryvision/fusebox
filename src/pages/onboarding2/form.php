<?php
require_once(__DIR__ . '/../../helpers/db-connection.php');

//shows if user is logged in or not
//either starts new session or resumes existing one
session_start();

$conn = openCon();

//check for user_id value, if it is set,
//if (!isset($_SESSION["user_id"])) {
//    die();
//}
$sql = sprintf("SELECT * FROM profile
                    WHERE email = '%s'", //%s placeholder
    //avoid sql attack
    $conn->real_escape_string($_POST["email"]));

$result = $conn->query($sql);
//grab user data in array
if(!$result) {
    echo "SQL error: ". $conn->error;
    exit();
}
$user = $result->fetch_assoc();


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
            $(document).ready(function () {
                // Hide all step cards except the first one
                $('[id^="onboard-"]').not(':first').addClass('hide');

                // Event listener for all elements with ids starting with "click"
                $('[id^="click"]').on('click', function () {
                    // Extract the step number from the clicked element's id
                    let stepId = this.id.split('-')[1];

                    // Hide the current step
                    $('#onboard-' + stepId).removeClass('show').addClass('hide');

                    // Show the next step
                    let nextStepId = parseInt(stepId) + 1;
                    $('#onboard-' + nextStepId).removeClass('hide').addClass('show');
                });
            });
        </script>

    </head>
    <body>
        <form>
            <div id="onboard-1" class="step-card show">
                <img src="../../assets/icons/icon_profile.svg" alt="profile icon">
                <h1>Welcome to Fusebox, <?= htmlspecialchars($user["fname"]) ?></h1>

                <p>Help us set up your business card to show your peers by answering the next few questions.</p>
                <div class="button">
                    <input type="submit" value="Next" class="button" id="click-1">
                </div>
            </div>

<!--            <div id="onboard-2" class="step-card hide">-->
<!--                <h1>The best place to find your dream team</h1>-->
<!--                <div class="button">-->
<!--                    <input type="submit" value="Next" class="button" id="click-2">-->
<!--                </div>-->
<!--            </div>-->

            <div id="onboard-2" class="step-card hide">
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
                        echo "<option>" . $currentrow['major'] . "</option>";
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
                        echo "<option>" . $currentrow['major'] . "</option>";
                    }
                    ?>
                </select>
                <br>
                <div class="button">
                    <input type="submit" value="Next" class="button" id="click-2">
                </div>
            </div>

            <div id="onboard-3" class="step-card hide">
                <h1>What year do you expect to graduate?</h1>
                <label for="gradyear"></label>
                <input type="text" name="gradyear" placeholder="20XX">
                <div class="button">
                    <input type="submit" value="Next" class="button" id="click-3">
                </div>
            </div>

            <div id="onboard-4" class="step-card hide">
                <h1>What do you do?</h1>
                <p style="text-align: center;">You can change this anytime.</p>
                <ul>
                    <label for='role-tech'>Tech</label>
                        <ul>
                            <li><input type='checkbox' id='role-frontend' name='role-frontend' value='frontend'/>
                                <label for='role-frontend'>Frontend</label></li>
                            <li><input type='checkbox' id='role-backend' name='role-backend' value='backend'/>
                                <label for='role-backend'>Backend</label></li>
                            <li><input type='checkbox' id='role-fullstack' name='role-fullstack' value='fullstack'/>
                                <label for='role-fullstack'>Full Stack</label></li>
                            <li><input type='checkbox' id='role-uiux' name='role-uiux' value='uiux'/>
                                <label for='role-uiux'>UI/UX</label></li>
                            <li><input type='checkbox' id='role-engineer' name='role-engineer' value='engineer'/>
                                <label for='role-engineer'>Engineer</label></li>
                            <li><input type='checkbox' id='role-cybersecurity' name='role-cybersecurity' value='cybersecurity'/>
                                <label for='role-cybersecurity'>Cybersecurity</label></li>
                        </ul>

                    <label for='role-visual'>Visual</label>
                        <ul>
                            <li><input type='checkbox' id='role-graphic' name='role-graphic' value='graphic'/>
                                <label for='role-graphic'>Graphic Designer</label></li>
                            <li><input type='checkbox' id='role-artist' name='role-artist' value='artist'/>
                                <label for='role-artist'>Artist</label></li>
                            <li><input type='checkbox' id='role-photographer' name='role-photographer' value='photographer'/>
                                <label for='role-photographer'>Photographer</label></li>
                            <li><input type='checkbox' id='role-3d' name='role-3d' value='3d'/>
                                <label for='role-3d'>3D Modeler</label></li>
                            <li><input type='checkbox' id='role-fashion' name='role-fashion' value='fashion'/>
                                <label for='role-fashion'>Fashion</label></li>
                        </ul>

                    <label for='role-business'>Business</label>
                        <ul>
                            <li><input type='checkbox' id='role-marketing' name='role-marketing' value='marketing'/>
                                <label for='role-marketing'>Marketing</label></li>
                            <li><input type='checkbox' id='role-financial' name='role-financial' value='financial'/>
                                <label for='role-financial'>Financial</label></li>
                            <li><input type='checkbox' id='role-product' name='role-product' value='product'/>
                                <label for='role-product'>Product Manager</label></li>
                            <li><input type='checkbox' id='role-project' name='role-project' value='project'/>
                                <label for='role-project'>Project Manager</label></li>
                            <li><input type='checkbox' id='role-analyst' name='role-analyst' value='analyst'/>
                                <label for='role-analyst'>Analyst</label></li>
                            <li><input type='checkbox' id='role-pr' name='role-pr' value='pr'/>
                                <label for='role-pr'>Public Relations</label></li>
                        </ul>

                    <label for='role-film'>Film</label>
                        <ul>
                            <li><input type='checkbox' id='role-cinematographer' name='role-cinematographer' value='cinematographer'/>
                                <label for='role-cinematographer'>Cinematographer</label></li>
                            <li><input type='checkbox' id='role-sound' name='role-sound' value='sound'/>
                                <label for='role-sound'>Sound</label></li>
                            <li><input type='checkbox' id='role-editor' name='role-editor' value='editor'/>
                                <label for='role-editor'>Editor</label></li>
                            <li><input type='checkbox' id='role-pa' name='role-pa' value='pa'/>
                                <label for='role-pa'>Production Assistant</label></li>
                        </ul>


                    <label for='role-performing'>Performing</label>
                        <ul>
                            <li><input type='checkbox' id='role-actor' name='role-actor' value='actor'/>
                                <label for='role-actor'>Actor</label></li>
                            <li><input type='checkbox' id='role-dancer' name='role-dancer' value='dancer'/>
                                <label for='role-dancer'>Dancer</label></li>
                            <li><input type='checkbox' id='role-musician' name='role-musician' value='musician'/>
                                <label for='role-musician'>Musician</label></li>
                        </ul>

                    <label for='role-general'>General</label>
                        <ul>
                            <li><input type='checkbox' id='role-writer' name='role-writer' value='writer'/>
                                <label for='role-writer'>Writer</label></li>
                            <li><input type='checkbox' id='role-event' name='role-event' value='event'/>
                                <label for='role-event'>Event Planner</label></li>
                            <li><input type='checkbox' id='role-other' name='role-other' value='other' />
                                <label for='role-other'>Other</label></li>
                        </ul>

                </ul>
                <br>
                <div class="button">
                    <input type="submit" value="Next" class="button" id="click-4">
                </div>
            </div>

            <div id="onboard-5" class="step-card hide">
                <h1>What are you good at?</h1>
                <p>You can change this at any time</p>
                <input type="text" placeholder="20XX">
                <div class="button">
                    <input type="submit" value="Next" class="button" id="click-5">
                </div>
            </div>

        </form>
    </body>
</html>
<?php closeCon($conn);?>

