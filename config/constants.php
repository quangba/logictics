<?php

/**
 * Flags
 */
// const FLAG_TRUE = 1;
// const FLAG_FALSE = 0;
// const PAGINATE_RECORD = 20;
defined('FLAG_TRUE') or define('FLAG_TRUE', 1);
defined('FLAG_FALSE') or define('FLAG_FALSE', 0);
defined('PAGINATE_RECORD') or define('PAGINATE_RECORD', 20);

/**
 * Roles
 */
// const ADMIN_ROLE = 'admin';
// const USER_ROLE = 'user';
// const VIEWER_ROLE = 'viewer';
// const SUPER_ADMIN_ID = 1;

defined('ADMIN_ROLE') or define('ADMIN_ROLE', 'admin');
defined('USER_ROLE') or define('USER_ROLE', 'user');
defined('VIEWER_ROLE') or define('VIEWER_ROLE', 'viewer');
defined('SUPER_ADMIN_ID') or define('SUPER_ADMIN_ID', 1);

/**
 * Permissions view
 */
// const VIEW_CARRIER = 'view_carrier';
defined('VIEW_CARRIER') or define('VIEW_CARRIER', 'view_carrier');
/**
 * Permissions management
 */
// const MANAGE_USERS = 'manage_users';
// const MANAGE_CARRIER = 'manage_carrier';
defined('MANAGE_USERS') or define('MANAGE_USERS', 'manage_users');
defined('MANAGE_CARRIER') or define('MANAGE_CARRIER', 'manage_carrier');
