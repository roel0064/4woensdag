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
    <link rel="stylesheet" type="text/css" href="Style.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body>
    <div class="titel">Project
    <br>
    <select id="project-select">
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
        </select>        
    </div>


    <div class="titel">Competentie
        <br>
        <select id="competentie-select">
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
        </select>     
    </div>



    <div class="titel">Student
    <br>
    <select id="student-select">
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
        </select>   
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
