<?php
// MOODLE is needed.
// Place script into local folder.
require_once('../config.php');
global $DB, $CFG;

$courseid = optional_param('courseid', '', PARAM_RAW);

require_capability('moodle/site:config', context_system::instance());

$sql = "select * 
		from {course_modules} ";
if (!empty($courseid)) {
	$sql .= " where course = ".$courseid;
} 

$modules = $DB->get_records('modules', array());

echo '<h1>Integridad Estructura Curso Moodle</h1>';
if ($cms = $DB->get_records_sql($sql, array())) {
	foreach($cms as $cm) {
		echo '<br> Curso:'.$cm->course.' ('.$cm->id.') - '.$cm->module.' - '.$cm->instance;
		if ($DB->record_exists($modules[$cm->module]->name, array('id'=>$cm->instance))) {
			echo ' - '.$modules[$cm->module]->name.' - Si';
		} else {
			echo ' - '.$modules[$cm->module]->name.' - No';
		}
	}
}



echo '<br> <h1>Agrupamientos ZOMBIES - The Walking Groupings </h1><br>';

$groups = "select gg.*
from {groupings} gg
where gg.courseid = :course and gg.id not in (
SELECT cm.groupingid 
FROM {course_modules} cm
    where cm.course = :course2)";

if ($courses = $DB->get_records('course', array())) {
	foreach ($courses as $course) {
		if ($groupings = $DB->get_records_sql($groups, array('course'=>$course->id, 'course2'=>$course->id))) {
			echo '<br>Curso :'.$course->id .' -- Grupos sin asignación';
			print_object($groupings);
		}
	}
}



