<?php
/**
 * Bidding Calculator: daily budget ÷ price per click = visitors per day.
 *
 * @package Viewmail
 */

defined( 'ABSPATH' ) || exit;

use Elementor\Controls_Manager;
use Elementor\Repeater;

class Viewmail_Bid_Calculator extends \Elementor\Widget_Base {

	public function get_name() {
		return 'viewmail-bid-calculator';
	}

	public function get_title() {
		return __( 'Bidding Calculator', 'viewmail' );
	}

	public function get_icon() {
		return 'eicon-number-field';
	}

	public function get_categories() {
		return array( 'viewmail' );
	}

	public function get_keywords() {
		return array( 'bidding', 'calculator', 'cpc', 'viewmail' );
	}

	protected function register_controls() {
		$this->start_controls_section( 'content', array( 'label' => __( 'Calculator', 'viewmail' ) ) );

		$this->add_control( 'title', array( 'label' => __( 'Title', 'viewmail' ), 'type' => Controls_Manager::TEXT, 'default' => '3. Bidding: Money vs. Visitors', 'label_block' => true ) );
		$this->add_control( 'intro', array( 'label' => __( 'Text', 'viewmail' ), 'type' => Controls_Manager::WYSIWYG, 'default' => 'Google Ads works on an <b>Auction System</b>. Depending on your business, the original price per click (CPC) changes.' ) );
		$this->add_control( 'budget_label', array( 'label' => __( 'Budget label', 'viewmail' ), 'type' => Controls_Manager::TEXT, 'default' => 'Daily Budget (₹):' ) );
		$this->add_control( 'budget', array( 'label' => __( 'Starting daily budget', 'viewmail' ), 'type' => Controls_Manager::NUMBER, 'default' => 500, 'min' => 0 ) );
		$this->add_control( 'type_label', array( 'label' => __( 'Business type label', 'viewmail' ), 'type' => Controls_Manager::TEXT, 'default' => 'Business Type (Market Price):' ) );
		$this->add_control( 'result_label', array( 'label' => __( 'Result label', 'viewmail' ), 'type' => Controls_Manager::TEXT, 'default' => 'Visitors Daily' ) );

		$repeater = new Repeater();
		$repeater->add_control( 'label', array( 'label' => __( 'Business type', 'viewmail' ), 'type' => Controls_Manager::TEXT, 'default' => 'Local Shop / General (₹12 per click)', 'label_block' => true ) );
		$repeater->add_control( 'cpc', array( 'label' => __( 'Price per click (₹)', 'viewmail' ), 'type' => Controls_Manager::NUMBER, 'default' => 12, 'min' => 1 ) );
		$repeater->add_control( 'default', array( 'label' => __( 'Selected at start', 'viewmail' ), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes' ) );

		$this->add_control(
			'types',
			array(
				'label'       => __( 'Business types', 'viewmail' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ label }}}',
				'default'     => array(
					array( 'label' => 'Local Shop / General (₹12 per click)', 'cpc' => 12 ),
					array( 'label' => 'Professional Services (₹25 per click)', 'cpc' => 25, 'default' => 'yes' ),
					array( 'label' => 'Real Estate / Finance (₹60 per click)', 'cpc' => 60 ),
				),
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$s     = $this->get_settings_for_display();
		$types = is_array( $s['types'] ) ? $s['types'] : array();
		$cpc   = 0;
		foreach ( $types as $i => $type ) {
			if ( ! $cpc || 'yes' === $type['default'] ) {
				$cpc = max( 1, (float) $type['cpc'] );
			}
		}
		$visitors = $cpc ? floor( (float) $s['budget'] / $cpc ) : 0;
		?>
		<div class="vm-bid vm-hover-up">
			<h2 class="vm-bid__title"><?php echo esc_html( $s['title'] ); ?></h2>
			<div class="vm-bid__intro"><?php echo wp_kses_post( $s['intro'] ); ?></div>
			<div class="vm-bid__box">
				<label class="vm-field"><span><?php echo esc_html( $s['budget_label'] ); ?></span>
					<input type="number" min="0" data-field="budget" value="<?php echo esc_attr( $s['budget'] ); ?>">
				</label>
				<label class="vm-field"><span><?php echo esc_html( $s['type_label'] ); ?></span>
					<select data-field="cpc">
						<?php foreach ( $types as $type ) : ?>
							<option value="<?php echo esc_attr( max( 1, (float) $type['cpc'] ) ); ?>" <?php selected( 'yes', $type['default'] ); ?>><?php echo esc_html( $type['label'] ); ?></option>
						<?php endforeach; ?>
					</select>
				</label>
				<div class="vm-bid__result">
					<span data-show="visitors"><?php echo esc_html( $visitors ); ?></span>
					<p><?php echo esc_html( $s['result_label'] ); ?></p>
				</div>
			</div>
		</div>
		<?php
	}
}
