<?php
include_once '../html/header.php';
?>

<!DOCTYPE html>

<!-- index.php 

    Intro to IR Term Project
    John Fahringer
    Ryan Heil    

        A Quiznaire Application that uses Apache Solr to index and easily retrieve data to generate questions. 

--->

<header>
<html>
    <body>
    
    <h1> Welcome! </h1>
    <h2> Please enter a query to generate a 5 question quiz based on the United States! </h2>
    <form action="../solr.php">
        Query: <input type="text" name="Query" value="Ohio"><br>
        <input type="submit" value="Submit">
    </form>


    </body>
</html>
</header>
