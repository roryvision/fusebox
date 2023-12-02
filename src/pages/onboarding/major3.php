<?php
require_once(__DIR__ . '/../../helpers/db-connection.php');

//shows if user is logged in or not
if (isset($_SESSION["user_id"])) {
//then retrieve user record from db
    $conn = openCon();
// Fetching majors from the 'major' table
$sql_major = "SELECT major_id, major FROM major";
$result_major = $conn->query($sql_major);

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
                <?php
                while ($row = $result_major->fetch_assoc()) {
                    echo "<option value='{$row['major_id']}'>{$row['major_name']}</option>";
                }
                ?>
            </select>

            <br>

            <label for="major2">Select Major 2:</label>
            <select name="major2" id="major2">
                <option value="">None</option>
                <?php
                // Resetting the result pointer to the beginning of the majors
                $result_major->data_seek(0);
                while ($row = $result_major->fetch_assoc()) {
                    echo "<option value='{$row['major_id']}'>{$row['major_name']}</option>";
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


