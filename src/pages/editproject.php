<?php
session_start();
require_once('../helpers/db-connection.php');
?>

<html>
<head>
    <meta charset='utf-8'>
    <title>Edit Project</title>
    <link rel='stylesheet' href='../styles/global.css'>
    <link rel='stylesheet' href='../styles/dashboard.css'>
    <link rel='stylesheet' href='../components/Card/card.css'>
    <link href='https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap' rel='stylesheet'>
    <script src='../components/Header/HeaderNav.js' type='text/javascript'></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src='../pages/dashboard.js' type='module'></script>
    <script src='../pages/adminpanel.js' type='module'></script>

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

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .discardedits{
            width: fit-content;
            padding-left: 15px;
            padding-right: 15px;
            height: 35px;
            border: 1px solid #DC1F1F;
            border-radius: 30px;
            color: #DC1F1F;
            font-size: 10pt;
        }

        .saveedits{
            width: fit-content;
            padding-left: 15px;
            padding-right: 15px;
            height: 35px;
            border: 1px solid #DC1F1F;
            border-radius: 30px;
            color: #DC1F1F;
            font-size: 10pt;
            white-space: nowrap;
        }

        .deleteproject{
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
            gap: 10px;
            margin-top: 30px;

        }



    </style>

</head>

<body>
<a href="editproject.php?id=<?php echo $projectId; ?>">Edit Project</a>

    <form action="editprojectindb.php"
          method ="get">
        <input type="hidden" name="id" value="<?php echo $projectId; ?>">


        <div class="outer">
            <div id='container'>
                <header-nav></header-nav>
                <div id="alldathings">
                    <div id="project-details-container" class="card-project">
                        <?php
                        $conn = openCon();

                        $projectId = isset($_GET['id']) ? $_GET['id'] : null;

                        if ($projectId === null) {
                            echo "Error: Project ID is not set.";
                            exit();
                        }

                        $sql = "SELECT p.project_id, p.project_name, p.logline, c.category_name, p.description
                          FROM project AS p
                          LEFT JOIN category AS c ON p.category_id = c.category_id
                          WHERE project_id = " . $_REQUEST["id"];

                        $results = $conn->query($sql);
                        $currentrow = $results->fetch_assoc();

                        if(!$results) {
                            echo "SQL error: ". $conn->error;
                            exit();
                        }
                        ?>

                        <div class='card card-project'>

                            <?php
                            echo '<p class="category"> ' . $currentrow['category_name'] . '</p>';
                            ?>
                            <?php
                            echo '<h2> ' . $currentrow['project_name'] . '</h2>';
                            ?>
                            <?php
                            echo '<p> ' . $currentrow['logline'] . '</p>';
                            ?>
                            <br />
                            <?php
                            $role_sql = "SELECT role_name
                  FROM projects_x_roles AS pxr
                  LEFT JOIN role AS r ON pxr.role_id = r.role_id
                  WHERE " . $currentrow['project_id'] . " = pxr.project_id";

                            $role_results = $conn->query($role_sql);

                            $roles = array(); // Reset roles for each project

                            while ($role_row = $role_results->fetch_assoc()) {
                                $roles[] = $role_row['role_name'];
                            }

                            echo '<div class ="tags"> ';
                            // Display the roles
                            foreach ($roles as $role) {
                                echo '<p class=" tag w-fit"> ' . $role . '</p>';
                            };

                            echo '</div> ';


                            ?>

                        </div>

                        <div class = "buttons">
                            <button class = "deleteproject" id = "deleteBtn">Delete</button>
                            <button class = "discardedits" id="discardBtn">Discard</button>
                            <button class = "saveedits" type = "submit" name = "submit">Save Changes</button>


                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    // Add an event listener to the "Discard" button
                                    const discardBtn = document.getElementById('discardBtn');

                                    discardBtn.addEventListener('click', () => {
                                        // Navigate back to dashboard.php
                                        window.location.href = 'adminpanel.php';
                                    });


                                });

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
            <input type = text class = "projectname" name="projectname" value="<?php echo
            $currentrow['project_name']
            ?>">

            <div class = "projectdetails">Logline:</div>
            <input type = text class = "logline" name="logline" value="<?php echo
            $currentrow['logline']
            ?>">

            <div class = "projectdetails">Description:</div>
            <input type = text class = "description" name="description" value="<?php echo
            $currentrow['description']
            ?>">

            <div class = "projectdetails">Category:</div>
            <select class="category2" class ="dropbtn" name="selectedCategory">
                <button class="dropbtn">Select Roles</button>
                <div class = "dropdown-content">
                    <?php
                    // Fetch all categories from the database
                    $categoriesQuery = "SELECT * FROM category";
                    $categoriesResult = $conn->query($categoriesQuery);

                    if (!$categoriesResult) {
                        echo "SQL error: " . $conn->error;
                        exit();
                    }

                    while ($categoryRow = $categoriesResult->fetch_assoc()) {
                        $categoryName = $categoryRow["category_name"];
                        $isSelected = ($categoryName == $currentrow['category_name']) ? 'selected' : '';

                        echo "<option value='$categoryName' $isSelected>$categoryName</option>";
                    }
                    ?>
                </div>
            </select>

            <div class = "projectdetails">Roles Needed:</div>
            <div class="dropdown">
                <button class="dropbtn">Select Roles</button>
                <div class="dropdown-content">
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
                        $isChecked = in_array($roleName, $roles) ? 'checked' : '';

                        echo "<input type='checkbox' name='selectedRoles[]' value='$roleName' $isChecked> $roleName<br>";
                    }
                    ?>
                </div>
            </div>

        </div>




        </div>
    </div>
</div>
    </form>

</body>

</html>