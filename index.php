<?php
$servername = "localhost";
$username = "Dave";
$password = "Dave";

// Create connection
$conn = new mysqli($servername, $username, $password);

$db = new PDO('mysql:host=localhost;dbname=Dave', 'Dave', 'Dave');
?>




<head>
    <meta charset="UTF-8">
    <script type="text/javascript" src="script.js"></script>
    <link rel="stylesheet" type="text/css" href="Style.css" />
</head>

<body>
    <div class="titel">Project
    <br>
        <?php
        //Dropdown compecompetencies names
        $query = $db->query("SELECT name FROM projects");
        echo '<select name="Competenties">';
        while ($row1 = $query->fetch(PDO::FETCH_ASSOC))
        {
            echo '<option value="'.$row1['name'].'">'.$row1['name'].'</option>';
        }
        echo '</select>';
        ?>            
    </div>


    <div class="titel">Competentie
        <br>
        <?php
        //Dropdown compecompetencies names
        $query = $db->query("SELECT name FROM competencies");
        echo '<select name="Competenties">';
        while ($row2 = $query->fetch(PDO::FETCH_ASSOC))
        {
            echo '<option value="'.$row2['name'].'">'.$row2['name'].'</option>';
        }
        echo '</select>';
        ?>
    </div>



    <div class="titel">Student
    <br>
        <?php
        //Dropdown compecompetencies names
        $query = $db->query("SELECT name FROM students");
        echo '<select name="Competenties">';
        while ($row3 = $query->fetch(PDO::FETCH_ASSOC))
        {
            echo '<option value="'.$row3['name'].'">'.$row3['name'].'</option>';
        }
        echo '</select>';
        ?>   
    </div>
</body>



