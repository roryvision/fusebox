<!--temporary "dahsboard", where user is taken once they login-->
<?php
session_start();

//check if variable is empty
if(isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <title>HOME</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>  
    <body>
        <!-- if we also want to gather name in db during login -->
        <h2>Hello, <?php echo $_SESSION['email']; ?></h2>
        <a href="logout.php">Logout</a>
    </body>  
    </html>
    <?php
}
    
else {
    header ("Location: index.php");
    exit();
}
?>