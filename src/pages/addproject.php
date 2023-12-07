<?php
session_start();
require_once('../helpers/db-connection.php');
?>

<html>
<head>
    <meta charset='utf-8'>
    <title>Fusebox</title>
    <link rel='stylesheet' href='../styles/global.css'>
    <link rel='stylesheet' href='../styles/dashboard.css'>
    <link rel='stylesheet' href='../components/Card/card.css'>
    <link href='https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap' rel='stylesheet'>
    <script src='../components/Header/HeaderNav.js' type='text/javascript'></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <title>Add Project</title>
    <style>

        body{
            width: 100%;
        }

        .projectdetails{
            color: #BBBBBB;
            margin-top: 30px;
            margin-bottom: 10px;
            font-size: 12pt;
        }

        .projectinformation{
            display: flex;
            flex-direction: column;
            float: right;
        //border: 1px solid blue;
            margin-left: 90px;

        }

        .projectname{
            border-radius: 14px;
            border: 1px solid #BBBBBB;
            width: 520px;
            height: 35px;
        //margin-top: 60px;

        }

        .logline{
            border-radius: 14px;
            border: 1px solid #BBBBBB;
            width: 520px;
            height: 75px;
        //margin-top: 60px;
        }


        .description{
            border-radius: 14px;
            border: 1px solid #BBBBBB;
            width: 520px;
            height: 145px;
        //margin-top: 60px;
        }

        .category2{
            border-radius: 14px;
            border: 1px solid #BBBBBB;
            width: 520px;
            height: 35px;
        //margin-top: 60px;
        }

        .roles{
            border-radius: 14px;
            border: 1px solid #BBBBBB;
            width: 100px;
            height: 35px;
            color: #BBBBBB;
        //margin-top: 60px;
        }

        .projectcard{
            border: 1px solid black;
            width: 412px;
            height: 494px;
        }

        #project-details-container{
        //border: 1px solid orange;
            margin-right: 90px;
            margin-top: 5%;
            margin-bottom: 10%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        #alldathings{
            margin: auto;
            width: fit-content;
            display: flex;
            flex-direction: row;
        //border: 1px solid red;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropbtn {
            border: 1px solid #BBBBBB;
            border-radius: 14px;
            background-color: white;
            color: #BBBBBB;
            padding: 10px;
            font-size: 12pt;
            cursor: pointer; /* Add this line to make the cursor change to a pointer on hover */
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 180px;
            padding: 15px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            border-radius: 14px;
            z-index: 1;
        }

        .dropdown-content label {
            display: block;
        }

        .dropdown:active .dropdown-content {
            display: block;
        }

        .discard{
            width: fit-content;
            padding-left: 15px;
            padding-right: 15px;
            height: 35px;
            border: 1px solid #DC1F1F;
            border-radius: 30px;
            color: #DC1F1F;
            font-size: 10pt;
        }

        #discardBtn{

        }

        .save{
            width: fit-content;
            padding-left: 15px;
            padding-right: 15px;
            height: 35px;
            border: 1px solid #DC1F1F;
            border-radius: 30px;
            background-color: #DC1F1F;
            color: white;
            font-size: 10pt;
            white-space: nowrap;
        }

        .buttons{
            display: flex;
            flex-direction: row;
            gap: 30px;
            margin-top: 30px;
        }

        .buttontext{
            font-size: 8pt;
        }



    </style>

</head>

<body>
<form action = "addprojecttodb.php"
      method = "get">
