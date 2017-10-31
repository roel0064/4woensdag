<?php
include_once "Filter.php";

$servername = "localhost";
$username = "root";
$password = "";
$studentId = "0";
$competenceId = "0";
$projectId = "0";

if(isset($_GET["studentid"]))
{
    $studentId=$_GET["studentid"];
}

if(isset($_GET["projectid"]))
{
    $projectId=$_GET["projectid"];

}
if(isset($_GET["competenceid"]))
{
    $competenceId=$_GET["competenceid"];
}

// Create connection
$conn = new mysqli($servername, $username, $password);

$db = new PDO('mysql:host=localhost;dbname=4woensdag', 'root', '');
$mergedData=Filter::getFilteredData($db,$studentId,$projectId,$competenceId)->fetchAll();


$students = [];
$competences = [];
$projects = [];

foreach ($mergedData as $data) {
    $students[$data['student_id']] = $data['student_name'];
    $competences[$data['competence_id']] = $data['competence_name'];
    $projects[$data['project_id']] = $data['project_name'];
}



?>




<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="Style.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
</head>

<body>
<div>
<img class="img" src="img/hzlogo.png">
<h1>Competentiemanager</h1>
</div>
<br>
<div class="dropdowns">
    <div class="titel col-sm-4">Project
    <br>
    <select class="col-sm-10" id="project-select col-sm-2">
    <option value="0">
    All
    </option>
        <?php
        foreach($projects as $id => $project):   
        ?>   

            <option value="<?= $id ?>" <?= ($projectId == $id) ? "selected" : ""; ?>>
            <?= $project ?>
            </option>

        <?php
        endforeach;
        ?>
        <option disabled>

        </option>
        <option>
            Voeg toe
        </option>
        <option>
            Wijzig
        </option>
        </select>        
    </div>


    <div class="titel col-sm-4">Competentie
        <br>
        <select class="col-sm-10" id="competentie-select col-sm-2">
        <option value="0">
    All
    </option>
        <?php
        foreach($competences as $id => $competence):   
        ?>   

            <option value="<?= $id ?>" <?= ($competenceId == $id) ? "selected" : ""; ?>>
            <?= $competence ?>
            </option>

        <?php
        endforeach;
        ?>
            <option disabled>

            </option>
            <option>
                Voeg toe
            </option>
            <option>
                Wijzig
            </option>
        </select>     
    </div>



    <div class="titel col-sm-4">Student
    <br>
    <select class="col-sm-10" id="student-select col-sm-2">
    <option value="0">
    All
    </option>
        <?php
        foreach($students as $id => $student):   
        ?>   

            <option value="<?= $id ?>" <?= ($studentId == $id) ? "selected" : ""; ?>>
            <?= $student ?>
            </option>

        <?php
        endforeach;
        ?>
        <option disabled>

        </option>
        <option>
            Voeg toe
        </option>
        <option>
            Wijzig
        </option>
        </select>   
    </div>
</div>
    <script type="text/javascript" src="script.js"></script>
    
    <script>
    var studentid = <?= $studentId ?>;
    var competenceid = <?= $competenceId ?>;
    var projectid = <?= $projectId ?>;

    function redirect(){
        var currentlocation = window.location.origin;
        var newlocation = currentlocation + "/4woensdag/index.php?projectid=" + projectid + "&competenceid=" + competenceid + "&studentid=" + studentid;
        window.location.replace(newlocation);
    }


    $("#project-select").change(function(){
        projectid = $(this).val();
        redirect();
    });

    $("#competentie-select").change(function(){
        competenceid = $(this).val();
        redirect();
    });

    $("#student-select").change(function(){
        studentid = $(this).val();
        redirect();
    });


    </script>
</body>
</html>
