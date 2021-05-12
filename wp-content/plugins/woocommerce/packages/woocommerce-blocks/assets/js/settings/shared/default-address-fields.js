/** @typedef { import('@woocommerce/type-defs/address-fields').AddressField } AddressField */

/**
 * External dependencies
 */
import { __ } from '@wordpress/i18n';

/**
 * Default address field properties.
 *
 * @property {AddressField} first_name Customer first name.
 * @property {AddressField} last_name  Customer last name.
 * @property {AddressField} company    Company name.
 * @property {AddressField} address_1  Street address.
 * @property {AddressField} address_2  Second line of address.
 * @property {AddressField} country    Country code.
 * @property {AddressField} city       City name.
 * @property {AddressField} state      State name or code.
 * @property {AddressField} postcode   Postal code.
 */
export const defaultAddressFields = {
	first_name: {
		label: __( 'First name', 'woocommerce' ),
		optionalLabel: __(
			'First name (optional)',
			'woocommerce'
		),
		autocomplete: 'given-name',
		autocapitalize: 'sentences',
		required: true,
		hidden: false,
		index: 10,
	},
	last_name: {
		label: __( 'Last name', 'woocommerce' ),
		optionalLabel: __(
			'Last name (optional)',
			'woocommerce'
		),
		autocomplete: 'family-name',
		autocapitalize: 'sentences',
		required: true,
		hidden: false,
		index: 20,
	},
	company: {
		label: __( 'Company', 'woocommerce' ),
		optionalLabel: __(
			'Company (optional)',
			'woocommerce'
		),
		autocomplete: 'organization',
		autocapitalize: 'sentences',
		required: false,
		hidden: false,
		index: 30,
	},
	address_1: {
		label: __( 'Address', 'woocommerce' ),
		optionalLabel: __(
			'Address (optional)',
			'woocommerce'
		),
		autocomplete: 'address-line1',
		autocapitalize: 'sentences',
		required: true,
		hidden: false,
		index: 40,
	},
	address_2: {
		label: __( 'Apartment, suite, etc.', 'woocommerce' ),
		optionalLabel: __(
			'Apartment, suite, etc. (optional)',
			'woocommerce'
		),
		autocomplete: 'address-line2',
		autocapitalize: 'sentences',
		required: false,
		hidden: false,
		index: 50,
	},
	country: {
		label: __( 'Country/Region', 'woocommerce' ),
		optionalLabel: __(
			'Country/Region (optional)',
			'woocommerce'
		),
		autocomplete: 'country',
		required: true,
		hidden: false,
		index: 60,
	},
	city: {
		label: __( 'City', 'woocommerce' ),
		optionalLabel: __( 'City (optional)', 'woocommerce' ),
		autocomplete: 'address-level2',
		autocapitalize: 'sentences',
		required: true,
		hidden: false,
		index: 70,
	},
	state: {
		label: __( 'State/County', 'woocommerce' ),
		optionalLabel: __(
			'State/County (optional)',
			'woocommerce'
		),
		autocomplete: 'address-level1',
		autocapitalize: 'sentences',
		required: true,
		hidden: false,
		index: 80,
	},
	postcode: {
		label: __( 'Postal code', 'woocommerce' ),
		optionalLabel: __(
			'Postal code (optional)',
			'woocommerce'
		),
		autocomplete: 'postal-code',
		autocapitalize: 'characters',
		required: true,
		hidden: false,
		index: 90,
	},
};

export default defaultAddressFields;