<div class="outer">
    <div id='container'>
        <header-nav></header-nav>
        <div id="alldathings">
            <div id="project-details-container" class="card-project">

                <div class='card card-project'>

                    <?php
                    echo '<p class="category"> ' . 'Category' . '</p>';
                    ?>
                    <?php
                    echo '<h2> ' . 'Your Title <br> Goes Here!' . '</h2>';
                    ?>
                    <?php
                    echo '<p> ' . 'Your logline goes in here! This is a short, attention-grabbing description of your project.'. '</p>';
                    ?>
                    <br />
                    <?php
                    echo '<div class ="tags"> ';
                        echo '<p class=" tag w-fit"> ' . "Role" . '</p>';
                        echo '<p class=" tag w-fit"> ' . "Role" . '</p>';
                        echo '<p class=" tag w-fit"> ' . "Role" . '</p>';
                        echo '<p class=" tag w-fit"> ' . "Role" . '</p>';
                        echo '<p class=" tag w-fit"> ' . "Role" . '</p>';
                        echo '<p class=" tag w-fit"> ' . "Role" . '</p>';

                    echo '</div> ';
                    ?>


                </div>

                <div class = "buttons">
                    <button class = discard id="discardBtn">Discard</button>
                    <button class = save type = "submit" name = "submit">Add Project</button>

                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            // Add an event listener to the "Discard" button
                            const discardBtn = document.getElementById('discardBtn');
                            discardBtn.addEventListener('click', () => {
                                // Navigate back to dashboard.php
                                window.location.href = 'adminpanel.php';
                            });
                        });
                    </script>
                </div>



            </div>

            <div class = "projectinformation">
                <div class = "projectdetails">Project Title:</div>
                <input type = text class = "projectname" name="projectname">

                <div class = "projectdetails">Logline:</div>
                <input type = text class = "logline" name="logline">

                <div class = "projectdetails">Description:</div>
                <input type = text class = "description" name="description">

                <div class = "projectdetails">Category:</div>
                <select class="category2" class ="dropbtn" name="selectedCategory" ">
                    <button class="dropbtn"></button>
                    <div class = "dropdown-content">
                        <?php
                        $conn = openCon();
                        // Fetch all categories from the database
                        $categoriesQuery = "SELECT * FROM category";
                        $categoriesResult = $conn->query($categoriesQuery);
                        if (!$categoriesResult) {
                            echo "SQL error: " . $conn->error;
                            exit();
                        }
                        while ($categoryRow = $categoriesResult->fetch_assoc()) {
                            $categoryName = $categoryRow["category_name"];
                            $categoryId = $categoryRow["category_id"];
                            $isSelected = ($categoryName == $currentrow['category_name']) ? 'selected' : '';
                            echo "<option value='$categoryId' $isSelected>$categoryName</option>";
                        }
                        ?>
                    </div>
                </select>

                <div class = "projectdetails">Roles Needed:</div>
                <div class="dropdown">
                    <button class="dropbtn" onclick="toggleDropdown()">Select Roles</button>
                    <div class="dropdown-content" id="rolesDropdown">
                        <?php
                        // Fetch all roles from the database
                        $rolesQuery = "SELECT * FROM role";
                        $rolesResult = $conn->query($rolesQuery);

                        if (!$rolesResult) {
                            echo "SQL error: " . $conn->error;
                            exit();
                        }

                        while ($roleRow = $rolesResult->fetch_assoc()) {
                            $roleName = $roleRow["role_name"];
                            $roleId = $roleRow["role_id"];
                            echo "<label><input type='checkbox' name='selectedRoles[]' value='$roleId'>$roleName</label><br>";
                        }
                        ?>
                    </div>
                </div>

                <script>
                    function toggleDropdown() {
                        var dropdown = document.querySelector(".dropdown");
                        dropdown.classList.toggle("active");
                    }

                    // Close the dropdown if the user clicks outside of it
                    window.onclick = function(event) {
                        if (!event.target.matches('.dropbtn')) {
                            var dropdowns = document.getElementsByClassName("dropdown");
                            for (var i = 0; i < dropdowns.length; i++) {
                                var openDropdown = dropdowns[i];
                                if (openDropdown.classList.contains('active')) {
                                    openDropdown.classList.remove('active');
                                }
                            }
                        }
                    }


                </script>
                </div>

            </div>


        </div>
    </div>
</div>
</form>

</body>

</html>