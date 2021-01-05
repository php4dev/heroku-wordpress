<?php
/**
 * The REST API-specific functionality of the plugin.
 *
 * @link       https://disqus.com
 * @since      3.0
 *
 * @package    Disqus
 * @subpackage Disqus/rest-api
 */

/**
 * Defines the REST API endpoints for the plugin
 *
 * @package    Disqus
 * @subpackage Disqus/rest-api
 * @author     Ryan Valentin <ryan@disqus.com>
 */
class Disqus_Rest_Api {

    const REST_NAMESPACE = 'disqus/v1';

    const DISQUS_API_BASE = 'https://disqus.com/api/3.0/';

    /**
     * Instance of the Disqus API service.
     *
     * @since    3.0
     * @access   private
     * @var      Disqus_Api_Service    $api_service    Instance of the Disqus API service.
     */
    private $api_service;

    /**
     * The current version of the plugin.
     *
     * @since    3.0
     * @access   protected
     * @var      string    $version    The current version of the plugin.
     */
    protected $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since    3.0
     * @param    Disqus_Api_Service $api_service    Instance of the Disqus API service.
     * @param    string             $version        The version of this plugin.
     */
    public function __construct( $api_service, $version ) {
        $this->api_service = $api_service;
        $this->version = $version;
    }

    /**
     * When added as a filter, allows customizing the response. We use this to stop WordPress from
     * JSON-encoding the webhook verification response.
     * See: https://github.com/WordPress/WordPress/blob/27aa0664df927f610e42f9a694eb452cee49e245/wp-includes/rest-api/class-wp-rest-server.php#L376
     *
     * @since     3.0
     * @param     boolean          $served     Whether this filter has already been applied.
     * @param     WP_HTTP_Response $result     Result to send to the client. Usually a WP_REST_Response.
     * @param     WP_REST_Request  $request    Request used to generate the response.
     * @param     WP_REST_Server   $server     Server instance.
     * @return    boolean                      Whether we've handled the response or not.
     */
    public function filter_rest_pre_serve_request( $served, $result, $request, $server ) {
        if ( '/' . Disqus_Rest_Api::REST_NAMESPACE . '/sync/webhook' === $request->get_route() ) {
            // The sync/webhook endpoint should never return anything except the challenge in
            // plain text when prompted.
            header( 'Content-Type: text/plain; charset=UTF-8' );
            $json_data = $request->get_json_params();
            echo 'verify' === $json_data['verb'] ? $json_data['challenge'] : '';
            $served = true;
        }

        return $served;
    }

    /**
     * Callback to ensure user has manage_options permissions.
     *
     * @since     3.0
     * @param     WP_REST_Request $request    The request object.
     * @return    boolean|WP_Error            Whether the user has permission to the admin REST API.
     */
    public function rest_admin_only_permission_callback( WP_REST_Request $request ) {
        // Regular cookie-based authentication.
        if ( current_user_can( 'manage_options' ) ) {
            return true;
        }

        // Shared secret authentication.
        $hub_signature = $request->get_header( 'X-Hub-Signature' );
        $sync_token = get_option( 'disqus_sync_token' );
        $body = $request->get_body();

        if ( $hub_signature &&
             $sync_token &&
             $body &&
            ( 'sha512=' . hash_hmac( 'sha512', $body, $sync_token ) ) === $hub_signature ) {
            return true;
        }

        return $this->rest_get_error( 'You must be logged in and have admin permissions for this resource.', 401 );
    }

