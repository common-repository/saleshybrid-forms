function receiveSaleshybridFormsCloseMessage(event) {
	// We want to close the lightbox when suitable message is sent to us
	// from the iframe window.
	
	// We use special namespaced message name so it does not clash with other plugins etc.
	if (event.data === 'saleshydridforms_close') {
		var current = jQuery.featherlight.current();

		if (current) {
			current.close();
		}
	}
}

jQuery(document).ready(function() {

	// Set listener for close event from the iframe.
	window.addEventListener("message", receiveSaleshybridFormsCloseMessage, false);

	// Go over and inspect all web links that are present
	jQuery('a').each(function(_i, link) {
	
		// Get link hostname
		var hostName = link.hostname;

		// If this link points to Saleshybrid Forms site (saleshydridforms.fi), then we
		// want to open it in a featherlight lightbox inside iframe. This improves
		// user experience for sites that have Saleshybrid integrations present.

		if (hostName.indexOf('saleshybridforms.fi') !== -1) {

			// Determine how wide lightbox fits the screen. We want not too wide nor too slim.
			var pageWidth = jQuery(window).width();

			if (pageWidth > 1167) {
				// Very wide
				var lightboxWidth = 920;
			} else if (pageWidth > 760) {
				var lightboxWidth = 580;
			} else if (pageWidth > 520) {
				var lightboxWidth = 460;
			} else {
				var lightboxWidth = 348;
			}

			// Turn into lightbox link by adding featherlight stuff
			link.setAttribute('data-featherlight', 'iframe');
			link.setAttribute('data-featherlight-iframe-height', '640');
			link.setAttribute('data-featherlight-iframe-width', lightboxWidth);
			link.setAttribute('data-featherlight-iframe-style', 'border:none');
		} else {
			// Do nothing, this link does not point to Saleshybrid Forms site.
		}

	});

	// Simulate close message from iframe
	//setTimeout(receiveSaleshybridFormsCloseMessage.bind(null, {data: 'saleshydridforms_close'}), 5000);

});	