<?php
session_start();
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

    <title>Edit Project</title>
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

        .category{
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

        }

        #alldathings{
            margin: auto;
            width: fit-content;
            display: flex;
            flex-direction: row;
        }


    </style>

</head>

<body>
<div class="outer">
    <div id='container'>
        <header-nav></header-nav>
        <div id="alldathings">
            <div id="project-details-container" class="card-project">
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        const urlParams = new URLSearchParams(window.location.search);
                        const projectId = urlParams.get('id');

                        // Fetch project details based on projectId and update the UI
                        fetchProjectDetails(projectId);
                    });

                    async function fetchProjectDetails(projectId) {
                        // Make a request to fetch project details based on projectId
                        const projectDetails = await fetch(`../api/projects/index.php/${projectId}`)
                            .then((res) => {
                                if (!res.ok) {
                                    throw new Error('Error fetching project details');
                                }
                                return res.json();
                            })
                            .catch((error) => {
                                console.error(error);
                            });

                        // Update the UI with project details
                        updateUIWithProjectDetails(projectDetails);
                    }

                    const displaySingleProject = (projectData, isSaved) => {
                        const projectContainer = document.getElementById('cards-container');
                        const project = document.createElement('card-project');
                        const data = { ...projectData, isSaved };
                        project.setProjectData(data);
                        projectContainer.appendChild(project);

                        });

                    function updateUIWithProjectDetails(projectDetails) {
                        try {
                            // Update the UI elements on the edit project page with projectDetails
                            const projectContainer = document.getElementById('project-details-container');

                            // Clear existing content
                            projectContainer.innerHTML = '';

                            // Create new elements and append them to projectContainer
                            const titleElement = document.createElement('div');
                            titleElement.textContent = projectDetails.title;
                            projectContainer.appendChild(titleElement);

                            const descriptionElement = document.createElement('div');
                            descriptionElement.textContent = projectDetails.description;
                            projectContainer.appendChild(descriptionElement);

                            // Update other elements as needed

                        } catch (error) {
                            console.error(error);
                            // Handle errors, e.g., display an error message to the user
                        }
                    }
                </script>
            </div>

            <div class = "projectinformation">
                <div class = "projectdetails">Project Title:</div>
                <input type = text class = "projectname"></input>
                <div class = "projectdetails">Logline:</div>
                <input type = text class = "logline"></input>
                <div class = "projectdetails">Description:</div>
                <input type = text class = "description" placeholder="description..."></input>
                <div class = "projectdetails">Category:</div>
                <input type = text class = "category"></input>
                <div class = "projectdetails">Roles Needed:</div>
                <select class = "roles">
                    <option value = "ALL">Roles</option>
                    <?php

                    // Establish a connection to your MySQL database
                    $mysql = new mysqli("fseo.webdev.iyaserver.com", "fseo", "AcadDev_Seo_4772155360", "fseo_fusebox");

                    // Check connection
                    if ($mysql->connect_error) {
                        die("Connection failed: " . $mysql->connect_error);
                    }

                    $sql = "SELECT * FROM role";

                    $results = $mysql->query($sql);

                    if(!$results) {
                        echo "SQL error: ". $mysql->error;
                        exit();
                    }
                    while($currentrow = $results->fetch_assoc()) {
                        echo "<option>" . $currentrow["role_name"]. "</option>";
                    }
                    ?>

                </select>
            </div>


        </div>
    </div>
</div>

</body>

</html>