import {displayProject } from "../helpers/CardHelper.js";
let created = [];
let saved = [];
let applied = [];
let numResults = 0;

$(document).ready(async () => {
    console.log("hi");
    try {
        const createdResponse = await fetch('../api/created.php');
        const savedResponse = await fetch('../api/saved.php');
        const appliedResponse = await fetch('../api/applied.php');

        if (!createdResponse.ok || !savedResponse.ok || !appliedResponse.ok) {
            throw new Error('Error fetching projects');
        }

        created = await createdResponse.json();
        saved = await savedResponse.json();
        applied = await appliedResponse.json();

        numResults = created.length; // Or saved.length or applied.length, depending on the context
        $('#numResults').text(numResults);

        // Display logic for 'created', 'saved', 'applied'
        displayProjects(created);

        $('#select-menu li').click(function () {
            console.log("hi");
            $('#select-menu li').removeClass('selected');
            $(this).addClass('selected');
            if ($(this).attr('value') == 'created') {
                displayProjects(created);
            } else if ($(this).attr('value') == 'saved') {
                displayProjects(saved);
            } else if ($(this).attr('value') == 'applied') {
                displayProjects(applied);
            }
        });
    } catch (error) {
        console.error(error);
    }
});

// Helper function to display projects
function displayProjects(projects) {
    $('#cards-container').empty(); // Clear existing cards
    projects.forEach(p => displayProject(p));
}