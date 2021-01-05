<?php // Prismatic - Uninstall Remove Options

if (!defined('ABSPATH') && !defined('WP_UNINSTALL_PLUGIN')) exit();

delete_option('prismatic_options_general');
delete_option('prismatic_options_prism');
delete_option('prismatic_options_highlight');
delete_option('prismatic_options_plain');
