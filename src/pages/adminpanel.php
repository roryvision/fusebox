<?php
session_start();
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

        .popupbuttons{
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .button-apply {
            margin: 12px 0px;
            padding: 6px 10px;
            cursor: pointer;
            width: 275px;
            font-family: 'Poppins';
            font-weight: 400;
            font-size: 16px;
            background-color: #F8625A;
            color: white;
            border-radius: 20px;
            list-style: none;
            text-align: center;
        }

        .apply-buttons{
            margin:auto;
        }

        .button-apply:hover {
            filter: brightness(85%);
        }

        .center{
            text-align: center;
            font-size: 18pt;
        }

        #red-role{
            color: #DC1F1F;
        }

        .project-name{
            font-size: 34pt;
            font-family: 'Visby';
            margin: auto;
            margin-top: 20px;
            text-align: center;
        }

        .project-category{
            color: #BBBBBB;
            margin: auto;
            text-align: center;
        }

        .project-details{
            display: flex;
            flex-direction: row;
            align-items: flex-start;
            justify-content: center;
            margin-top: 35px;
            gap: 80px;
        }

        .project-description{
            width: 800px;
            border-radius: 50px 0px 50px 50px;
            outline: 1px solid #BAB3A6;
            display: block;
        }

        .description-text{
            padding: 34px;
            padding-left: 37px;
            font-size: 13pt;
        }

        .apply-buttons{
            display: block;
        }

        .creator{
            color: #BBBBBB;
            font-size: 12pt;
            margin-bottom: 25px;
        }

        /*for apply modal*/
        #modal-1{
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 50px 85px;
            padding-right: 70px;
            border-radius: 32px 0px 32px 32px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            z-index: 2;
            display: none;
        }

        #prompt{
            margin: 0px;
            margin-bottom: 40px;
            display: block;
        }

        #form{
            margin: 20px 0px;
            padding: 10px;
            display: none;
            border-radius: 20px;
            outline: 1px solid #BAB3A6;
        }

        #email-message{
            font-size: 12pt;
            font-family: 'Poppins';
            width: 100%;
            height: 100%;
            border: none;
            outline: none;
        }

        #note-buttons{
            display:flex;
            flex-direction: row;
            justify-content: flex-end;
            align-items: center;
            gap: 12px;
        }

        #form-buttons{
            display:none;
            flex-direction: row;
            justify-content: flex-end;
            align-items: center;
            gap: 16px;
        }

        #modal-text{
            margin: 0px;
            display: block;
        }

        #congrats{
            display:none;
            margin: 0px;
            margin-bottom: 10px;
        }

        .modal-title{
            font-family: 'Visby';
            font-size: 25pt;

        }

        #add-note{
            color: #DC1F1F;
            border: #DC1F1F 2px solid;
            border-radius: 20px;
            padding: 5px 15px;
        }

        #no-note{
            color: white;
            background-color: #DC1F1F;
            border: #DC1F1F 2px solid;
            border-radius: 20px;
            padding: 5px 15px;
        }

        #cancel{
            color: black;
        }

        #send{
            color: white;
            background-color: #DC1F1F;
            border: #DC1F1F 2px solid;
            border-radius: 20px;
            padding: 5px 15px;
        }

        #modal-icon{
            width: 35px;
        }

        #overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1;
            display: none;
        }

    </style>

</head>

<body>
<div id='container'>
    <header-nav></header-nav>
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
    </button>

    <script>
        function closeModal() {
            var modal = document.getElementById('myModal');
            modal.style.display = 'none';
        }

        let projectId = '$_REQUEST_';

        document.getElementById('editButton').addEventListener('click', function () {
            // Change the window location to your edit page URL
            window.location.href = '../fusebox/src/pages/editproject.php?id=' + projectId;
        });

        document.getElementById('deleteButton').addEventListener('click', function () {
            // Change the window location to your edit page URL
            window.location.href = '../fusebox/src/pages/deleteprojectindb.php';
        });
    </script>
</div>
</body>
</html>