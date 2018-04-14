<?php

namespace WPDesk\WP\Plugin;
use WPDesk\SupportsInitialization;

/**
 * Base plugin class for WP Desk plugins
 *
 * @author Grzegorz
 *
 */
abstract class AbstractPlugin implements SupportsInitialization {

	/** @var \WPDesk_PluginInfo */
    protected $plugin_info;

    /** @var string */
	protected $plugin_namespace;

	/** @var string */
	protected $plugin_url;

	/** @var string */
	protected $docs_url;

	/** @var string */
	protected $settings_url;
	
	/**
	 * AbstractPlugin constructor.
	 *
	 * @param \WPDesk_PluginInfo $plugin_info
	 */
    public function __construct( $plugin_info ) {
		$this->plugin_info = $plugin_info;
		$this->plugin_namespace = strtolower($plugin_info->plugin_class_name); // ?? NOT SURE
    }

    function init() {
    	$this->init_base_variables();
    	$this->load_plugin_text_domain();
    	$this->hooks();
    }

	/**
	 * Priority to set initialize order
	 *
	 * @return int
	 */
	public function get_init_priority() {
		return SupportsInitialization::DEFAULT_INIT_PRIORITY;
	}

    /**
     * @return $this
     */
    public function get_plugin() {
        return $this;
    }

    /**
     * @return string
     */
    public function get_text_domain() {
        return $this->get_namespace();
    }

    /**
     * @return void
     */
    public function load_plugin_text_domain() {
        $plugin_translation = load_plugin_textdomain( $this->get_text_domain(), false, $this->get_namespace() . '/lang/' );
    }

    /**
     * @param string $base_file
     */
    public function init_base_variables( ) {
        // Set Plugin URL
        $this->plugin_url = plugin_dir_url( $this->plugin_info->plugin_dir );

    }

    /**
     * @return void
     */
    protected function hooks() {
        add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );

        add_action( 'wp_enqueue_scripts', array( $this, 'wp_enqueue_scripts' ) );

        add_action( 'plugins_loaded', array( $this, 'load_plugin_text_domain' ) );
        add_filter( 'plugin_action_links_' . plugin_basename( $this->get_plugin_file_path() ), array(
            $this,
            'links_filter'
        ) );

    }

    /**
     *
     * @return string
     */
    public function get_plugin_url() {
        return esc_url( trailingslashit( $this->plugin_url ) );
    }

    public function get_plugin_assets_url() {
        return esc_url( trailingslashit( $this->get_plugin_url() . 'assets' ) );
    }

    /**
     * @return string
     */
    public function get_plugin_file_path() {
        return $this->plugin_info->plugin_dir;
    }

    /**
     * @return string
     */
    public function get_namespace() {
        return $this->plugin_namespace;
    }

    public function admin_enqueue_scripts( ) {
    }

    public function wp_enqueue_scripts() {
    }

    /**
     * action_links function.
     *
     * @access public
     *
     * @param mixed $links
     *
     * @return array
     */
    public function links_filter( $links ) {
        $support_link = get_locale() === 'pl_PL' ? 'https://www.wpdesk.pl/support/' : 'https://www.wpdesk.net/support';

        $plugin_links = array(
            '<a href="' . $support_link . '">' . __( 'Support', 'wpdesk-plugin' ) . '</a>',
        );
        $links        = array_merge( $plugin_links, $links );

        if ( $this->docs_url ) {
            $plugin_links = array(
                '<a href="' . $this->docs_url . '">' . __( 'Docs', 'wpdesk-plugin' ) . '</a>',
            );
            $links        = array_merge( $plugin_links, $links );
        }

        if ( $this->settings_url ) {
            $plugin_links = array(
                '<a href="' . $this->settings_url . '">' . __( 'Settings', 'wpdesk-plugin' ) . '</a>',
            );
            $links        = array_merge( $plugin_links, $links );
        }

        return $links;
    }

}

