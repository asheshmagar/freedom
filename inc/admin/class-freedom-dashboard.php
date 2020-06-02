<?php
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

class Freedom_Dashboard {
	private static $instance;

	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	private function __construct() {
		$this->setup_hooks();
	}

	private function setup_hooks() {
		add_action( 'admin_menu', array( $this, 'create_menu' ) );
	}

	public function create_menu() {
		if ( ! is_child_theme() ) {
			$theme = wp_get_theme();
		} else {
			$theme = wp_get_theme()->parent();
		}

		/* translators: %s: Theme Name. */
		$theme_page_name = sprintf( esc_html__( '%s Options', 'freedom' ), $theme->Name );

		add_theme_page( $theme_page_name, $theme_page_name, 'edit_theme_options', 'freedom-options', array(
			$this,
			'option_page'
		) );
	}

	public function option_page() {
		$theme        = wp_get_theme();
		$support_link = 'https://wordpress.org/support/theme/freedom/';
		?>
		<div class="wrap">
		<div class="freedom-header">
			<h1>
				<?php
				/* translators: %s: Theme version. */
				echo sprintf( esc_html__( 'Freedom %s', 'freedom' ), ZAKRA_THEME_VERSION );
				?>
			</h1>
		</div> <!-- /.freedom-header -->

		<div class="welcome-panel">
			<div class="welcome-panel-content">
				<h2>
					<?php
					/* translators: %s: Theme Name. */
					echo sprintf( esc_html__( 'Welcome to %s!', 'freedom' ), $theme->Name );
					?>
				</h2>

				<p class="about-description"><?php esc_html_e( 'Important links to get you started with Freedom', 'freedom' ); ?></p>

				<div class="welcome-panel-column-container">
					<div class="welcome-panel-column">
						<h3><?php esc_html_e( 'Get Started', 'freedom' ); ?></h3>
						<a class="button button-primary button-hero"
						   href="<?php echo esc_url( 'https://docs.themegrill.com/freedom/#section-1' ); ?>"
						   target="_blank"><?php esc_html_e( 'Learn Basics', 'freedom' ); ?>
						</a>
					</div>

					<div class="welcome-panel-column">
						<h3><?php esc_html_e( 'Next Steps', 'freedom' ); ?></h3>
						<ul>
							<li><?php printf( '<a target="_blank" href="%s" class="welcome-icon dashicons-media-text">' . esc_html__( 'Documentation', 'freedom' ) . '</a>', esc_url( 'https://docs.themegrill.com/freedom/' ) ); ?></li>
							<li><?php printf( '<a target="_blank" href="%s" class="welcome-icon dashicons-layout">' . esc_html__( 'Starter Demos', 'freedom' ) . '</a>', esc_url( 'https://demo.themegrill.com/freedom-demos' ) ); ?></li>
							<li><?php printf( '<a target="_blank" href="%s" class="welcome-icon dashicons-migrate">' . esc_html__( 'Premium Version', 'freedom' ) . '</a>', esc_url( 'https://themegrill.com/themes/freedom/' ) ); ?></li>
						</ul>
					</div>

					<div class="welcome-panel-column">
						<h3><?php esc_html_e( 'Further Actions', 'freedom' ); ?></h3>
						<ul>
							<li><?php printf( '<a target="_blank" href="%s" class="welcome-icon dashicons-businesswoman">' . esc_html__( 'Got theme support question?', 'freedom' ) . '</a>', esc_url( $support_link ) ); ?></li>
							<li><?php printf( '<a target="_blank" href="%s" class="welcome-icon dashicons-thumbs-up">' . esc_html__( 'Leave a review', 'freedom' ) . '</a>', esc_url( 'https://wordpress.org/support/theme/freedom/reviews/' ) ); ?></li>
						</ul>
					</div>
				</div> <!-- /.welcome-panel-column-container -->
			</div> <!-- /.welcome-panel-content -->
		</div> <!-- /.welcome-panel -->
		<?php
	}
}

Freedom_Dashboard::instance();
