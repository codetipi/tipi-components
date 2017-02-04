/**
 * Copyright: Codetipi
 * Plugin: Tipi Components
 */
(function($) { 'use strict';

	var $window = $( window );

	tinymce.create( 'tinymce.plugins.tipi_components_buttons', {

		init: function( editor, url )  {

			editor.addButton('tipi_components_buttons', {
			    tooltip      : editor.getLang( 'tipiComponents.mainTitle' ),
		        icon         : '-codetipi tipi-icon tipi-i-codetipi',
		        type         : 'menubutton',
		        menu         : [
		        	{
		        		text: editor.getLang( 'tipiComponents.columns' ),
		        		onclick: function() { editor.execCommand( 'plugin_command', true, 1 ); }
		        	},
		        	{
		        		text: editor.getLang( 'tipiComponents.buttons' ),
		        		onclick: function() { editor.execCommand( 'plugin_command', true, 2 ); }
		        	},
		        	{
		        		text: editor.getLang( 'tipiComponents.divider' ),
		        		onclick: function() { editor.execCommand( 'plugin_command', true, 3 ); }
		        	},
		        	{
		        		text: editor.getLang( 'tipiComponents.dropcap' ),
		        		onclick: function() { editor.execCommand( 'plugin_command', true, 4 ); }
		        	},
		        ]
			});

			editor.addCommand( 'plugin_command', function( a, b ) {

				editor.windowManager.open({
					title: editor.getLang( 'tipiComponents.mainTitle' ),
					id: 'tipi-components-insert-dialog',
					width: $window.width() * 0.66,
					height: ( $window.height() - 85 ) * 0.66,
					autoScroll: true,
					resizable: true,
					buttons: [{
						text: editor.getLang( 'tipiComponents.insert' ),
						id: 'tipi-components-button-insert',
						onclick: function( e ) {
							var insert = tipi_components_insert( b );
							editor.insertContent( insert );
							editor.windowManager.windows[0].close();
						},
					}, {
						text: editor.getLang( 'tipiComponents.close' ),
						id: 'tipi-components-cancel',
						onclick: 'close'
					}],
				});

				tipi_components_box( b, editor );

			});

		}

	});

	tinymce.PluginManager.add( 'tipi_components_buttons', tinymce.plugins.tipi_components_buttons );

	function tipi_components_box( component, ed ) {

		var dialog = $( '#tipi-components-insert-dialog-body' );
		dialog.append( '<div class="tipi-spinner-wrap"><i class="tipi-icon tipi-i-rotate-left"></i></div>' );

		$.post( ajaxurl, {
			action: 	'tipi_components_buttons_insert_dialog',
			component: 	component
		}, function( data ) {
			if (  data.charAt( data.length - 1) === '0' ) {
				data = data.slice(0, -1);
			}
			dialog.append( data );
			$( '.tipi-spinner-wrap' ).hide();
			$( '#mce-modal-block' ).on( 'click', function(){
				ed.windowManager.windows[0].close();
			});
			$('.tipi-color-field').wpColorPicker();
		});

	}

	function tipi_components_insert( b ) {

		var output, $body = $('#tipi-components-insert-dialog-body');

		switch (b) {
		    case 2:
		        output = '[tipi_button';
		    	output += ' url="' + $body.find('.column-url').val() + '"';
		    	output += ' size="' + $body.find('.column-size').val() + '"';
		    	output += ' color="' + $body.find('.column-color').val() + '"';
		    	output += ' style="' + $body.find('.column-style').val() + '"';
		    	output += ' alignment="' + $body.find('.column-alignment').val() + '"';
		    	output += ' target="' + $body.find('.column-target').val() + '"';
		    	output += ' rel="' + $body.find('.column-rel').val() + '"';
		    	output += ']';

		    	if ( $body.find('.main-content').val() !== '' ) {
		    		output += $body.find('.main-content').val();
		    	}
		    	output += '[/tipi_button]';
		        break;
		    case 3:
		        output = '[tipi_divider';
		    	output += ' style="' + $body.find('.column-style').val() + '"]';

		    	if ( $body.find('.main-content').val() !== '' ) {
		    		output += $body.find('.main-content').val();
		    		output += '[/tipi_divider]';
		    	}

		        break;
		    case 4:
		        output = '[tipi_dropcap';
		    	output += ' style="' + $body.find('.column-style').val() + '"]';

		    	if ( $body.find('.main-content').val() !== '' ) {
		    		output += $body.find('.main-content').val();
		    	}

		    	output += '[/tipi_dropcap]';
		        break;
		    default:
		    	output = '[tipi_column';
		    	output += ' size="' + $body.find('.column-size').val() + '"';

		    	if ( $body.find('#last').is(':checked') ) {
		    		output += ' position="last"';
		    	}

		    	output += ']';

		    	if ( $body.find('#content').val() !== '' ) {
		    		output += $body.find('#content').val();
		    	}

		    	output += '[/tipi_column]';
		        break;
		}
		return output;

	}

})(jQuery);