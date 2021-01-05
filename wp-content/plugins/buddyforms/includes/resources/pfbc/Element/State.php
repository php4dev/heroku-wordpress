<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }


/**
 * Class Element_State
 */
class Element_State extends Element_Select {
	/**
	 * @var array
	 */
	protected $_attributes = array();

	private static $state_list;

	/**
	 * Element_State constructor.
	 *
	 * @param $label
	 * @param $name
	 * @param array|null $properties
	 * @param null $field_options
	 */
	public function __construct( $label, $name, array $properties = null, $field_options = null ) {
		self::init_state_list();
		self::$state_list = apply_filters( 'buddyforms_state_output_values', self::$state_list, $properties );

		$properties['class'] = 'bf-state ' . $properties['class'];
		if ( ! empty( $field_options['state_list'] ) ) {
			try {
				$provided_state_list = json_decode( $field_options['state_list'], true );
			} catch ( Exception $ex ) {
				$provided_state_list = self::$state_list;
			}
		} else {
			$provided_state_list = self::$state_list;
		}
		parent::__construct( $label, $name, $provided_state_list, $properties, $field_options );
	}

	private static function init_state_list() {
		if ( empty( self::$state_list ) ) {
			self::$state_list = array(
				''        => __( 'Select State', 'buddyforms' ),
				"nostate" => __( 'No State', 'buddyforms' ),
				'US'      => array(
					"AL" => "Alabama",
					"AK" => "Alaska",
					"AZ" => "Arizona",
					"AR" => "Arkansas",
					"CA" => "California",
					"CO" => "Colorado",
					"CT" => "Connecticut",
					"DE" => "Delaware",
					"DC" => "District of Columbia",
					"FL" => "Florida",
					"GA" => "Georgia",
					"HI" => "Hawaii",
					"ID" => "Idaho",
					"IL" => "Illinois",
					"IN" => "Indiana",
					"IA" => "Iowa",
					"KS" => "Kansas",
					"KY" => "Kentucky",
					"LA" => "Louisiana",
					"ME" => "Maine",
					"MD" => "Maryland",
					"MA" => "Massachusetts",
					"MI" => "Michigan",
					"MN" => "Minnesota",
					"MS" => "Mississippi",
					"MO" => "Missouri",
					"MT" => "Montana",
					"NE" => "Nebraska",
					"NV" => "Nevada",
					"NH" => "New Hampshire",
					"NJ" => "New Jersey",
					"NM" => "New Mexico",
					"NY" => "New York",
					"NC" => "North Carolina",
					"ND" => "North Dakota",
					"OH" => "Ohio",
					"OK" => "Oklahoma",
					"OR" => "Oregon",
					"PA" => "Pennsylvania",
					"RI" => "Rhode Island",
					"SC" => "South Carolina",
					"SD" => "South Dakota",
					"TN" => "Tennessee",
					"TX" => "Texas",
					"UT" => "Utah",
					"VT" => "Vermont",
					"VA" => "Virginia",
					"WA" => "Washington",
					"WV" => "West Virginia",
					"WI" => "Wisconsin",
					"WY" => "Wyoming"
				)
			);
		}
	}

	public static function get_state_list() {
		self::init_state_list();

		return apply_filters( 'buddyforms_state_element_values', self::$state_list );
	}

	public function render() {
		$this->appendAttribute( 'class', 'c-select' );
		if ( isset( $this->_attributes["value"] ) ) {
			if ( ! is_array( $this->_attributes["value"] ) ) {
				$this->_attributes["value"] = array( $this->_attributes["value"] );
			}
		} else {
			$this->_attributes["value"] = array();
		}

		if ( ! empty( $this->_attributes["multiple"] ) && substr( $this->_attributes["name"], - 2 ) != "[]" ) {
			$this->_attributes["name"] .= "[]";
		}

		$is_link_with_country = ! empty( $this->field_options['link_with_country'] ) && ! empty( $this->field_options['link_with_country'][0] ) && $this->field_options['link_with_country'][0] === 'link';

		$is_required = $this->isRequired();

		global $buddyforms;

		$form_slug = $this->getAttribute( 'data-form' );

		$labels_layout = isset( $buddyforms[ $form_slug ]['layout']['labels_layout'] ) ? $buddyforms[ $form_slug ]['layout']['labels_layout'] : 'inline';

		echo '<select', $this->getAttributes( array( "value", "selected" ) ), '>';
		$selected = false;
		$i        = 0;
		foreach ( $this->options as $country_key => $state ) {
			$country_key = $this->filter( $country_key );
			if ( is_array( $state ) ) {
				foreach ( $state as $value => $text ) {
					$value = $this->getOptionValue( $value );
					echo '<option data-country="' . $country_key . '" value="', $value, '"';
					if ( in_array( $value, $this->_attributes["value"] ) ) {
						if ( $selected && empty ( $this->_attributes["multiple"] ) ) {
							continue;
						}
						echo ' selected="selected"';

						$selected = true;
					}
					if ( ! empty( $is_link_with_country ) ) {
						echo ' style="display: none;"';
					}
					echo '>', $text, '</option>';
				}
			} else {
				if ( $i == 0 && empty( $country_key ) && $is_required && $labels_layout === 'inline' ) {
					$state = $state . ' ' . $this->getRequiredPlainSignal();
				}
				echo '<option data-country="' . $country_key . '" value="', $country_key, '">' . $state . "</option>";
			}
			$i ++;
		}
		echo '</select>';
	}
}
