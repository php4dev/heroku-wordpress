<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }

 if ( ! defined( 'ABSPATH' ) ) { exit; } class FS_Customizer_Support_Section extends WP_Customize_Section { function __construct( $manager, $id, $args = array() ) { $manager->register_section_type( 'FS_Customizer_Support_Section' ); parent::__construct( $manager, $id, $args ); } public $type = 'freemius-support-section'; public $fs = null; public function json() { $json = parent::json(); $is_contact_visible = $this->fs->is_page_visible( 'contact' ); $is_support_visible = $this->fs->is_page_visible( 'support' ); $json['theme_title'] = $this->fs->get_plugin_name(); if ( $is_contact_visible && $is_support_visible ) { $json['theme_title'] .= ' ' . $this->fs->get_text_inline( 'Support', 'support' ); } if ( $is_contact_visible ) { $json['contact'] = array( 'label' => $this->fs->get_text_inline( 'Contact Us', 'contact-us' ), 'url' => $this->fs->contact_url(), ); } if ( $is_support_visible ) { $json['support'] = array( 'label' => $this->fs->get_text_inline( 'Support Forum', 'support-forum' ), 'url' => $this->fs->get_support_forum_url() ); } return $json; } protected function render_template() { ?>
			<li id="fs_customizer_support"
			    class="accordion-section control-section control-section-{{ data.type }} cannot-expand">
				<h3 class="accordion-section-title">
					<span>{{ data.theme_title }}</span>
					<# if ( data.contact && data.support ) { #>
					<div class="button-group">
					<# } #>
						<# if ( data.contact ) { #>
							<a class="button" href="{{ data.contact.url }}" target="_blank" rel="noopener noreferrer">{{ data.contact.label }} </a>
							<# } #>
						<# if ( data.support ) { #>
							<a class="button" href="{{ data.support.url }}" target="_blank" rel="noopener noreferrer">{{ data.support.label }} </a>
							<# } #>
					<# if ( data.contact && data.support ) { #>
					</div>
					<# } #>
				</h3>
			</li>
			<?php
 } }