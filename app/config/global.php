<?php
define('CMS_HOST', 'localhost');
define('CMS_USER', 'root');
define('CMS_PASS', '');
define('CMS_DB', 'benryhomme_data');
define('CMS_PREFIX', 'cms_');

define('CMS_URL', 'http://localhost/benryhomme/');
define('CMS_CODE', preg_replace('/[^a-zA-Z0-9]+/i', '', base64_encode(CMS_URL)));
define('CMS_SUFFIX', '.html');

define('CMS_BACKEND', 'admin');

// define('CMS_ENCRYPTION', '937c09412cb9104aa6d3d93f142d70ad');

define('CMS_META', '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />');