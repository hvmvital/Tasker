
	
<?php
	if (ISSET($_REQUEST["global_message"]))
	   $msg="<span class=\"warningMessage\">".$_REQUEST["global_message"]."</span>";
	$u = "";
	if (ISSET($_REQUEST["username"]))
		$u = $_REQUEST["username"];
?>	

<section>
	
	<div id="loginFormCard" class="card border-warning mb-3" style="/*position:absolute; z-index:1000; */width: 40%; left: 30%; right: 30%;">
		<div class="card-body pt-0">
		<div class="sectionTitle mb-4" >Connexion</div>
			<div id="loginForm" >
			
			<form action="" method="post">
				<div class="form-group row p-2">
					<label for="courriel" class="col-12 col-sm-12 col-md-5 col-lg-4 col-form-label-lg mb-1 pb-0">Courriel:</label>
					<input name="courriel" type="text" class="col-12 col-sm-12 col-md-6 col-lg-7 form-control form-control-md mb-1" value="<?php echo $u?>" />
					<?php if (ISSET($_REQUEST["field_messages"]["courriel"])) 
							echo '<div class="alert alert-danger border-danger col-12" role="alert">
									  '.$_REQUEST["field_messages"]["courriel"].'
								</div>';
					?>
				</div>
				<div class="form-group row p-2">
					<label for="password" class="col-12 col-sm-12 col-md-5 col-lg-4 col-form-label-lg mb-1 pb-0">Mot de passe:</label>
					<input name="password" type="password" class="col-12 col-sm-12 col-md-6 col-lg-7 form-control form-control-md mb-1"/>
					<?php if (ISSET($_REQUEST["field_messages"]["password"]))
								echo '<div class="alert alert-danger border-danger col-12" role="alert">
									  '.$_REQUEST["field_messages"]["password"].'
									</div>';						
							
					?>
				</div>
				<div class="row">
					<input name="action" value="connecter" type="hidden" />
					<button type="submit"
				style="margin-left:10px; "					
					class="col-6 btn btn-primary">OK</button>
										
			</form>
				
					<form class="col-6" 
						style="margin:0px; margin-left:-10px; margin-right:auto;" method="post" action="?action=">							
						
						<button type="submit" class="col-12 btn btn-danger">Annuler</button>		
					</form>

			
				</div>	
			</div>
		</div>
	</div>	
</div>
<section>
	


