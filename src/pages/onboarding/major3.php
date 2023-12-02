<?php
require_once(__DIR__ . '/../../helpers/db-connection.php');

//shows if user is logged in or not
//either starts new session or resumes existing one
session_start();

//shows if user is logged in or not
if (isset($_SESSION["user_id"])) {
//then retrieve user record from db
    $conn = openCon();
//user data
    $sql = "SELECT * FROM profile
          WHERE id = {$_SESSION["user_id"]}";
    $result = $conn->query($sql);
//associative array with record values
    $user = $result->fetch_assoc();


// form submission check??
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get selected majors from the form
    $selected_major = $_POST['major'];
    $selected_major2 = isset($_POST['major2']) ? $_POST['major2'] : null;

    // Insert into the 'profile' table
    $sql_insert = "UPDATE profile SET major_id = $selected_major, major2_id = " . ($selected_major2 !== null ? $selected_major2 : "NULL") . " WHERE email " . $_REQUEST["email"];
    $conn->query($sql_insert);

    echo "Profile updated successfully!";
}


$conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Intro Onboarding</title>
        <meta charset="UTF-8">
        <meta name="description" content="description of page goes here">
        <meta name="keywords" content="keywords go here"> <!--      keep it under 200 words  -->
        <link rel="stylesheet" href="/src/styles/global.css" type="text/css">
        <link rel="stylesheet" href="/src/styles/onboarding.css" type="text/css">
    </head>
    <body>

        <img src="../../assets/icons/icon_profile.svg">
        <h1>What's your major?</h1>


        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="major">Select Major:</label>
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

            <label for="major2">Select Major 2:</label>
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
                <input type="submit" value="Log In" class="button">
            </div>
        </form>

</body>
</html>