    /**
     * Registers Disqus plugin WordPress REST API endpoints.
     *
     * @since    3.0
     */
    public function register_endpoints() {
        register_rest_route( Disqus_Rest_Api::REST_NAMESPACE, 'sync/webhook', array(
            'methods' => 'POST',
            'callback' => array( $this, 'rest_sync_webhook' ),
            'permission_callback' => array( $this, 'rest_admin_only_permission_callback' ),
        ) );

        // Alias route for `sync/webhook` to get around plugins/services disabling "abused" routes.
        register_rest_route( Disqus_Rest_Api::REST_NAMESPACE, 'sync/comment', array(
            'methods' => 'POST',
            'callback' => array( $this, 'rest_sync_webhook' ),
            'permission_callback' => array( $this, 'rest_admin_only_permission_callback' ),
        ) );

        register_rest_route( Disqus_Rest_Api::REST_NAMESPACE, 'settings', array(
            array(
                'methods' => array( 'GET', 'POST' ),
                'callback' => array( $this, 'rest_settings' ),
                'permission_callback' => array( $this, 'rest_admin_only_permission_callback' ),
            ),
            'schema' => array( $this, 'dsq_get_settings_schema' ),
        ) );

        register_rest_route( Disqus_Rest_Api::REST_NAMESPACE, 'sync/status', array(
            array(
                'methods' => 'GET',
                'callback' => array( $this, 'rest_sync_status' ),
                'permission_callback' => array( $this, 'rest_admin_only_permission_callback' ),
            ),
        ) );

        register_rest_route( Disqus_Rest_Api::REST_NAMESPACE, 'sync/enable', array(
            array(
                'methods' => 'POST',
                'callback' => array( $this, 'rest_sync_enable' ),
                'permission_callback' => array( $this, 'rest_admin_only_permission_callback' ),
            ),
        ) );

        register_rest_route( Disqus_Rest_Api::REST_NAMESPACE, 'sync/disable', array(
            array(
                'methods' => 'POST',
                'callback' => array( $this, 'rest_sync_disable' ),
                'permission_callback' => array( $this, 'rest_admin_only_permission_callback' ),
            ),
        ) );

        register_rest_route( Disqus_Rest_Api::REST_NAMESPACE, 'export/post', array(
            array(
                'methods' => 'POST',
                'callback' => array( $this, 'rest_export_post' ),
                'permission_callback' => array( $this, 'rest_admin_only_permission_callback' ),
            ),
        ) );
    }

    /**
     * Utility function to format REST API responses.
     *
     * @since    3.0
     * @access   private
     * @param    array $data         The request data to be returned.
     * @return   WP_REST_Response    The API response object.
     */
    private function rest_get_response( array $data ) {
        return new WP_REST_Response( array(
            'code' => 'OK',
            'message' => 'Request completed successfully',
            'data' => $data,
        ), 200 );
    }

    /**
     * Utility function to format REST API errors, and to optionally log them.
     *
     * @since    3.0
     * @access   private
     * @param    string $message        The error message to be returned.
     * @param    int    $status_code    The http status code of the error.
     * @return   WP_Error               The API error object.
     */
    private function rest_get_error( $message, $status_code = 500 ) {
        return new WP_Error(
            $status_code,
            $message,
            array(
                'status' => $status_code,
            )
        );
    }

    /**
     * Endpoint callback for sync/webhook. Takes a Disqus comment and saves
     * it to the local comments database.
     *
     * @since    3.0
     * @param    WP_REST_Request $request     The request object.
     * @return   WP_REST_Response|WP_Error    The API response object.
     */
    public function rest_sync_webhook( WP_REST_Request $request ) {
        $json_data = $request->get_json_params();

        if ( ! isset( $json_data['verb'] ) ) {
            return new WP_Error( 400, 'Missing required property: verb.' );
        }

        // Check for and respond to verification request before anything else.
        if ( 'verify' === $json_data['verb'] ) {
            // The X-Hub-Signature header was already validated, so we only need to return the challenge.
            $this->log_sync_message( 'Syncing established with Disqus servers' );
            return new WP_REST_Response( $json_data['challenge'], 200 );
        }

        // Don't attempt to sync anything that isn't a comment.
        if ( 'post' !== $json_data['object_type'] ) {
            return new WP_REST_Response( '', 204 );
        }

        try {
            switch ( $json_data['verb'] ) {
                case 'force_sync':
                    $comment_id = $this->create_or_update_comment_from_post( $json_data['transformed_data'] );
                    $this->log_sync_message( 'Manually synced comment "' . $json_data['transformed_data']['id'] . '" from Disqus' );
                    return new WP_REST_Response( (string) $comment_id, 200 );
                case 'create':
                    $new_comment_id = $this->create_or_update_comment_from_post( $json_data['transformed_data'] );
                    $this->log_sync_message( 'Synced new comment "' . $json_data['transformed_data']['id'] . '" from Disqus' );
                    return new WP_REST_Response( (string) $new_comment_id, 201 );
                case 'update':
                    $updated_comment_id = $this->create_or_update_comment_from_post( $json_data['transformed_data'] );
                    $this->log_sync_message( 'Updated synced comment "' . $json_data['transformed_data']['id'] . '" from Disqus' );
                    return new WP_REST_Response( (string) $updated_comment_id, 200 );
                default:
                    return new WP_REST_Response( '', 204 );
            }
        } catch ( Exception $e ) {
            $this->log_sync_message( 'Error occurred during sync request from Disqus' );
            return new WP_Error( 500, (string) $e );
        }
    }

