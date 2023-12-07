<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    // redirect
    header("Location: security/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang='en' dir='ltr'>
  <head>
      <!-- Google tag (gtag.js) -->
      <script async src="https://www.googletagmanager.com/gtag/js?id=G-EMRJE9WJPQ"></script>
      <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());

          gtag('config', 'G-EMRJE9WJPQ');
      </script>
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
      <script src='../pages/dashboard.js' type='module'></script>
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
          Welcome back, <?php echo($_SESSION["user_fname"]);?>!
          <p>Project results: <span id="numResults"></span></p>

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
          <a class="arrow round" id="prev-arrow">&#8249;</a>
          <a class="arrow round" id="next-arrow">&#8250;</a>
      </div>
    </div>
  </body>
</html>


