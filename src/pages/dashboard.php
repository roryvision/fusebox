<?php
require_once('../helpers/db-connection.php');
?>

<!DOCTYPE html>
<html lang='en' dir='ltr'>
  <head>
    <meta charset='utf-8'>
    <title>Fusebox</title>
    <link rel='stylesheet' href='../styles/global.css'>
    <link rel='stylesheet' href='../styles/dashboard.css'>
    <link rel='stylesheet' href='../components/Card/card.css'>
    <link href='https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap' rel='stylesheet'>
    <script src='../components/Header/HeaderNav.js' type='text/javascript'></script>
    <script src='../components/Card/CardProject.js' type='text/javascript'></script>
    <script src='../components/Card/CardPerson.js' type='text/javascript'></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script type='module'>
      import { displayProject, displayPerson } from '../helpers/CardHelper.js';
      
      let projectsOrPeople = 'projects';

      $(document).ready(async () => {
        let projects = await fetch('../api/projects.php')
          .then(res => {
            if (!res.ok) {
              throw new Error('Error fetching projects');
            }

            return res.json();
          }).catch(error => {
            console.error(error);
          });
        
        let people = await fetch('../api/people.php')
          .then(res => {
            if (!res.ok) {
              throw new Error('Error fetching people');
            }

            return res.json();
          }).catch(error => {
            console.error(error);
          });

        projects.forEach((p) => displayProject(p));
        
        $('#select-menu li').click(function () {
          $('#select-menu li').removeClass('selected');
          $(this).addClass('selected');

          $('#cards-container').empty();

          if ($(this).attr('value') == 'projects') {
            projects.forEach((p) => displayProject(p));
          } else if ($(this).attr('value') == 'people') {
            people.forEach((p) => displayPerson(p));
          }
        });
      });
    </script>

  </head>

  <body>
    <div id='container'>
      <header-nav></header-nav>
      <ul class='flex-btwn' id='select-menu'>
        <li class='cursor-pointer selected' value='projects'>projects</li>
        <li class='cursor-pointer' value='people'>people</li>
      </ul>

      <br />

      <div>
        <div id='filter-container'>
          <p>Results: POPULATE</p>

          <h3>Applied Filters:</h3>
            <div id="appliedTypeFilters"><strong>Types:</strong> </div>
            <div id="appliedRoleFilters"><strong>Roles:</strong> </div>
            <hr />

          <h3>Project Type</h3>
          <form>
            <ul>
              <li><input type='checkbox' id='type-tech' name='type-tech' value='tech'/>
              <label for='type-tech'>Tech</label></li>
              <li><input type='checkbox' id='type-visual' name='type-visual' value='visual'/>
              <label for='type-visual'>Visual</label></li>
              <li><input type='checkbox' id='type-music' name='type-music' value='music'/>
              <label for='type-music'>Music</label></li>
              <li><input type='checkbox' id='type-film' name='type-film' value='film'/>
              <label for='type-film'>Film</label></li>
              <li><input type='checkbox' id='type-business' name='type-business' value='business'/>
              <label for='type-business'>Business</label></li>
              <li><input type='checkbox' id='type-other' name='type-other' value='other'/>
              <label for='type-other'>Other</label></li>
            </ul>
          </form>
          <hr />

          <h3>Project Role</h3>
          <form>
            <ul>
              <li><input type='checkbox' id='role-tech' name='role-tech' value='tech'/>
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
              </li>
              <li><input type='checkbox' id='role-visual' name='role-visual' value='visual'/>
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
              </li>
              <li><input type='checkbox' id='role-business' name='role-business' value='business'/>
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
              </li>
              <li><input type='checkbox' id='role-film' name='role-film' value='film'/>
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
              </li>
              <li><input type='checkbox' id='role-performing' name='role-performing' value='performing'/>
              <label for='role-performing'>Performing</label>
                <ul>
                  <li><input type='checkbox' id='role-actor' name='role-actor' value='actor'/>
                  <label for='role-actor'>Actor</label></li>
                  <li><input type='checkbox' id='role-dancer' name='role-dancer' value='dancer'/>
                  <label for='role-dancer'>Dancer</label></li>
                  <li><input type='checkbox' id='role-musician' name='role-musician' value='musician'/>
                  <label for='role-musician'>Musician</label></li>
                </ul>
              </li>
              <li><input type='checkbox' id='role-general' name='role-general' value='general'/>
              <label for='role-general'>General</label>
                <ul>
                  <li><input type='checkbox' id='role-writer' name='role-writer' value='writer'/>
                  <label for='role-writer'>Writer</label></li>
                  <li><input type='checkbox' id='role-event' name='role-event' value='event'/>
                  <label for='role-event'>Event Planner</label></li>
                  <li><input type='checkbox' id='role-other' name='role-other' value='other' />
                  <label for='role-other'>Other</label></li>
                </ul>
              </li>
            </ul>
          </form>
        </div>

        <div id='cards-container'></div>
      </div>
    </div>
  </body>

  <script>
      let typesArray = [];
      let rolesArray = [];

      // Update Display
      function updateTypesArrayOutput() {
          let outputDiv = document.getElementById('appliedTypeFilters');
          let outputText = typesArray.map(item => item.label).join(', ');
          outputDiv.innerHTML = `<strong>Types:</strong> ${outputText}`;
      }
      function updateRolesArrayOutput() {
          let outputDiv = document.getElementById('appliedRoleFilters');
          let outputText = rolesArray.map(item => item.label).join(', ');
          outputDiv.innerHTML = `<strong>Roles:</strong> ${outputText}`;
      }


      function check(thisCheckbox, dataArray, updateFunction){ // when checked/unchecked, adds or removes it from list of applied filters
          let label = thisCheckbox.nextElementSibling.textContent.trim();
          let value = thisCheckbox.value;
          console.log(label);
          if (thisCheckbox.checked == true){
              dataArray.push({ label, value });
          }
          else{
              let index = dataArray.findIndex(item => item.value === value);
              if (index !== -1) {
                  dataArray.splice(index, 1);
              }
          }
          console.log(dataArray);

          updateFunction();
      }

      function checkAll(thisCheckbox) {
          let checkboxesInList = thisCheckbox.parentElement.querySelectorAll("input[type='checkbox']");
          if (thisCheckbox.checked == true) {
              checkboxesInList.forEach(function (checkbox) {
                  checkbox.checked = true;
                  check(checkbox, rolesArray, updateRolesArrayOutput);

              });
          } else {
              checkboxesInList.forEach(function (checkbox) {
                  checkbox.checked = false;
                  check(checkbox, rolesArray, updateRolesArrayOutput);
              });
          }

          updateRolesArrayOutput();
      }
      
      document.addEventListener('DOMContentLoaded', function () { // event listener for all checkbox changes
          const checkboxes = document.querySelectorAll('input[type="checkbox"]');
          console.log(checkboxes);
          checkboxes.forEach(checkbox => {
              checkbox.addEventListener('change', function () {
                  if (this.id === 'role-tech' || this.id === 'role-visual' || this.id === 'role-business' || this.id === 'role-film' || this.id === 'role-performing') {
                      checkAll(this);
                  } else if (this.id.startsWith('role-')) {
                      check(this, rolesArray, updateRolesArrayOutput);

                  } else if (this.id.startsWith('type-')) {
                      check(this, typesArray, updateTypesArrayOutput);
                  }
              });
          });
      });

  </script>
</html>


