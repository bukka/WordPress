jQuery(document).ready( function($ ) {
	var $contactForm = $( '#contactForm' ),
		$map = $( '#map_address' );
	
	function showMessage(type, msg) {
		alert( msg );
	}

	$.extend( $.validator.messages, {
		required: $contactForm.data( 'msg-required' ),
		email: $contactForm.data( 'msg-email' ),
	});

	$contactForm
		.validate();

	$contactForm
		.submit( function( event ) {
			var $this = $( this );
			event.preventDefault();

			$.post( '/wp-admin/admin-ajax.php', $this.serialize() )
				.done( function( result ) {
					if ( result.success ) {
						showMessage( 'success', $this.data( 'msg-form-success' ) );
					} else if ( result.data ) {
						showMessage( 'warning', result.data );
					} else {
						showMessage( 'error', $this.data( 'msg-form-error' ) );
					}
				})
				.fail( function() {
					showMessage( 'error', $this.data( 'msg-form-error' ) );
				});
		});

	$map.gmap3( {
		map: {
			address: $map.data( 'address' ),
			options: {
				zoom: $map.data( 'zoom' ),
				draggable: true,
				mapTypeControl: true,
				mapTypeId: google.maps.MapTypeId.ROADMAP,
				scrollwheel: false,
				panControl: true,
				rotateControl: false,
				scaleControl: true,
				streetViewControl: true,
				zoomControl: true
			}
		},
		marker: {
			values:	[
				{
					address: $map.data( 'address' ),
					data: "<div class='mapinfo'>'" + $map.data( 'address' ) + "'</div>",
				}
			],
			options: {
				draggable: false,
			},
			events: {
				click: function( marker, event, context ) {
					var map = $( this ).gmap3("get"),
						infowindow = $( this ).gmap3( {
							get: {
								name: "infowindow"
							}
						} );
					
					if ( infowindow ) {
						infowindow.open( map, marker );
						infowindow.setContent( context.data );
					} else {
						$( this ).gmap3( {
							infowindow: {
								anchor:marker,
								options: {
									content: context.data
								}
							}
						});
					}
				},
				closeclick: function() {
					var infowindow = $( this ).gmap3( {
						get: {
							name: "infowindow"
						}
					} );
					
					if ( infowindow ) {
						infowindow.close();
					}
				}
			}
		}
	} );

} );