    /**
     * Endpoint callback for admin settings.
     *
     * @since    3.0
     * @param    WP_REST_Request $request     The request object.
     * @return   WP_REST_Response|WP_Error    The API response object.
     */
    public function rest_settings( WP_REST_Request $request ) {
        $should_update = 'POST' === $request->get_method();
        $new_settings = $should_update ? $this->get_request_data( $request ) : null;

        // Validate sync token if set.
        if ( $should_update && isset( $new_settings['disqus_sync_token'] ) ) {
            if ( strlen( $new_settings['disqus_sync_token'] ) < 32 ) {
                return $this->rest_get_error( 'The site secret key should be at least 32 characters.' );
            }
        }

        $updated_settings = $this->get_or_update_settings( $new_settings );

        return $this->rest_get_response( $updated_settings );
    }

    /**
     * Endpoint callback for fetching automatic syncing status.
     *
     * @since    3.0
     * @param    WP_REST_Request $request     The request object.
     * @return   WP_REST_Response|WP_Error    The API response object.
     */
    public function rest_sync_status( WP_REST_Request $request ) {
        try {
            $status = $this->get_sync_status();

            return $this->rest_get_response( $status );
        } catch ( Exception $e ) {
            return $this->rest_get_error( 'There was an error fetching sync status.' );
        }
    }

    /**
     * Endpoint callback for enabling automatic syncing.
     *
     * @since    3.0
     * @param    WP_REST_Request $request     The request object.
     * @return   WP_REST_Response|WP_Error    The API response object.
     */
    public function rest_sync_enable( WP_REST_Request $request ) {
        try {
            $status = $this->enable_sync();

            return $this->rest_get_response( $status );
        } catch ( Exception $e ) {
            return $this->rest_get_error( 'There was an error attempting to enable syncing.' );
        }
    }

    /**
     * Endpoint callback for disabling automatic syncing.
     *
     * @since    3.0
     * @param    WP_REST_Request $request     The request object.
     * @return   WP_REST_Response|WP_Error    The API response object.
     */
    public function rest_sync_disable( WP_REST_Request $request ) {
        try {
            $status = $this->disable_sync();

            return $this->rest_get_response( $status );
        } catch ( Exception $e ) {
            return $this->rest_get_error( 'There was an error attempting to disable syncing.' );
        }
    }

    /**
     * Endpoint callback for exporting comments from a single WordPress post to Disqus.
     *
     * @since    3.0
     * @param    WP_REST_Request $request     The request object.
     * @return   WP_REST_Response|WP_Error    The API response object.
     */
    public function rest_export_post( WP_REST_Request $request ) {
        $json_data = $request->get_json_params();
        $postId = $json_data['postId'];

        if ( ! isset( $json_data['postId'] ) ) {
            return $this->rest_get_error( 'Missing required property: postId.', 400 );
        }

        $post = get_post( $postId );

        // First get comments that are approved, and sort them by smaller IDs first, so that the parent/child dependency
        // of replies are maintained.
        $comments = get_comments( array(
            'post_id' => $postId,
            'status' => 'approve',
            'orderby' => 'comment_ID',
            'order' => 'ASC',
        ) );

        // Filter out pingbacks/trackings and comments that have been created by Disqus via syncing.
        $filtered_comments = array_filter( $comments, array( $this, 'is_pingback_or_disqus_comment' ) );

        $response_data = array(
            'comments' => $filtered_comments,
        );

        if ( ! empty( $filtered_comments ) ) {
            // Generate a WXR (XML) file that Disqus will be able to read.
            $wxr = $this->generate_export_wxr( $post, $filtered_comments );
            $filename = (string) $post->ID . '.wxr';
            $response_data['wxr'] = array(
                'filename' => $filename,
                'xmlContent' => $wxr,
            );
        }

        return $this->rest_get_response( $response_data );
    }

