<?php
define('SQLITE_PATH', __DIR__ . '/../db/pfms.sqlite');
define('APP_TIMEZONE', 'Asia/Colombo');
date_default_timezone_set(APP_TIMEZONE);

define('APP_BASE', '/pfms');
function url($path){ return APP_BASE . $path; }

// === Oracle Connection (Root container) ===
define('ORACLE_HOST', 'localhost');
define('ORACLE_PORT', '1521');
define('ORACLE_SERVICE', '');   // Leave blank 
define('ORACLE_SID', 'XE');     // Use XE since tables are in CDB$ROOT
define('ORACLE_USER', 'system');
define('ORACLE_PASS', 'Plapytome');

// === Sync Configuration ===
define('AUTO_SYNC_ENABLED', false);
define('SYNC_INTERVAL_MINUTES', 15);
define('MAX_SYNC_RETRIES', 3);
define('SYNC_TIMEOUT_SECONDS', 30);
define('SYNC_DEBUG', true);
