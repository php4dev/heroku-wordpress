<?php
/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://disqus.com
 * @since      3.0
 *
 * @package    Disqus
 * @subpackage Disqus/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      3.0
 * @package    Disqus
 * @subpackage Disqus/includes
 * @author     Ryan Valentin <ryan@disqus.com>
 */
class Disqus {

    /**
     * Instance of the Disqus API service.
     *
     * @since    3.0
     * @access   private
     * @var      Disqus_Api_Service    $api_service    Instance of the Disqus API service.
     */
    private $api_service;

    /**
     * The loader that's responsible for maintaining and registering all hooks that power
     * the plugin.
     *
     * @since    3.0
     * @access   protected
     * @var      Disqus_Loader    $loader    Maintains and registers all hooks for the plugin.
     */
    protected $loader;

    /**
     * The unique identifier of this plugin.
     *
     * @since    3.0
     * @access   protected
     * @var      string    $disqus    The string used to uniquely identify this plugin.
     */
    protected $disqus;

    /**
     * The current version of the plugin.
     *
     * @since    3.0
     * @access   protected
     * @var      string    $version    The current version of the plugin.
     */
    protected $version;

    /**
     * The unique Disqus forum shortname.
     *
     * @since    3.0
     * @access   protected
     * @var      string    $shortname    The unique Disqus forum shortname.
     */
    protected $shortname;

    /**
     * Define the core functionality of the plugin.
     *
     * Set the plugin name and the plugin version that can be used throughout the plugin.
     * Load the dependencies, and set the hooks for the admin area and the public-facing
     * side of the site.
     *
     * @since    3.0
     * @param    string $version    The version of this plugin.
     */
    public function __construct( $version ) {

        $this->disqus = 'disqus';
        $this->version = $version;
        $this->shortname = strtolower( get_option( 'disqus_forum_url' ) );

        $this->load_dependencies();
        $this->define_admin_hooks();
        $this->define_public_hooks();
        $this->define_rest_api_hooks();

    }

    /**
     * Load the required dependencies for this plugin.
     *
     * Include the following files that make up the plugin:
     *
     * - Disqus_Loader. Orchestrates the hooks of the plugin.
     * - Disqus_Admin. Defines all hooks for the admin area.
     * - Disqus_Public. Defines all hooks for the public side of the site.
     *
     * Create an instance of the loader which will be used to register the hooks
     * with WordPress.
     *
     * @since    3.0
     * @access   private
     */
    private function load_dependencies() {

        /**
         * The class responsible for orchestrating the actions and filters of the
         * core plugin.
         */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-disqus-loader.php';

        /**
         * The class responsible making requests to the Disqus API.
         */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-disqus-api-service.php';

        /**
         * The class responsible for defining all actions that occur in the admin area.
         */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-disqus-admin.php';

        /**
         * The class responsible for defining all actions that occur in the public-facing
         * side of the site.
         */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-disqus-public.php';

        /**
         * The class responsible for defining all actions that occur on the REST API of
         * the site.
         */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'rest-api/class-disqus-rest-api.php';

        $secret_key = get_option( 'disqus_secret_key' );
        $access_token = get_option( 'disqus_admin_access_token' );

        $this->api_service = new Disqus_Api_Service( $secret_key, $access_token );
        $this->loader = new Disqus_Loader();
    }

    /**
     * Register all of the hooks related to the admin area functionality
     * of the plugin.
     *
     * @since    3.0
     * @access   private
     */
    private function define_admin_hooks() {
        $plugin_admin = new Disqus_Admin( $this->get_disqus_name(), $this->get_version(), $this->get_shortname() );

        $this->loader->add_filter( 'rest_url', $plugin_admin, 'dsq_filter_rest_url' );
        $this->loader->add_filter( 'plugin_action_links', $plugin_admin, 'dsq_plugin_action_links', 10, 2 );
        $this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
        $this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
        $this->loader->add_action( 'admin_menu', $plugin_admin, 'dsq_contruct_admin_menu' );
        $this->loader->add_action( 'admin_bar_menu', $plugin_admin, 'dsq_construct_admin_bar', 999 );
    }

    /**
     * Register all of the hooks related to the public-facing functionality
     * of the plugin.
     *
     * @since    3.0
     * @access   private
     */
    private function define_public_hooks() {
        $plugin_public = new Disqus_Public( $this->get_disqus_name(), $this->get_version(), $this->get_shortname() );

        $this->loader->add_filter( 'comments_number', $plugin_public, 'dsq_comments_link_template' );
        $this->loader->add_filter( 'comments_template', $plugin_public, 'dsq_comments_template' );
        $this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_comment_count' );
        $this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_comment_embed' );
        $this->loader->add_action( 'show_user_profile', $plugin_public, 'dsq_close_window_template' );
    }

    /**
     * Register all of the hooks related to the REST API functionality
     * of the plugin.
     *
     * @since    3.0
     * @access   private
     */
    private function define_rest_api_hooks() {
        $plugin_rest_api = new Disqus_Rest_Api( $this->get_api_service(), $this->get_version() );

        $this->loader->add_action( 'rest_api_init', $plugin_rest_api, 'register_endpoints' );

        $this->loader->add_filter( 'rest_pre_serve_request', $plugin_rest_api, 'filter_rest_pre_serve_request', 10, 4 );
    }

    /**
     * Run the loader to execute all of the hooks with WordPress.
     *
     * @since    3.0
     */
    public function run() {
        $this->loader->run();
    }

    /**
     * Returns instance of the Disqus API service.
     *
     * @since     3.0
     * @return    string    Instance of the Disqus API service.
     */
    public function get_api_service() {
        return $this->api_service;
    }

    /**
     * The name of the plugin used to uniquely identify it within the context of
     * WordPress and to define internationalization functionality.
     *
     * @since     3.0
     * @return    string    The name of the plugin.
     */
    public function get_disqus_name() {
        return $this->disqus;
    }

    /**
     * The reference to the class that orchestrates the hooks with the plugin.
     *
     * @since     3.0
     * @return    Disqus_Loader    Orchestrates the hooks of the plugin.
     */
    public function get_loader() {
        return $this->loader;
    }

    /**
     * Retrieve the version number of the plugin.
     *
     * @since     3.0
     * @return    string    The version number of the plugin.
     */
    public function get_version() {
        return $this->version;
    }

    /**
     * Retrieve the installed Disqus shortname.
     *
     * @since     3.0
     * @return    string    The installed shortname.
     */
    public function get_shortname() {
        return $this->shortname;
    }

    /**
     * Formats the unique disqus_identifier for a given post.
     *
     * @since     3.0
     * @param     string $post    The WordPress post object.
     * @return    string          The unique disqus_identifier.
     */
    public function dsq_identifier_for_post( $post ) {
        return $post->ID . ' ' . $post->guid;
    }

    /**
     * Formats the title for a given post.
     *
     * @since     3.0
     * @param     string $post    The WordPress post object.
     * @return    string          The formatted disqus_title.
     */
    public function dsq_title_for_post( $post ) {
        $title = get_the_title( $post );
        $title = strip_tags( $title, '<b><u><i><h1><h2><h3><code><blockquote><br><hr>' );
        return $title;
    }
}