    /**
     * Returns the schema for the Disqus admin settings REST endpoint.
     *
     * @since     3.0
     * @return    array    The REST schema.
     */
    public function dsq_get_settings_schema() {
        return array(
            // This tells the spec of JSON Schema we are using which is draft 4.
            '$schema' => 'http://json-schema.org/draft-04/schema#',
            // The title property marks the identity of the resource.
            'title' => 'settings',
            'type' => 'object',
            // In JSON Schema you can specify object properties in the properties attribute.
            'properties' => array(
                'disqus_forum_url' => array(
                    'description' => 'Your site\'s unique identifier',
                    'type' => 'string',
                    'readonly' => false,
                ),
                'disqus_sso_enabled' => array(
                    'description' => 'This will enable Single Sign-on for this site, if already enabled for your Disqus organization.',
                    'type' => 'boolean',
                    'readonly' => false,
                ),
                'disqus_public_key' => array(
                    'description' => 'The public key of your application.',
                    'type' => 'string',
                    'readonly' => false,
                ),
                'disqus_secret_key' => array(
                    'description' => 'The secret key of your application.',
                    'type' => 'string',
                    'readonly' => false,
                ),
                'disqus_admin_access_token' => array(
                    'description' => 'The primary admin\'s access token for your application.',
                    'type' => 'string',
                    'readonly' => false,
                ),
                'disqus_sso_button' => array(
                    'description' => 'A link to a .png, .gif, or .jpg image to show as a button in Disqus.',
                    'type' => 'string',
                    'readonly' => false,
                ),
                'disqus_sync_token' => array(
                    'description' => 'The shared secret token for data sync between Disqus and the plugin.',
                    'type' => 'string',
                    'readonly' => false,
                ),
                'disqus_installed' => array(
                    'description' => 'The shared secret token for data sync between Disqus and the plugin.',
                    'type' => 'boolean',
                    'readonly' => true,
                ),
                'disqus_render_js' => array(
                    'description' => 'When true, the Disqus embed javascript is output directly into markup rather than being enqueued in a separate file.',
                    'type' => 'boolean',
                    'readonly' => false,
                ),
            ),
        );
    }

    /**
     * Checks a comment state to determine if it's valid for syncing.
     *
     * @since     3.0.11
     * @param     array $comment    The WordPress comment instance.
     * @return    boolean           Whether the comment is valid for syncing.
     */
    private function is_pingback_or_disqus_comment( $comment ) {
        return empty( $comment->comment_type ) && strpos( $comment->comment_agent, 'Disqus' ) === false;
    }

    /**
     * Parses and returns body content for either form-url-encoded or json data.
     *
     * @since    3.0
     * @param    WP_REST_Request $request    The request object.
     * @return   array                       Array of parsed request data.
     */
    private function get_request_data( WP_REST_Request $request ) {
        $content_type = $request->get_content_type();

        switch ( $content_type['value'] ) {
            case 'application/json':
                return $request->get_json_params();
            default:
                return $request->get_body_params();
        }
    }

    /**
     * Fetches all available plugin options and updates any values if passed, and returns updated array.
     *
     * @since     3.0
     * @param     array $new_settings    Any options to be updated.
     * @access    private
     * @return    array    The current settings array.
     */
    private function get_or_update_settings( $new_settings = null ) {
        $settings = array();
        $schema = $this->dsq_get_settings_schema();
        $should_update = is_array( $new_settings );

        // Loops through properties in our schema to check the value and update if needed.
        foreach ( $schema['properties'] as $key => $schema_value ) {
            $should_update_param = $should_update && isset( $new_settings[ $key ] ) && false === $schema_value['readonly'];
            if ( $should_update_param ) {
                update_option( $key, $new_settings[ $key ] );
            }
            $settings[ $key ] = get_option( $key, null );

            // Escape only values that have been set, otherwise esc_attr() will change null to an empty string.
            if ( null !== $settings[ $key ] ) {
                $settings[ $key ] = esc_attr( $settings[ $key ] );
            }
        }

        // Add additional non-database options here.
        $settings['disqus_installed'] = trim( $settings['disqus_forum_url'] ) !== '';

        return $settings;
    }

    /**
     * Determines if subscription information matches information about this WordPress site.
     *
     * @since    3.0
     * @param    object $subscription    The Disqus webhook subscription array.
     * @return   boolean                 Whether the subscription information belongs to this WordPress site.
     */
    private function validate_subscription( $subscription ) {
        return rest_url( Disqus_Rest_Api::REST_NAMESPACE . '/sync/webhook' ) === $subscription->url;
    }

