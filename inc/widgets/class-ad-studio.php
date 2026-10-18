<?php
/**
 * Ad Preview Studio: visitors type a headline, description, area and URL and
 * see a live Google search ad preview with a reach forecast.
 *
 * @package Viewmail
 */

defined( 'ABSPATH' ) || exit;

use Elementor\Controls_Manager;

class Viewmail_Ad_Studio extends \Elementor\Widget_Base {

	public function get_name() {
		return 'viewmail-ad-studio';
	}

	public function get_title() {
		return __( 'Ad Preview Studio', 'viewmail' );
	}

	public function get_icon() {
		return 'eicon-preview-medium';
	}

	public function get_categories() {
		return array( 'viewmail' );
	}

	public function get_keywords() {
		return array( 'google', 'ads', 'preview', 'viewmail' );
	}

	protected function register_controls() {
		$this->start_controls_section( 'content', array( 'label' => __( 'Texts', 'viewmail' ) ) );

		$this->add_control( 'title', array( 'label' => __( 'Title', 'viewmail' ), 'type' => Controls_Manager::TEXT, 'default' => '2. Create Your Ad Preview', 'label_block' => true ) );
		$this->add_control( 'badge', array( 'label' => __( 'Badge', 'viewmail' ), 'type' => Controls_Manager::TEXT, 'default' => 'Professional Configurator' ) );
		$this->add_control(
			'goals',
			array(
				'label'       => __( 'Target goals', 'viewmail' ),
				'description' => __( 'One per line.', 'viewmail' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 4,
				'default'     => "Increase Website Visits\nMaximize Direct Sales\nBoost Inbound Calls",
			)
		);
		$this->add_control( 'budget', array( 'label' => __( 'Starting daily budget (INR)', 'viewmail' ), 'type' => Controls_Manager::NUMBER, 'default' => 1000, 'min' => 0 ) );
		$this->add_control(
			'multiplier',
			array(
				'label'       => __( 'Reach per rupee', 'viewmail' ),
				'description' => __( 'Forecast = daily budget × this number.', 'viewmail' ),
				'type'        => Controls_Manager::NUMBER,
				'default'     => 50,
				'min'         => 0,
			)
		);
		$this->add_control( 'head_placeholder', array( 'label' => __( 'Headline example', 'viewmail' ), 'type' => Controls_Manager::TEXT, 'default' => 'e.g. premium Hosting in Hyderabad', 'separator' => 'before' ) );
		$this->add_control( 'desc_placeholder', array( 'label' => __( 'Description example', 'viewmail' ), 'type' => Controls_Manager::TEXT, 'default' => 'Describe your service...' ) );
		$this->add_control( 'area_placeholder', array( 'label' => __( 'Area example', 'viewmail' ), 'type' => Controls_Manager::TEXT, 'default' => 'e.g. Hyderabad' ) );
		$this->add_control( 'default_area', array( 'label' => __( 'Area shown by default', 'viewmail' ), 'type' => Controls_Manager::TEXT, 'default' => 'India' ) );
		$this->add_control( 'default_url', array( 'label' => __( 'Web address shown by default', 'viewmail' ), 'type' => Controls_Manager::TEXT, 'default' => 'www.yourbusiness.com' ) );
		$this->add_control( 'default_head', array( 'label' => __( 'Headline shown by default', 'viewmail' ), 'type' => Controls_Manager::TEXT, 'default' => 'Your Ad Headline' ) );
		$this->add_control( 'default_desc', array( 'label' => __( 'Description shown by default', 'viewmail' ), 'type' => Controls_Manager::TEXTAREA, 'rows' => 2, 'default' => 'Your ad description will appear here as customers search for your business.' ) );
		$this->add_control( 'forecast_label', array( 'label' => __( 'Forecast label', 'viewmail' ), 'type' => Controls_Manager::TEXT, 'default' => 'FORECAST' ) );

		$this->end_controls_section();
	}

	protected function render() {
		$s     = $this->get_settings_for_display();
		$goals = array_filter( array_map( 'trim', explode( "\n", (string) $s['goals'] ) ) );
		$mult  = (float) $s['multiplier'];
		$reach = number_format( (float) $s['budget'] * $mult );
		?>
		<div class="vm-studio" data-multiplier="<?php echo esc_attr( $mult ); ?>"
			data-head="<?php echo esc_attr( $s['default_head'] ); ?>" data-desc="<?php echo esc_attr( $s['default_desc'] ); ?>"
			data-area="<?php echo esc_attr( $s['default_area'] ); ?>" data-url="<?php echo esc_attr( $s['default_url'] ); ?>">
			<div class="vm-studio__form vm-hover-up">
				<h2 class="vm-studio__title"><?php echo esc_html( $s['title'] ); ?>
					<?php if ( $s['badge'] ) : ?>
						<span class="vm-studio__badge"><?php echo esc_html( $s['badge'] ); ?></span>
					<?php endif; ?>
				</h2>
				<div class="vm-studio__grid">
					<label class="vm-field"><span><?php esc_html_e( 'Target Goal', 'viewmail' ); ?></span>
						<select data-field="goal">
							<?php foreach ( $goals as $goal ) : ?>
								<option><?php echo esc_html( $goal ); ?></option>
							<?php endforeach; ?>
						</select>
					</label>
					<label class="vm-field"><span><?php esc_html_e( 'Daily Budget (INR)', 'viewmail' ); ?></span>
						<input type="number" min="0" data-field="budget" value="<?php echo esc_attr( $s['budget'] ); ?>">
					</label>
				</div>
				<label class="vm-field"><span><?php esc_html_e( 'Headline', 'viewmail' ); ?></span>
					<input type="text" maxlength="30" data-field="head" placeholder="<?php echo esc_attr( $s['head_placeholder'] ); ?>">
				</label>
				<label class="vm-field"><span><?php esc_html_e( 'Description', 'viewmail' ); ?></span>
					<textarea maxlength="90" rows="3" data-field="desc" placeholder="<?php echo esc_attr( $s['desc_placeholder'] ); ?>"></textarea>
				</label>
				<div class="vm-studio__grid">
					<label class="vm-field"><span><?php esc_html_e( 'Area', 'viewmail' ); ?></span>
						<input type="text" data-field="area" placeholder="<?php echo esc_attr( $s['area_placeholder'] ); ?>">
					</label>
					<label class="vm-field"><span><?php esc_html_e( 'URL', 'viewmail' ); ?></span>
						<input type="text" data-field="url" placeholder="<?php echo esc_attr( $s['default_url'] ); ?>">
					</label>
				</div>
			</div>
			<div class="vm-studio__preview">
				<div class="vm-mockup vm-hover-up">
					<div class="vm-mockup__bar"><span class="vm-mockup__dots"><i></i><i></i></span><strong data-show="area"><?php echo esc_html( $s['default_area'] ); ?></strong></div>
					<div class="vm-mockup__ad">
						<small><?php esc_html_e( 'Sponsored', 'viewmail' ); ?></small>
						<div class="vm-mockup__url" data-show="url"><?php echo esc_html( $s['default_url'] ); ?></div>
						<span class="vm-mockup__head" data-show="head"><?php echo esc_html( $s['default_head'] ); ?></span>
						<div class="vm-mockup__desc" data-show="desc"><?php echo esc_html( $s['default_desc'] ); ?></div>
					</div>
				</div>
				<div class="vm-reach vm-hover-up">
					<strong><?php echo esc_html( $s['forecast_label'] ); ?></strong>
					<div class="vm-reach__value"><span data-show="reach"><?php echo esc_html( $reach ); ?></span>+ <?php esc_html_e( 'Reach', 'viewmail' ); ?></div>
				</div>
			</div>
		</div>
		<?php
	}
}
