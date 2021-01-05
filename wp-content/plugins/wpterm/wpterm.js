/*
 +=====================================================================+
 |      __        ______ _____                                         |
 |      \ \      / /  _ \_   _|__ _ __ _ __ ___                        |
 |       \ \ /\ / /| |_) || |/ _ \ '__| '_ ` _ \                       |
 |        \ V  V / |  __/ | |  __/ |  | | | | | |                      |
 |         \_/\_/  |_|    |_|\___|_|  |_| |_| |_|                      |
 |                                                                     |
 | (c) Jerome Bruandet ~ https://nintechnet.com/                       |
 +=====================================================================+
*/
function wpterm_preview( what, where, newvalue ) {

	if ( what == 'color' ) {
		if ( newvalue.match(/^[a-f0-9]+$/) ) {
			newvalue =  '#' + newvalue;
		}
		if ( where == 'background' ) {
			document.getElementById('textarea-test').style.backgroundColor = newvalue;
		} else if ( where == 'color' ) {
			document.getElementById('textarea-test').style.color = newvalue;
		}

	} else if ( what == 'fontsize' ) {
		if (! newvalue.match(/^(?:9|1[0-9]|20)$/) ) {
			newvalue =  '13px';
		} else {
			newvalue += 'px';
		}
		document.getElementById('textarea-test').style.fontSize = newvalue;

	} else if ( what == 'fontface' ) {
		if ( newvalue.match(/^[a-f0-9]+$/) ) {
			newvalue =  'Consolas,Monaco,monospace';
		}
		document.getElementById('textarea-test').style.fontFamily = newvalue;

	} else if ( what == 'fontweight' ) {
		if ( document.getElementById( where ).checked == true ) {
			newvalue =  'bold';
		}else{
			newvalue = 'normal';
		}
		document.getElementById('textarea-test').style.fontWeight = newvalue;
	}
}

function bell_preview( choice, what ) {
	if ( what == 'beep' ) {
		if ( choice.checked ) {
			// Audible bell (not compatible with IE):
			var snd = new Audio("data:audio/wav;base64,UklGRkgBAABXQVZFZm10IBAAAAABAAEAESsA" +
			"ABErAAABAAgAZGF0YSQBAACBf359cm9rgaB5lQOF/6NVG6Gop49deZGkmF1IkaOhYUSKpoZqTE+c" +
			"op5tUnSNkYZ1gIeOfXt7iIeEd3mDhISCfoF8fYKCgH+HiYV9foWJhn9/gIeGgXx/hYZ+fX6FgH9/" +
			"f3+CgoF7eYKMhn99gYV/fn6FhoF/f399f4OChIF9gYGBe4CDhIN9fn+CgH6AgoSAgICAgIGAf4F/" +
			"f4CBfoB/gIF/gICAgH9+gYGAgIF/gH9+gX9/f4F/gYJ/gH6AgICAf39/f4F/f3+BfoF/gH5/gYB/" +
			"gIF/enl4fH2Bg4aGhYJ/fn9+gYKEg4KAfnx9f4CAg4KBgIB9f4CBg4OCgYGBgICBgYGAgoCAgIB/" +
			"gX+Bf4CAgYCAf4GBgYCBgICBgoGBgIB/");
			snd.play();
		}
	} else {
		if ( choice.checked ) {
			jQuery( '#visual-bell' ).addClass( 'error' );
		} else {
			jQuery( '#visual-bell' ).removeClass( 'error' );
		}
	}
}

/* ================================================================== */

function show_license() {

	jQuery("#wpterm-license").slideDown();
	jQuery("#wpterm-license-button").slideUp();

}

/* ================================================================== */
// EOF