    /**
     * Fetches and returns the syncing status from the Disqus servers.
     *
     * @since    3.0
     * @return   array        The syncing status array.
     * @throws   Exception    An exception if the Disqus API doesn't return with code 0 (status: 200).
     */
    private function get_sync_status() {
        $is_subscribed = false;
        $is_enabled = false;
        $current_subscription = null;
        $requires_update = false;

        if ( get_option( 'disqus_secret_key' ) && get_option( 'disqus_admin_access_token' ) ) {
            $api_data = $this->api_service->api_get( 'forums/webhooks/list', array(
                'forum' => get_option( 'disqus_forum_url' ),
            ));

            if ( 0 === $api_data->code ) {
                // Loop through each subscription, looking for the first match.
                foreach ( $api_data->response as $subscription ) {
                    if ( $this->validate_subscription( $subscription ) ) {
                        $current_subscription = $subscription;
                        $is_enabled = $current_subscription->enableSending;
                        $is_subscribed = true;
                        $requires_update = get_option( 'disqus_sync_token' ) !== $current_subscription->secret;
                        break;
                    }
                }
            } else {
                throw new Exception( $api_data->response );
            }
        }

        return array(
            'subscribed' => $is_subscribed,
            'enabled' => $is_enabled,
            'requires_update' => $requires_update,
            'subscription' => $current_subscription,
            'last_message' => get_option( 'disqus_last_sync_message', '' ),
        );
    }

    /**
     * Enables automatic syncing from Disqus if disabled.
     *
     * @since    3.0
     * @return   array    The syncing status array.
     * @throws   Exception    An exception if the Disqus API doesn't return with code 0 (status: 200).
     */
    private function enable_sync() {
        $sync_status = $this->get_sync_status();
        $subscription = $sync_status['subscription'];
        $endpoint = null;
        $params = array(
            'url' => rest_url( Disqus_Rest_Api::REST_NAMESPACE . '/sync/webhook' ),
            'secret' => get_option( 'disqus_sync_token' ),
            'enableSending' => '1',
        );

        if ( ! $sync_status['subscribed'] ) {
            $endpoint = 'forums/webhooks/create';
            $params['forum'] = get_option( 'disqus_forum_url' );
        } elseif ( ! $sync_status['enabled'] || $sync_status['requires_update'] ) {
            $endpoint = 'forums/webhooks/update';
            $params['subscription'] = $subscription->id;
        }

        if ( null !== $endpoint ) {
            $api_data = $this->api_service->api_post( $endpoint, $params );

            if ( 0 === $api_data->code ) {
                $sync_status = array(
                    'subscribed' => true,
                    'enabled' => true,
                    'requires_update' => false,
                    'subscription' => $api_data->response,
                    'last_message' => $sync_status['last_message'],
                );
            } else {
                $this->log_sync_message( 'Error enabling syncing: ' . $api_data->response );
                throw new Exception( $api_data->response );
            }
        }

        return $sync_status;
    }

    /**
     * Disables automatic syncing from Disqus if enabled.
     *
     * @since    3.0
     * @return   array    The syncing status array.
     * @throws   Exception    An exception if the Disqus API doesn't return with code 0 (status: 200).
     */
    private function disable_sync() {
        $sync_status = $this->get_sync_status();
        $subscription = $sync_status['subscription'];

        if ( $sync_status['enabled'] ) {
            $params = array(
                'subscription' => $subscription->id,
                'enableSending' => '0',
            );
            $api_data = $this->api_service->api_post( 'forums/webhooks/update', $params );

            if ( 0 === $api_data->code ) {
                $sync_status = array(
                    'subscribed' => true,
                    'enabled' => false,
                    'requires_update' => false,
                    'subscription' => $api_data->response,
                    'last_message' => $sync_status['last_message'],
                );
            } else {
                throw new Exception( $api_data->response );
            }
        }

        return $sync_status;
    }

    /**
     * Queries the WordPress database for existing comment by dsq_post_id. Creates or updates if comment found
     * in the WordPress database given a Disqus post.
     *
     * @since    3.0.17
     * @param    array $post    The Disqus post object.
     * @return   int            The created or updated comment ID.
     * @throws   Exception      An exception if comment can't be saved from post data.
     */
    private function create_or_update_comment_from_post( $post ) {
        $this->validate_disqus_post_data( $post );

        // Check for existing comment.
        $comment_query = new WP_Comment_Query( array(
            'meta_key' => 'dsq_post_id',
            'meta_value' => $post['id'],
            'number' => 1,
        ) );

        $comments = $comment_query->comments;
        if ( ! empty( $comments ) ) {
            return $this->update_comment_from_post( $post, $comments );
        }

        return $this->create_comment_from_post( $post );
    }

