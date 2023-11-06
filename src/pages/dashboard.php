<!DOCTYPE html>
<html lang='en' dir='ltr'>
  <head>
    <meta charset='utf-8'>
    <title>Fusebox</title>
    <link rel='stylesheet' href='../styles/global.css'>
    <link rel='stylesheet' href='../styles/dashboard.css'>
    <link href='https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap' rel='stylesheet'>
    <script src='../components/Header/HeaderNav.js' type='text/javascript'></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- if you guys plan on doing more, please move this to a separate file -->
    <script>
       $(document).ready(function () {
        $('#select-menu li').click(function () {
          $('#select-menu li').removeClass('selected');

          $(this).addClass('selected');
        });
      });
    </script>
  </head>

  <body>
    <div id='container'>
      <header-nav></header-nav>
      <ul class='flex-btwn' id='select-menu'>
        <li class='cursor-pointer'>projects</li>
        <li class='cursor-pointer'>people</li>
      </ul>
      <button class='button-basic flex-btwn' id='button-sort'>
        <img src='../assets/icons/icon_sort.svg' alt='Sort items'>
        <span>Sort</span>
      </button>
    </div>
  </body>
</html>