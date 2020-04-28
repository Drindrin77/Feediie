<!DOCTYPE html>
<html lang="en">
<head>
    <title> FEEDIIE Admin - Homepage </title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="stylesheet" type="text/css" href="../../CSS/style.css" />


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style>
        .footer {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            background-color: LightGray;
            color: white;
            text-align: center;
        }
        #container {
            text-align: center;
            max-width: 750px;
            margin: 0 auto;
        }
        p{
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
        }
        .block {
            width: 600px;
            height: 300px;
            margin: 10px;
            display: inline-block;
            background: LightGray;
        }
        .body{
            font-family: verdana;
            font: italic 1.2em "Fira Sans", serif;
        }
    </style>

</head>

<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">FEEDIIE</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="http://localhost:8080/">FEEDIIE</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="homepage.php">Dashboard</a></li>
                <li><a href="#">Aide</a></li>
                <li><a href="../Auth/deconnexion.php">Déconnexion</a></li>
            </ul>
        </div>
    </div>

</nav>


<div class="jumbotron text-center">
    <h1>Bienvenue dans le club des admins ! </h1>
    <!-- Latest compiled and minified JavaScript -->
</div>
<br> <br><br><br>


</form>
<br/>
<form action="ban.php" method="post" class="well col-md-6 col-md-offset-3">

    <!-- Name field -->
    <div class="form-group">
        <label class="control-label" for="name">Nouvelle categorie  </label>
        <input type="text" class="form-control" id="ip" name="ip" required="required" />
    </div>


    <input type="submit" class="btn btn-primary" value="create" name="create"/>

</form>

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

</body>
</html>

<?php

//Liste des categories existantes

?>
