<?php defined('ABSPATH') or die("No script kiddies please!");?>
<?php if($connected) { 
    //echo '<pre>';
//    print_r($this->mailchimp->get_lists());
//    echo '</pre>';
    ?>
    <br /><br /><br /><br />
	<div class="edn-inner-main-title"><?php _e( 'MailChimp Data' ,APEXNB_TD ); ?></div>
	<p><?php _e( 'The table below shows your MailChimp lists data. If you applied changes to your MailChimp lists, please use the following button to renew your cached data.', APEXNB_TD ); ?></p>

	<form method="post" action="">
		<input type="hidden" name="edn-renew-cache" value="1" />

		<p>
			<input type="submit" value="<?php _e( 'Renew MailChimp lists', APEXNB_TD ); ?>" class="button" />
		</p>
	</form>

	<div class="edn-lists-overview">
	<?php if( empty( $lists ) || ! is_array( $lists ) ) { ?>
		<p><?php _e( 'No lists were found in your MailChimp account', APEXNB_TD ); ?>.</p>
	<?php } else {

		printf( '<p>' . __( 'A total of %d lists were found in your MailChimp account.', APEXNB_TD ) . '</p>', count( $lists ) );

		foreach ( $lists as $list ) { ?>

			<table class="widefat" cellspacing="0">
				<tr>
					<td colspan="2"><h3><?php echo esc_html( $list->name ); ?></h3></td>
				</tr>
				<tr>
					<th width="150">List ID</th>
					<td><?php echo esc_html( $list->id ); ?></td>
				</tr>
				<tr>
					<th># of subscribers</th>
					<td><?php echo esc_html( $list->subscriber_count ); ?></td>
				</tr>
				<tr>
					<th>Fields</th>
					<td style="padding: 0; border: 0;">
						<?php if ( ! empty( $list->merge_vars ) && is_array( $list->merge_vars ) ) { ?>
							<table class="widefat fixed" cellspacing="0">
								<thead>
								<tr>
									<th>Name</th>
									<th>Tag</th>
									<th>Type</th>
								</tr>
								</thead>
								<?php foreach ( $list->merge_vars as $merge_var ) { ?>
									<tr title="<?php printf( __( '%s (%s) with field type %s.', APEXNB_TD ), esc_html( $merge_var->name ), esc_html( $merge_var->tag ), esc_html( $merge_var->field_type ) ); ?>">
										<td><?php echo esc_html( $merge_var->name );
											if ( $merge_var->req ) {
												echo '<span style="color:red;">*</span>';
											} ?></td>
										<td><code><?php echo esc_html( $merge_var->tag ); ?></code></td>
										<td><?php echo esc_html( $merge_var->field_type ); ?></td>
									</tr>
								<?php } ?>
							</table>
						<?php } ?>
					</td>
				</tr>
				<?php if ( ! empty( $list->interest_groupings ) && is_array( $list->interest_groupings ) ) { ?>
					<tr>
						<th>Interest Groupings</th>
						<td style="padding: 0; border: 0;">
							<table class="widefat fixed" cellspacing="0">
								<thead>
								<tr>
									<th>Name</th>
									<th>Groups</th>
								</tr>
								</thead>
								<?php foreach ( $list->interest_groupings as $grouping ) { ?>
									<tr title="<?php esc_attr( printf( __( '%s (ID: %s) with type %s.', APEXNB_TD ), $grouping->name, $grouping->id, $grouping->form_field ) ); ?>">
										<td><?php echo esc_html( $grouping->name ); ?></td>
										<td>
											<ul class="ul-square">
												<?php foreach ( $grouping->groups as $group ) { ?>
													<li><?php echo esc_html( $group->name ); ?></li>
												<?php } ?>
											</ul>
										</td>
									</tr>
								<?php } ?>
							</table>

						</td>
					</tr>
				<?php } ?>
			</table>
			<br style="margin: 20px 0;" />
		<?php } // end foreach $lists
	} // end if empty ?>
	</div>

	<form method="post" action="">
		<input type="hidden" name="edn-renew-cache" value="1" />

		<p>
			<input type="submit" value="<?php _e( 'Renew MailChimp lists', APEXNB_TD ); ?>" class="button" />
		</p>
	</form>
<?php } ?>