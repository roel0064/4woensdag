<?php
class Filter {
    /**
 * @param int $studentId
 * @param int $projectId
 * @param int $competenceId
 * @return array
 */
public static function getFilteredData($db, $studentId, $projectId, $competenceId)
{

    $sql = 'SELECT  L.project_id,
                    P.name AS project_name,
                    L.competence_id,
                    C.name AS competence_name,
                    L.student_id,
                    S.name as student_name
            FROM    project_competence_student L
            JOIN    projects P ON P.id = L.project_id
            JOIN    competencies C ON C.id = L.competence_id
            JOIN    students S ON S.id = L.student_id';

    //if we have a projectId
    if($projectId && ctype_digit($projectId) && $projectId !== '0') {
        $sql .= static::_whereOrAnd($sql) . 'L.project_id = ' . $projectId;
    }

    //if we have a competenceId
    if($competenceId && ctype_digit($competenceId) && $competenceId !== '0') {
        $sql .= static::_whereOrAnd($sql) . 'L.competence_id = ' . $competenceId;
    }

    //if we have a studentId
    if($studentId && ctype_digit($studentId) && $studentId !== '0') {
        $sql .= static::_whereOrAnd($sql) . 'L.student_id = ' . $studentId;
    }

    return $db->query($sql);
}

/**
 * @param string $sqlString
 * @return string
 */
private static function _whereOrAnd($sqlString)
{
    $return = ' WHERE ';
    if(strpos($sqlString, 'WHERE')) {
        $return = ' AND ';
    }

    return $return;
}
}



?>