    /**
     * Creates a comment in the WordPress database given a Disqus post.
     *
     * @since    3.0
     * @param    array $post    The Disqus post object.
     * @return   int            The newly created comment ID.
     * @throws   Exception      An exception if comment can't be saved from post data.
     */
    private function create_comment_from_post( $post ) {
        $comment_data = $this->comment_data_from_post( $post );

        $new_comment_id = wp_insert_comment( $comment_data );

        return $new_comment_id;
    }

    /**
     * Updates a comment in the WordPress database given a Disqus post.
     *
     * @since    3.0
     * @param    array $post        The Disqus post object.
     * @param    array $comments    The comments found matching the dsq_post_id.
     * @return   int                The newly created comment ID.
     * @throws   Exception          An exception if comment can't be saved from post data.
     */
    private function update_comment_from_post( $post, $comments ) {
        foreach ( $comments as $comment ) {
            $updated_comment_id = $comment->comment_ID;
        }

        $comment_data = $this->comment_data_from_post( $post );
        $comment_data['comment_ID'] = $updated_comment_id;

        // Remove non-updating fields.
        unset( $comment_data['comment_meta'] );
        unset( $comment_data['comment_agent'] );
        unset( $comment_data['comment_parent'] );
        unset( $comment_data['comment_type'] );
        unset( $comment_data['comment_date_gmt'] );
        unset( $comment_data['comment_post_ID'] );

        $updated = wp_update_comment( $comment_data );

        return 1 === $updated ? $updated_comment_id : 0;
    }

    /**
     * Creates a comment in the WordPress database given a Disqus post.
     *
     * @since    3.0
     * @param    array $post    The Disqus post object.
     * @throws   Exception      An exception if comment is invalid.
     */
    private function validate_disqus_post_data( $post ) {
        if ( ! $post || get_option( 'disqus_forum_url' ) !== $post['forum'] ) {
            throw new Exception( 'The comment\'s forum does not match the installed forum. Was "' . $post['forum'] . '", expected "' . get_option( 'disqus_forum_url' ) . '"' );
        }
    }

