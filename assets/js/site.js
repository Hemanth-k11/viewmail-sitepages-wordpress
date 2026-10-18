/* Viewmail Sitepages: Ad Preview Studio, Bidding Calculator and Demo Explorer. */
( function () {
	'use strict';

	function adStudio( box ) {
		if ( box.dataset.ready ) {
			return;
		}
		box.dataset.ready = '1';
		var field = function ( name ) {
			return box.querySelector( '[data-field="' + name + '"]' );
		};
		var show = function ( name ) {
			return box.querySelector( '[data-show="' + name + '"]' );
		};
		var multiplier = parseFloat( box.dataset.multiplier ) || 0;

		function update() {
			show( 'head' ).textContent = field( 'head' ).value || box.dataset.head;
			show( 'desc' ).textContent = field( 'desc' ).value || box.dataset.desc;
			show( 'area' ).textContent = field( 'area' ).value || box.dataset.area;
			show( 'url' ).textContent = field( 'url' ).value || box.dataset.url;
			var budget = parseFloat( field( 'budget' ).value ) || 0;
			show( 'reach' ).textContent = Math.round( budget * multiplier ).toLocaleString( 'en-IN' );
		}

		box.addEventListener( 'input', update );
		box.addEventListener( 'change', update );
		update();
	}

	function bidCalculator( box ) {
		if ( box.dataset.ready ) {
			return;
		}
		box.dataset.ready = '1';
		var budget = box.querySelector( '[data-field="budget"]' );
		var cpc = box.querySelector( '[data-field="cpc"]' );
		var output = box.querySelector( '[data-show="visitors"]' );
		var result = box.querySelector( '.vm-bid__result' );

		function update() {
			var price = parseFloat( cpc.value ) || 0;
			var money = parseFloat( budget.value ) || 0;
			if ( ! price ) {
				return;
			}
			output.textContent = Math.floor( money / price );
			result.classList.remove( 'vm-pulse' );
			void result.offsetWidth;
			result.classList.add( 'vm-pulse' );
		}

		budget.addEventListener( 'input', update );
		cpc.addEventListener( 'change', update );
	}

	function demoExplorer( box ) {
		if ( box.dataset.ready ) {
			return;
		}
		box.dataset.ready = '1';
		var select = box.querySelector( 'select' );
		var newTab = '1' === box.dataset.newTab;

		if ( window.Choices ) {
			new window.Choices( select, {
				searchEnabled: true,
				itemSelectText: '',
				shouldSort: false,
				searchResultLimit: 20,
				placeholder: true,
				placeholderValue: select.dataset.placeholder,
				searchPlaceholderValue: select.dataset.placeholder
			} );
		}

		select.addEventListener( 'change', function () {
			var url = select.value;
			if ( ! /^https?:\/\//i.test( url ) ) {
				return;
			}
			if ( newTab ) {
				window.open( url, '_blank', 'noopener' );
			} else {
				window.location.href = url;
			}
		} );
	}

	function init( root ) {
		root = root || document;
		root.querySelectorAll( '.vm-studio' ).forEach( adStudio );
		root.querySelectorAll( '.vm-bid' ).forEach( bidCalculator );
		root.querySelectorAll( '.vm-demos' ).forEach( demoExplorer );
	}

	if ( 'loading' === document.readyState ) {
		document.addEventListener( 'DOMContentLoaded', function () {
			init();
		} );
	} else {
		init();
	}

	// Live preview inside the Elementor editor (Elementor fires a jQuery event).
	function editorHooks() {
		[ 'viewmail-ad-studio', 'viewmail-bid-calculator', 'viewmail-demo-explorer' ].forEach( function ( name ) {
			window.elementorFrontend.hooks.addAction( 'frontend/element_ready/' + name + '.default', function ( $scope ) {
				init( $scope[ 0 ] );
			} );
		} );
	}
	if ( window.elementorFrontend && window.elementorFrontend.hooks ) {
		editorHooks();
	} else if ( window.jQuery ) {
		window.jQuery( window ).on( 'elementor/frontend/init', editorHooks );
	}
}() );
