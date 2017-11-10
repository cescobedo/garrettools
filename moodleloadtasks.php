<?php
// MOODLE is needed.
// Place script into local folder.
require_once('../config.php');
require_once($CFG->libdir.'/eventslib.php');
global $DB, $CFG;

require_capability('moodle/site:config', context_system::instance());

echo '<br>Load Tasks';
\core\task\manager::reset_scheduled_tasks_for_component('MOODLEPLUGIN');
echo '<br>Done.';
