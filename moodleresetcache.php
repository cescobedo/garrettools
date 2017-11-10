<?php
// MOODLE is needed.
// Place script into local folder.
require_once('../config.php');
global $CFG, $DB;

$cache = optional_param('cache', 'all', PARAM_RAW); 

require_capability('moodle/site:config', context_system::instance());

echo '<h2>Purgado de Cache de Moodle Manual</h2>';
echo '<p>Cache seleccionada: '.$cache.'</p>';

if ($cache == 'filters') {
    reset_text_filters_cache();  
} else if ($cache == 'js') {
    js_reset_all_caches();  
} else if ($cache == 'theme') {
    theme_reset_all_caches();  
} else if ($cache == 'string') {
    get_string_manager()->reset_caches();
    core_text::reset_caches();  
} else if ($cache == 'plugin') {
    if (class_exists('core_plugin_manager')) {
        core_plugin_manager::reset_caches();
    }
} else if ($cache == 'db') {
    $DB->reset_caches();
} else if ($cache == 'helper') {
     cache_helper::purge_all();
} else if ($cache == 'others') {
    // Purge all other caches: rss, simplepie, etc.
    remove_dir($CFG->cachedir.'', true);

    // Make sure cache dir is writable, throws exception if not.
    make_cache_directory('');
} else if ($cache == 'localcachedir') {
    // This is the only place where we purge local caches, we are only adding files there.
    // The $CFG->localcachedirpurged flag forces local directories to be purged on cluster nodes.
    remove_dir($CFG->localcachedir, true);
    set_config('localcachedirpurged', time());
    make_localcache_directory('', true);
}  else if ($cache == 'all') {
    purge_all_caches();
}

echo '<br>Cache refrescada.';