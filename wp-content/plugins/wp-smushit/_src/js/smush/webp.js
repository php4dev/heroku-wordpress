/* global WP_Smush */
/* global ajaxurl */

/**
 * WebP functionality.
 *
 * @since 3.8.0
 */

(function () {
	'use strict';

	WP_Smush.WebP = {
		nonceField: document.getElementsByName('wp_smush_options_nonce'),
		toggleModuleButton: document.getElementById('smush-toggle-webp-button'),
		recheckStatusButton: document.getElementById('smush-webp-recheck'),
		recheckStatusLink: document.getElementById('smush-webp-recheck-link'),
		applyHtaccessButton: document.getElementById(
			'smush-webp-apply-htaccess'
		),
		removeHtaccessButton: document.getElementById(
			'smush-webp-remove-htaccess'
		),

		selectedServer: '',
		serverSelector: null,
		serverInstructions: [],

		init() {
			const self = this;
			// Define selected server.
			self.serverSelector = document.getElementById('webp-server-type');
			if (self.serverSelector) {
				self.selectedServer = self.serverSelector.value;
				// Server type changed.
				jQuery(self.serverSelector).on( 'change', function (e) {
					const value = e.currentTarget.value;
					self.hideCurrentInstructions();
					self.showServerInstructions(value);
					self.selectedServer = value;
				});

				// Init server instructions tabs.
				const tabs = document.querySelectorAll(
					'.webp-server-instructions'
				);
				for (let i = 0; i < tabs.length; i++) {
					const server = tabs[i].getAttribute('data-server');
					self.serverInstructions[server] = tabs[i];
				}

				self.showServerInstructions(self.selectedServer);
			}

			this.maybeShowDeleteAllSuccessNotice();
			this.maybeShowInstructionsNotice();

			/**
			 * Handles the "Deactivate" and "Get Started" buttons on the WebP page.
			 */
			if (this.toggleModuleButton) {
				this.toggleModuleButton.addEventListener('click', (e) =>
					this.toggleWebp(e)
				);
			}

			/**
			 * Handle "RE-CHECK STATUS' button click on WebP page.
			 */
			if (this.recheckStatusButton) {
				this.recheckStatusButton.addEventListener('click', (e) => {
					e.preventDefault();
					this.recheckStatus();
				});
			}

			/**
			 * Handle "RE-CHECK STATUS' link click on WebP page.
			 */
			if (this.recheckStatusLink) {
				this.recheckStatusLink.addEventListener('click', (e) => {
					e.preventDefault();
					this.recheckStatus();
				});
			}

			/**
			 * Handles the "Delete WebP images" button.
			 */
			if (document.getElementById('wp-smush-webp-delete-all')) {
				document
					.getElementById('wp-smush-webp-delete-all')
					.addEventListener('click', (e) => this.deleteAll(e));
			}

			/**
			 * Handle "Apply Rules' button click on WebP page.
			 */
			if (this.applyHtaccessButton) {
				this.applyHtaccessButton.addEventListener('click', (e) =>
					this.writeHtaccess(e, 'apply')
				);
			}

			/**
			 * Handle "Remove Rules' button click on WebP page.
			 */
			if (this.removeHtaccessButton) {
				this.removeHtaccessButton.addEventListener('click', (e) =>
					this.writeHtaccess(e, 'remove')
				);
			}
		},

		/**
		 * Toggle WebP module.
		 *
		 * @param {Event} e
		 */
		toggleWebp(e) {
			e.preventDefault();

			const button = e.currentTarget,
				doEnable = 'enable' === button.dataset.action;

			button.classList.add('sui-button-onload');

			const xhr = new XMLHttpRequest();
			xhr.open('POST', ajaxurl + '?action=smush_webp_toggle', true);
			xhr.setRequestHeader(
				'Content-type',
				'application/x-www-form-urlencoded'
			);

			xhr.onload = () => {
				const res = JSON.parse(xhr.response);

				if (200 === xhr.status) {
					if ('undefined' !== typeof res.success && res.success) {
						const scanPromise = this.runScan();
						scanPromise.onload = () => {
							location.search =
								location.search + '&notice=webp-toggled';
						}
					} else if ('undefined' !== typeof res.data.message) {
						this.showNotice(res.data.message);
					}
				} else {
					let message = window.wp_smush_msgs.generic_ajax_error;
					if (res && 'undefined' !== typeof res.data.message) {
						message = res.data.message;
					}
					this.showNotice(message);
				}

				button.classList.remove('sui-button-onload');
			};

			xhr.send(
				'param=' + doEnable + '&_ajax_nonce=' + this.nonceField[0].value
			);
		},

		/**
		 * re-check server configuration for WebP.
		 */
		recheckStatus() {
			const nonceField = document.getElementsByName(
				'wp_smush_options_nonce'
			);
			this.recheckStatusButton.classList.add('sui-button-onload');

			const xhr = new XMLHttpRequest();
			xhr.open('POST', ajaxurl + '?action=smush_webp_get_status', true);
			xhr.setRequestHeader(
				'Content-type',
				'application/x-www-form-urlencoded'
			);
			xhr.onload = () => {
				this.recheckStatusButton.classList.remove('sui-button-onload');
				let message = false;
				const res = JSON.parse(xhr.response);
				if (200 === xhr.status) {
					if ('undefined' !== typeof res.success && res.success) {
						if (
							res.data.is_configured !==
							this.recheckStatusButton.dataset.isConfigured
						) {
							// Reload the page when the configuration status changed.
							location.reload();
						}
					} else {
						message = window.wp_smush_msgs.generic_ajax_error;
					}
				} else {
					message = window.wp_smush_msgs.generic_ajax_error;
				}

				if (res && res.data && res.data.message) {
					message = res.data.message;
				}

				if (message) {
					this.showNotice(message);
				}
			};
			xhr.send('_ajax_nonce=' + nonceField[0].value);
		},

		deleteAll(e) {
			const button = e.currentTarget;
			button.classList.add('sui-button-onload');

			let message = false;
			const xhr = new XMLHttpRequest();
			xhr.open('POST', ajaxurl + '?action=smush_webp_delete_all', true);
			xhr.setRequestHeader(
				'Content-type',
				'application/x-www-form-urlencoded'
			);

			xhr.onload = () => {
				const res = JSON.parse(xhr.response);
				if (200 === xhr.status) {
					if ('undefined' !== typeof res.success && res.success) {
						const scanPromise = this.runScan();
						scanPromise.onload = () => {
							location.search =
								location.search + '&notice=webp-deleted';
						};
					} else {
						message = window.wp_smush_msgs.generic_ajax_error;
					}
				} else {
					message = window.wp_smush_msgs.generic_ajax_error;
				}

				if (res && res.data && res.data.message) {
					message = res.data.message;
				}

				if (message) {
					button.classList.remove('sui-button-onload');

					const noticeMessage = `<p style="text-align: left;">${message}</p>`;
					const noticeOptions = {
						type: 'error',
						icon: 'info',
						autoclose: {
							show: false,
						},
					};

					window.SUI.openNotice(
						'wp-smush-webp-delete-all-error-notice',
						noticeMessage,
						noticeOptions
					);
				}
			};

			xhr.send('_ajax_nonce=' + this.nonceField[0].value);
		},

		writeHtaccess(e, action) {
			e.preventDefault();

			const button = e.currentTarget;
			button.classList.add('sui-button-onload');

			const xhr = new XMLHttpRequest();
			xhr.open(
				'POST',
				ajaxurl + '?action=smush_webp_write_htaccess_rules',
				true
			);
			xhr.setRequestHeader(
				'Content-type',
				'application/x-www-form-urlencoded'
			);
			xhr.onload = () => {
				button.classList.remove('sui-button-onload');
				let message = false,
					type;
				const res = JSON.parse(xhr.response);
				if (200 === xhr.status) {
					if ('undefined' !== typeof res.success && res.success) {
						location.reload();
					}
				} else {
					message = window.wp_smush_msgs.generic_ajax_error;
				}

				if (res && res.data && res.data.message) {
					message = res.data.message;
					type = 'warning';
				}

				if (message) {
					this.showNotice(message, type);
				}
			};

			const ajaxAction = 'apply' === action ? 'apply' : 'remove',
				nonceField = document.getElementsByName(
					'wp_smush_options_nonce'
				);

			xhr.send(
				'write_action=' +
					ajaxAction +
					'&_ajax_nonce=' +
					nonceField[0].value
			);
		},

		/**
		 * Triggers the scanning of images for updating the images to re-smush.
		 *
		 * @since 3.8.0
		 */
		runScan() {
			const xhr = new XMLHttpRequest(),
				nonceField = document.getElementsByName(
					'wp_smush_options_nonce'
				);

			xhr.open('POST', ajaxurl + '?action=scan_for_resmush', true);
			xhr.setRequestHeader(
				'Content-type',
				'application/x-www-form-urlencoded'
			);

			xhr.send('_ajax_nonce=' + nonceField[0].value);

			return xhr;
		},

		/**
		 * Show message (notice).
		 *
		 * @param {string} message
		 * @param {string} type
		 */
		showNotice(message, type) {
			if ('undefined' === typeof message) {
				return;
			}

			const noticeMessage = `<p>${message}</p>`;
			const noticeOptions = {
				type: type || 'error',
				icon: 'info',
				dismiss: {
					show: true,
					label: window.wp_smush_msgs.noticeDismiss,
					tooltip: window.wp_smush_msgs.noticeDismissTooltip,
				},
				autoclose: {
					show: false,
				},
			};

			window.SUI.openNotice(
				'wp-smush-ajax-notice',
				noticeMessage,
				noticeOptions
			);
		},

		/**
		 * Show delete all webp success notice.
		 */
		maybeShowDeleteAllSuccessNotice() {
			if (!document.getElementById('wp-smush-webp-delete-all-notice')) {
				return;
			}
			const noticeMessage = `<p>${
				document.getElementById('wp-smush-webp-delete-all-notice')
					.dataset.message
			}</p>`;

			const noticeOptions = {
				type: 'success',
				icon: 'check-tick',
				dismiss: {
					show: true,
				},
			};

			window.SUI.openNotice(
				'wp-smush-webp-delete-all-notice',
				noticeMessage,
				noticeOptions
			);
		},

		maybeShowInstructionsNotice() {
			if (!document.getElementById('wp-smush-webp-instructions-notice')) {
				return;
			}
			const noticeContainer = document.getElementById(
					'wp-smush-webp-instructions-notice'
				),
				noticeMessage = `<p>${noticeContainer.dataset.message}</p>`,
				noticeOptions = {
					type: 'info',
					icon: 'info',
					dismiss: {
						show: true,
					},
				};

			window.SUI.openNotice(
				'wp-smush-webp-instructions-notice',
				noticeMessage,
				noticeOptions
			);
		},

		hideCurrentInstructions() {
			if (this.serverInstructions[this.selectedServer]) {
				this.serverInstructions[this.selectedServer].classList.add(
					'sui-hidden'
				);
			}
		},

		showServerInstructions(server) {
			if (typeof this.serverInstructions[server] !== 'undefined') {
				const serverTab = this.serverInstructions[server];
				serverTab.classList.remove('sui-hidden');
			}
		},
	};

	WP_Smush.WebP.init();
})();
