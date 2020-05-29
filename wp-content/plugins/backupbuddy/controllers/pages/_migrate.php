<?php
pb_backupbuddy::$ui->title( 'Remote Site Migration' );



// Set whether or not the migration should auto-begin or wait for user to click to begin.
$auto_run = false;


?>


<script type="text/javascript">
	keep_polling = 1;
	pb_step = '1';
	
	
	jQuery(document).ready(function() {
			// Wait 2 seconds before first poll.
			//setTimeout( 'backupbuddy_poll()' , 2000 );
			//setInterval( 'blink_ledz()' , 600 );
			
			
			jQuery( '#pb_backupbuddy_migration_form' ).submit(function() {
				if ( jQuery('#pb_backupbuddy_url').val() == '' ) { // Make sure URL is entered.
					alert( 'Invalid site URL.' );
					return false;
				}
				
				pb_step = '1'; // Set to start over.
				backupbuddy_poll();
				return false;
			});
	});
	
	
	

	
	
	
	function backupbuddy_poll() {
		jQuery('#pb_backupbuddy_loading').show();
		jQuery.ajax({
			url:		'<?php echo pb_backupbuddy::ajax_url( 'migrate_status' ); ?>',
			type:		'post',
			dataType:	'json',
			data:		{
							step: 'step' + pb_step,
							destination: '<?php echo pb_backupbuddy::_GET( 'destination' ); ?>',
							backup_file: '<?php echo pb_backupbuddy::_GET( 'callback_data' ); ?>',
							url: jQuery('#pb_backupbuddy_url').val(),
						},
			error:		function( jqXHR, textStatus, errorThrown ) {
				jQuery('#pb_backupbuddy_loading').hide();
				alert( 'Error or invalid formatted server response. Response: `' + jqXHR.responseText + '`; Status: `' + textStatus + '`; Error thrown: `' + errorThrown + '`.');
			},
			success: function( data ) { // data contains json response objects.
				stop_polling = false;
				
				if ( pb_step == '0' ) { // Finished. Stop polling.
					
					stop_polling = true;
					
				} else if ( pb_step == '1' ) { // Step 1 - Checks if backup and importbuddy are done transferring yet.
					
					jQuery('#pb_backupbuddy_loading').hide();
					jQuery( '#pb_backupbuddy_statusmsg' ).html( data.status_message );
					
				} else if ( pb_step == '2' ) { // Step 2 - Checks to see if URL seems to point to importbuddy.php by accessing http://url.com/importbuddy.php?api=ping serverside to look for pong.
					
					jQuery('#pb_backupbuddy_loading').hide();
					jQuery( '#pb_backupbuddy_statusmsg' ).html( data.status_message );
					if ( data.status_code == 'success' ) {
						
						jQuery( '#pb_backupbuddy_iframe' ).attr( 'src', data.import_url ); // jQuery('#pb_backupbuddy_url').val()
						jQuery( '#pb_backupbuddy_migration_begin' ).attr('disabled','disabled');
						
						jQuery( '.pb_backupbuddy_start_migration' ).slideUp();
					} else {
						
					}
					stop_polling = true;
					
				
				} else { // Unknown step.
					
					jQuery('#pb_backupbuddy_loading').hide();
					ale