    /**
     * Checks the state of a Disqus post (comment) and translates to the WordPress comment_approved format.
     *
     * @since    3.0
     * @param    array $post    The Disqus post object.
     * @return   array          The translated comment data to be inserted/updated.
     * @throws   Exception      An exception if comment can't be saved from post data.
     */
    private function comment_data_from_post( $post ) {
        $thread = array_key_exists( 'threadData', $post ) ? $post['threadData'] : $post['thread'];
        $author = $post['author'];

        $wp_post_id = null;

        // Look up posts with the Disqus thread ID meta field.
        $post_query = new WP_Query( array(
            'meta_key' => 'dsq_thread_id',
            'meta_value' => $thread['id'],
        ) );

        if ( $post_query->have_posts() ) {
            $wp_post_id = $post_query->post->ID;
            wp_reset_postdata();
        }

        // If that doesn't exist, get the  and update the matching post metadata.
        if ( null === $wp_post_id || false === $wp_post_id ) {
            $identifiers = $thread['identifiers'];
            $first_identifier = count( $identifiers ) > 0 ? $identifiers[0] : null;

            if ( null !== $first_identifier ) {
                $ident_parts = explode( ' ', $first_identifier, 2 );
                $wp_post_id = reset( $ident_parts );
            }

            // Keep the post's thread ID meta up to date.
            update_post_meta( $wp_post_id, 'dsq_thread_id', $thread['id'] );
        }

        if ( null === $wp_post_id || false == $wp_post_id ) {
            throw new Exception( 'No post found associated with the thread.' );
        }

        // Find the parent comment, if any.
        $parent = 0;
        if ( null !== $post['parent'] ) {
            $parent_comment_query = new WP_Comment_Query( array(
                'meta_key' => 'dsq_post_id',
                'meta_value' => (string) $post['parent'],
                'number' => 1,
            ) );
            $parent_comments = $parent_comment_query->comments;

            if ( empty( $parent_comments ) ) {
                throw new Exception( 'This comment\'s parent has not been synced yet.' );
            } else {
                $parent = $parent_comments[0]->comment_ID;
            }
        }

        // Email is a special permission for Disqus API applications and won't be present
        // if the user has not set the permission for their API application.
        $author_email = null;
        if ( isset( $author['email'] ) ) {
            $author_email = $author['email'];
        } elseif ( $author['isAnonymous'] ) {
            $author_email = 'anonymized-' . md5( $author['name'] ) . '@disqus.com';
        } else {
            $author_email = 'user-' . $author['id'] . '@disqus.com';
        }

        // Translate the comment approval state.
        $comment_approved = 1;
        if ( $post['isApproved'] && ! $post['isDeleted'] ) {
            $comment_approved = 1;
        } elseif ( $post['isDeleted'] ) {
            $comment_approved = 0; // Deleted is not a state in WordPress, so we'll keep them in pending.
        } elseif ( ! $post['isDeleted'] && ! $post['isSpam'] && ! $post['isApproved'] ) {
            $comment_approved = 0;
        } elseif ( $post['isSpam'] && ! $post['isApproved'] ) {
            $comment_approved = 'spam';
        }

        return array(
            'comment_post_ID' => (int) $wp_post_id,
            'comment_author' => $author['name'],
            'comment_author_email' => $author_email,
            'comment_author_IP' => $post['ipAddress'],
            'comment_author_url' => isset( $author['url'] ) ? $author['url'] : '',
            'comment_content' => $post['raw_message'],
            'comment_date_gmt' => $post['createdAt'],
            'comment_type' => '', // Leave blank for a regular comment.
            'comment_parent' => $parent,
            'comment_agent' => 'Disqus Sync Host',
            'comment_approved' => $comment_approved,
            'comment_meta' => array(
                'dsq_post_id' => $post['id'],
            ),
        );
    }

    /**
     * Stores the last sync log message with date/time appended.
     *
     * @since     3.0
     * @access    private
     * @param     string $message    The base message to store.
     */
    private function log_sync_message( $message ) {
        update_option( 'disqus_last_sync_message', $message . ': ' . date( 'Y-m-d g:i a', time() ) );
    }

