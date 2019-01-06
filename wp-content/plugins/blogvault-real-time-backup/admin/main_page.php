<div id="content-wrapper">
	<div class="mui-container-fluid">
		<?php $accounts = $this->account->allAccounts();?>
			<div class="mui-panel" style="width:800px; margin:0 auto;border:1px solid #CCC;">
				<div class="mui--text-body1" style="text-align:center;font-size:18px;">Accounts associated with this website.</div><br/>
				<table cellpadding="10" style="width:700px; margin:0 auto;border:1px solid black;">
					<tr style="text-align:center;font-size:15px;border: 1px solid black;"> <th> Account Email</th><th>Last Synced At</th><th></th></tr>
						<?php
							$nonce = wp_create_nonce( 'bvnonce' );
							foreach($accounts as $key => $value){
						?>
						<form dummy=">" action=""  style="padding:0 2% 2em 1%;" method="post">
							<input type='hidden' name='bvnonce' value="<?php echo $nonce ?>" />
							<input type='hidden' name='pubkey' value="<?php echo $key ?>" />
							<tr style="text-align:center;font-size:15px;border: 1px solid black;"> 
								<td >
									<?php echo $value['email'] ?>
								</td>
								<td>
									<?php echo date('Y-m-d H:i:s', $value['lastbackuptime']); ?>
								</td>
								<td >
									<input type='submit' class="button-primary" value='Disconnect' name='disconnect'>
								</td>
							</tr>
						</form>
				<?php } ?>
				</table>
			<div class="mui-col-md-12 mui-col-md-offset-3" style="padding-top:2%;">
				<a class="mui-btn mui-btn--raised mui-btn--primary" href=<?php echo $this->bvmain->appUrl(); ?> target="_blank">Visit Dashboard</a>
				<a class="mui-btn mui-btn--raised mui-btn--primary" href=<?php echo $this->mainUrl('&add_account=true'); ?> >Connect New Account</a>
      </div>
		</div>
	</div>
</div>