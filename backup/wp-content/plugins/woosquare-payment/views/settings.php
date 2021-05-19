	<div class="wrap">
    <?php if ($successMessage): ?>
        <div class="updated"><p><?php echo $successMessage; ?></p></div>
    <?php endif; ?>
    <?php if ($errorMessage): ?>
        <div class="error"><p><?php echo $errorMessage; ?></p></div>
    <?php endif; ?>

    <div class="welcome-panel">
        <h3>Getting Started</h3>
        <p>Create a Square account if you don't have one</p>

        <p>You need a Square account to connect your WooCommerce store. If you don't have an account, go to <a target="_blank" href="https://squareup.com/signup">https://squareup.com/signup</a> to create one.</p>
        
		<p style="color:black;">
			<b>Follow instruction to connect Square account with WooSquare Payment <a href="http://bit.ly/2HOw5cl" target="_blank">Documentation.</a></b>
        </p>
        
           <form method="post">
            <table class="form-table">
			<?php
				$redirect_url = add_query_arg(
					array(
						'page'    => 'square-settings',
						'app_name'    => WOOSQU_PAY_APPNAME,
						'plug'    => WOOSQU_PAY_PLUGIN_NAME
					),
					admin_url( 'admin.php' )
				);

				$redirect_url = wp_nonce_url( $redirect_url, 'connect_woosquare', 'wc_woosquare_token_nonce' );

				$query_args = array(
					'redirect' => urlencode( urlencode( $redirect_url ) ),
					'scopes'   => 'MERCHANT_PROFILE_READ,PAYMENTS_READ,PAYMENTS_WRITE,INVENTORY_WRITE,CUSTOMERS_READ,CUSTOMERS_WRITE',
				);
				$url = WOOSQU_PAY_CONNECTURL.'/login/';  
				$production_connect_url = add_query_arg( $query_args, $url );

				$disconnect_url = add_query_arg(
					array(
						'page'              => 'square-settings',
						'app_name'    => WOOSQU_PAY_APPNAME,
						'plug'    => WOOSQU_PAY_PLUGIN_NAME,
						'disconnect_woosquare' => 1,
					),
					admin_url( 'admin.php' )
				); 
				$disconnect_url = wp_nonce_url( $disconnect_url, 'disconnect_woosquare', 'wc_woosquare_token_nonce' );

			?>
                <tbody>
                    <tr>
						<th>
							<?php esc_html_e( 'Connect/Disconnect', 'woocommerce-square' ); ?>
							<p>Connect through auth square to make system more smooth.</p>
						</th>
						<td>
								<?php if(!get_option('woo_square_access_token_cauth')){ ?>
								<a href="<?php echo esc_attr( $production_connect_url ); ?>" class="wc-square-connect-button">
									<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 44 44" width="30" height="30">
									  <path fill="#FFFFFF" d="M36.65 0h-29.296c-4.061 0-7.354 3.292-7.354 7.354v29.296c0 4.062 3.293 7.354 7.354 7.354h29.296c4.062 0 7.354-3.292 7.354-7.354v-29.296c.001-4.062-3.291-7.354-7.354-7.354zm-.646 33.685c0 1.282-1.039 2.32-2.32 2.32h-23.359c-1.282 0-2.321-1.038-2.321-2.32v-23.36c0-1.282 1.039-2.321 2.321-2.321h23.359c1.281 0 2.32 1.039 2.32 2.321v23.36z" />
									  <path fill="#FFFFFF" d="M17.333 28.003c-.736 0-1.332-.6-1.332-1.339v-9.324c0-.739.596-1.339 1.332-1.339h9.338c.738 0 1.332.6 1.332 1.339v9.324c0 .739-.594 1.339-1.332 1.339h-9.338z" />
									</svg>
									<span><?php esc_html_e( 'Connect with Square', 'woocommerce-square' ); ?></span>
								</a>
								<?php } else { ?>
									<a href="<?php echo esc_attr( $disconnect_url ); ?>" class='button-primary'>
										<?php echo esc_html__( 'Disconnect from Square', 'woocommerce-square' ); ?>
									</a>
								<?php } ?>
						</td>
					</tr>
                </tbody>
            </table>
            
        </form>
    </div>

    <?php if (get_option('woo_square_access_token_cauth')): ?>

        <div class="welcome-panel">
            <h3>Woo Square Settings</h3>
            <?php if ( $currencyMismatchFlag ){ ?>
                <br/>
                <div id="woo_square_error" class="error" style="background: #ddd;">
                    <p style="color: red;font-weight: bold;">The currency code of your Square application [ <?php echo $squareCurrencyCode ?> ] does not match WooCommerce [ <?php echo $wooCurrencyCode ?> ]</p>
                </div>
            <?php }?>
            <form method="post" <?php if ($currencyMismatchFlag): ?> style="opacity:0.5;pointer-events:none;" <?php endif; ?> >
                <input type="hidden" value="1" name="woo_square_settings" />
                <table class="form-table">
                    <tbody>
                        <?php if (get_option('woo_square_locations') != '' && get_option('woo_square_locations') != 'me' ): ?>
                            <tr>
                                <th scope="row"><label>Select Location</label></th>
                                <td>
                                        <select name="woo_square_location_id">
											<option value=""> Select your location </option>   
                                            <?php foreach (get_option('woo_square_locations') as $key => $location):?>
                                                    <option  <?php if (get_option('woo_square_location_id') == key($location)): ?>selected=""<?php endif; ?> value="<?php echo key($location); ?>"> <?php echo $location[key($location)]; ?> </option>
                                            <?php endforeach; ?>
                                        </select>
                                </td>
                            </tr>
                        <?php endif; ?>
                        
                        
                        


                    </tbody>
                </table>
                <p class="submit">
                    <input type="submit" value="Save Changes" class="button button-primary">
                </p>
            </form>

        </div>
		
		
	
	
		

			
<?php endif; ?>
	</div>
    <div class="welcome-panel txtcn">
        <h2 class='alncnt'> <a  target="_blank"href="https://goo.gl/LEJeQG" >WOOSQUARE PRO - WOOCOMMERCE AND SQUARE ULTIMATE INTEGRATION PLUGIN </a></h2>
        <p><h3>If you are looking for more functionality from Square api like synchronizing products between woocommerce and square and synchronizing order from square to woocommerce 
        and much more you can try our  <a  target="_blank"href="https://goo.gl/LEJeQG" >WooSquare Pro - WooCommerce Square Integration plugin</a>.</h3></p>
    </div>