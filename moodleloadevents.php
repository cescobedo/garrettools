<?php
// MOODLE is needed.
// Place script into local folder.
require_once('../config.php');
require_once($CFG->libdir.'/eventslib.php');
global $DB, $CFG;

require_capability('moodle/site:config', context_system::instance());

echo '<br>Load Events';
events_update_definition('NAMEOFPLUGIN');
echo '<br>Done.';
print_object(events_load_def('NAMEOFPLUGIN'));
echo '<br>Done.';