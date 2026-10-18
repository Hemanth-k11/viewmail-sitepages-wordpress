<?php
/**
 * Web App Demo Explorer: a searchable list; choosing an item opens its demo.
 *
 * @package Viewmail
 */

defined( 'ABSPATH' ) || exit;

use Elementor\Controls_Manager;

class Viewmail_Demo_Explorer extends \Elementor\Widget_Base {

	public function get_name() {
		return 'viewmail-demo-explorer';
	}

	public function get_title() {
		return __( 'Web App Demo Explorer', 'viewmail' );
	}

	public function get_icon() {
		return 'eicon-search';
	}

	public function get_categories() {
		return array( 'viewmail' );
	}

	public function get_keywords() {
		return array( 'demo', 'search', 'apps', 'viewmail' );
	}

	public function get_style_depends() {
		return array( 'choices' );
	}

	public function get_script_depends() {
		return array( 'choices' );
	}

	protected function register_controls() {
		$this->start_controls_section( 'content', array( 'label' => __( 'Demos', 'viewmail' ) ) );

		$this->add_control( 'label', array( 'label' => __( 'Label', 'viewmail' ), 'type' => Controls_Manager::TEXT, 'default' => 'Explore Web App Demos' ) );
		$this->add_control( 'placeholder', array( 'label' => __( 'Search box text', 'viewmail' ), 'type' => Controls_Manager::TEXT, 'default' => 'Type to search...' ) );
		$this->add_control(
			'demos',
			array(
				'label'       => __( 'Demos', 'viewmail' ),
				'description' => __( 'One per line: Name | https://link', 'viewmail' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 14,
				'default'     => viewmail_default_demos(),
			)
		);
		$this->add_control(
			'new_tab',
			array(
				'label'        => __( 'Open demos in a new tab', 'viewmail' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => '',
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$s     = $this->get_settings_for_display();
		$demos = array();
		foreach ( explode( "\n", (string) $s['demos'] ) as $line ) {
			$parts = array_map( 'trim', explode( '|', $line, 2 ) );
			if ( 2 === count( $parts ) && $parts[0] && $parts[1] ) {
				$demos[] = $parts;
			}
		}
		$id = 'vm-demo-' . $this->get_id();
		?>
		<div class="vm-demos" data-new-tab="<?php echo 'yes' === $s['new_tab'] ? '1' : '0'; ?>">
			<label class="vm-demos__label" for="<?php echo esc_attr( $id ); ?>"><?php echo esc_html( $s['label'] ); ?></label>
			<select id="<?php echo esc_attr( $id ); ?>" class="vm-demos__select" data-placeholder="<?php echo esc_attr( $s['placeholder'] ); ?>">
				<option value=""><?php echo esc_html( $s['placeholder'] ); ?></option>
				<?php foreach ( $demos as $demo ) : ?>
					<option value="<?php echo esc_url( $demo[1] ); ?>"><?php echo esc_html( $demo[0] ); ?></option>
				<?php endforeach; ?>
			</select>
		</div>
		<?php
	}
}
