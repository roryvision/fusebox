<?php
session_start();
require_once('../helpers/db-connection.php');
?>

<!DOCTYPE html>
<html lang='en' dir='ltr'>
<head>
    <meta charset='utf-8'>
    <title>Fusebox</title>
    <meta name="description" content="Connecting to create.">
    <link rel='stylesheet' href='../styles/global.css'>
    <link rel='stylesheet' href='../styles/dashboard.css'>
    <link rel='stylesheet' href='../components/Card/card.css'>
    <link href='https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap' rel='stylesheet'>
    <script src='../components/Header/HeaderNav.js' type='text/javascript'></script>
    <script src='../components/Card/CardProject.js' type='text/javascript'></script>
    <script src='../components/Card/CardPerson.js' type='text/javascript'></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../helpers/CardHelper.js" type='module'></script>
    <script src='../pages/adminpanel.js' type='module'></script>

    <style>
        #myModal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            padding-top: 200px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            padding: 20px;
            padding-: 20px;
            padding: 20px;
            width: 9%;
            border-radius: 25px;
            box-shadow: 0px 4px 14px 0px rgba(0, 0, 0, 0.25);
        }

        .editbutton{
            width: fit-content;
            padding-left: 15px;
            padding-right: 15px;
            height: 35px;
            border: 1px solid #DC1F1F;
            border-radius: 30px;
            color: #DC1F1F;
            font-size: 10pt;
        }

        .deletebutton{
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

        #editButton{

        }

        #deleteButton{

        }

        .popupbuttons{
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .center{
            text-align: center;
            font-size: 18pt;
        }
]
        .admin{
            font-family: Visby;
            font-weight: 500;
            color: #EFEFEF;
            font-size: 22pt;
        }

        #adminname{
            font-family: Visby;
            font-weight: 500;
        }

        #adminpronouns{
            color: #878787;
            font-family: Poppins;
            font-size: 14px;
            font-style: italic;
            font-weight: 50;
            line-height: normal;
        }


        .text-container{
            text-align: left;
            margin-top: 20px;
        }

        .center{
            width: fit-content;
            margin: auto;
            margin-top: 50px;
            margin-bottom: 80px;
        }

        #dontdisplay {
            /*display: none;*/
            /*border: none;*/
            display: flex;
            flex-direction: row;
            gap: 130px;
        }

        .img-container{
            width: 5px;
        }

        img{
            width: 5px;
        }


    </style>

</head>

<body>
<form>
<div id='container'>
    <header-nav></header-nav>

    <?php
        $conn = openCon();
        $sql = "SELECT fname, lname, pronouns
                FROM profile, pronoun
                WHERE profile.pronoun_id=pronoun.pronoun_id";

    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        // Fetch the data from the result set
        $currentrow = $result->fetch_assoc();
    };

    echo "<div class='container'>";
    echo "<div class='center'>";
    echo "<div id = 'dontdisplay';>";
    echo "<div class='img-container'>
        <img src='/acad276/fusebox/src/assets/images/chuubear.jpeg' alt='Profile photo'>
      </div>";
    echo "<div class='text-container'>";
    echo '<h2 class="admin">' . 'Admin' . '</h2>';
    echo '<p class="name" id="adminname"> ' . $currentrow['fname'] . " " . $currentrow['lname'] . '</p>';
    echo '<p class="pronouns" id = "adminpronouns"> ' . $currentrow['pronouns'] . '</p>';
    echo "</div>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
    ?>

    <ul class='flex-btwn' id='select-menu'>
        <li class='cursor-pointer selected' value='projects'>projects</li>
        <li class='cursor-pointer' value='people'>people</li>
    </ul>

    <br />

        <div id='cards-container'>
        </div>


    <!-- The Modal -->
    <div id="myModal" class="modal">
        <!-- Modal content -->
        <div class="modal-content">
            <span onclick="closeModal()" style="float: right; cursor: pointer;">&times;</span>
            <!-- Add your modal content here -->
            <div class = "popupbuttons">
                <button id = "editButton" class = "editbutton">Edit Project</button>
                <button class = "deletebutton">Delete Project</button>
            </div>
        </div>
    <script>
        function closeModal() {
            var modal = document.getElementById('myModal');
            modal.style.display = 'none';
        }

        document.getElementById('deleteButton').addEventListener('click', function () {
            // Change the window location to your edit page URL
            window.location.href = '../fusebox/src/pages/deleteprojectindb.php';
        });
    </script>
</div>
</form>
</body>
</html>