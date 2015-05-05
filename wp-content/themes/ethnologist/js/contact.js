jQuery(document).ready( function($) {
	var $contactForm = $( '#contactForm' ),
		$map = $( '#map_address' );
	
	$.extend( $.validator.messages, {
		required: $contactForm.data( 'msg-required' ),
		email: $contactForm.data( 'msg-email' ),
	});
	
	$( '#contactForm' ).validate();

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