    /**
     * Outputs a list of comments to a WXR file for uploading to the Disqus importer.
     *
     * @since     3.0
     * @access    private
     * @param     WP_Post $post        The post details the comments belong to.
     * @param     array   $comments    The base message to store.
     * @return    string               The WXR document as a string.
     */
    private function generate_export_wxr( $post, $comments ) {

        $post_author = get_userdata( $post->post_author );

        $xml = new DOMDocument( '1.0', get_bloginfo( 'charset' ) );

        $rss = $xml->createElement( 'rss' );
        $rss->setAttribute( 'version', '2.0' );
        $rss->setAttributeNS(
            'http://www.w3.org/2000/xmlns/',
            'xmlns:excerpt',
            'http://wordpress.org/export/1.0/excerpt/'
        );
        $rss->setAttributeNS(
            'http://www.w3.org/2000/xmlns/',
            'xmlns:content',
            'http://purl.org/rss/1.0/modules/content/'
        );
        $rss->setAttributeNS(
            'http://www.w3.org/2000/xmlns/',
            'xmlns:dsq',
            'https://disqus.com/'
        );
        $rss->setAttributeNS(
            'http://www.w3.org/2000/xmlns/',
            'xmlns:wfw',
            'http://wellformedweb.org/CommentAPI/'
        );
        $rss->setAttributeNS(
            'http://www.w3.org/2000/xmlns/',
            'xmlns:dc',
            'http://purl.org/dc/elements/1.1/'
        );
        $rss->setAttributeNS(
            'http://www.w3.org/2000/xmlns/',
            'xmlns:wp',
            'http://wordpress.org/export/1.0/'
        );

        $channel = $xml->createElement( 'channel' );
        $channel->appendChild( $xml->createElement( 'title', get_bloginfo_rss( 'name' ) ) );
        $channel->appendChild( $xml->createElement( 'link', get_bloginfo_rss( 'url' ) ) );
        $channel->appendChild(
            $xml->createElement(
                'pubDate',
                mysql2date( 'D, d M Y H:i:s +0000', get_lastpostmodified( 'GMT' ), false )
            )
        );
        $channel->appendChild(
            $xml->createElement(
                'generator',
                'WordPress ' . get_bloginfo_rss( 'version' ) . '; Disqus ' . $this->version
            )
        );

        // Generate the item (the post).
        $item = $xml->createElement( 'item' );
        $item->appendChild(
            $xml->createElement( 'title', apply_filters( 'the_title_rss', $post->post_title ) )
        );
        $item->appendChild(
            $xml->createElement(
                'link',
                esc_url( apply_filters( 'the_permalink_rss', get_permalink( $post->ID ) ) )
            )
        );
        $item->appendChild(
            $xml->createElement(
                'pubDate',
                mysql2date( 'D, d M Y H:i:s +0000', get_post_time( 'Y-m-d H:i:s', true, $post ), false )
            )
        );

        $author_name_cdata = $xml->createCDATASection( $post_author->display_name );
        $author_name_element = $xml->createElement( 'dc:creator' );
        $author_name_element->appendChild( $author_name_cdata );
        $item->appendChild( $author_name_element );

        $guid = $xml->createElement( 'guid', $post->guid );
        $guid->setAttribute( 'isPermalink', 'false' );
        $item->appendChild( $guid );

        $post_content_cdata = $xml->createCDATASection( apply_filters( 'the_content_export', $post->post_content ) );
        $post_content_element = $xml->createElement( 'content:encoded' );
        $post_content_element->appendChild( $post_content_cdata );
        $item->appendChild( $post_content_element );

        $identifier_cdata = $xml->createCDATASection( $post->ID . ' ' . $post->guid );
        $identifier_element = $xml->createElement( 'dsq:thread_identifier' );
        $identifier_element->appendChild( $identifier_cdata );
        $item->appendChild( $identifier_element );

        $item->appendChild(
            $xml->createElement(
                'wp:post_id',
                $post->ID
            )
        );

        $item->appendChild(
            $xml->createElement(
                'wp:post_date_gmt',
                $post->post_date_gmt
            )
        );

        $item->appendChild(
            $xml->createElement(
                'wp:comment_status',
                $post->comment_status
            )
        );

        foreach ( $comments as $c ) {

            $wpcomment = $xml->createElement( 'wp:comment' );

            $wpcomment->appendChild(
                $xml->createElement(
                    'wp:comment_id',
                    $c->comment_ID
                )
            );

            $comment_author_name_cdata = $xml->createCDATASection( $c->comment_author );
            $comment_author_name_element = $xml->createElement( 'wp:comment_author' );
            $comment_author_name_element->appendChild( $comment_author_name_cdata );
            $wpcomment->appendChild( $comment_author_name_element );

            $wpcomment->appendChild(
                $xml->createElement(
                    'wp:comment_author_email',
                    $c->comment_author_email
                )
            );

            $wpcomment->appendChild(
                $xml->createElement(
                    'wp:comment_author_url',
                    $c->comment_author_url
                )
            );

            $wpcomment->appendChild(
                $xml->createElement(
                    'wp:comment_author_IP',
                    $c->comment_author_IP
                )
            );

            $wpcomment->appendChild(
                $xml->createElement(
                    'wp:comment_date',
                    $c->comment_date
                )
            );

            $wpcomment->appendChild(
                $xml->createElement(
                    'wp:comment_date_gmt',
                    $c->comment_date_gmt
                )
            );

            $comment_content_cdata = $xml->createCDATASection( $c->comment_content );
            $comment_content_element = $xml->createElement( 'wp:comment_content' );
            $comment_content_element->appendChild( $comment_content_cdata );
            $wpcomment->appendChild( $comment_content_element );

            $wpcomment->appendChild(
                $xml->createElement(
                    'wp:comment_approved',
                    $c->comment_approved
                )
            );

            $wpcomment->appendChild(
                $xml->createElement(
                    'wp:comment_type',
                    $c->comment_type
                )
            );

            $wpcomment->appendChild(
                $xml->createElement(
                    'wp:comment_parent',
                    $c->comment_parent
                )
            );

            $item->appendChild( $wpcomment );
        }

        // Append the post item to the channel.
        $channel->appendChild( $item );

        // Append the root channel to the RSS element.
        $rss->appendChild( $channel );

        // Finally append the root RSS element to the XML document.
        $xml->appendChild( $rss );

        $wxr = $xml->saveXML();

        return $wxr;
    }
}
