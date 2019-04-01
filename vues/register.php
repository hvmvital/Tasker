<div id="accueil">
<?php
	$u = "";
	if (ISSET($_REQUEST["username"]))
		$u = $_REQUEST["username"];
?>	
	<div id="loginFormCard" class="card border-warning mb-3" style="/*position:absolute; z-index:1000;*/ width: 40%; left: 30%; right: 30%;">
		<div class="card-body ">
			<div id="loginForm">
				<center><h2 class="display-4">Inscription</h2></center>
				<form action="" method="post">
					<div class="form-group row">
						<label for="username" class="col-sm-5 col-form-label-lg">Courriel :</label>
						<input name="username" type="text" class="col-sm-6 form-control" value="<?php echo $u?>" placeholder="example@gmail.com"/>
						<?php if (ISSET($_REQUEST["field_messages"]["courriel"])) 
								echo "<br /><span class=\"warningMessage\">".$_REQUEST["field_messages"]["username"]."</span>";
						?>
					</div>
					<div class="form-group row"> <!-- PRENOM -->
						<label for="prenom" class="col-sm-5 col-form-label-lg">Prenom :</label>
						<input name="prenom" type="text" class="col-sm-6 form-control" placeholder="Prenom"/>  <!-- value="<?php echo $prn?>"-->
						<?php if (ISSET($_REQUEST["field_messages"]["prenom"])) 
								echo "<br /><span class=\"warningMessage\">".$_REQUEST["field_messages"]["name"]."</span>";
						?>
					</div>
					<div class="form-group row"> <!-- NOM -->
						<label for="name" class="col-sm-5 col-form-label-lg">Nom :</label>
						<input name="name" type="text" class="col-sm-6 form-control" placeholder="Nom"/>  <!-- value="<?php echo $n?>"-->
						<?php if (ISSET($_REQUEST["field_messages"]["name"])) 
								echo "<br /><span class=\"warningMessage\">".$_REQUEST["field_messages"]["name"]."</span>";
						?>
					</div>
					
					<div class="form-group row">
						<label for="password" class="col-sm-5 col-form-label-lg">Mot de passe :</label>
						<input name="password" type="password" class="col-sm-6 form-control" placeholder="Mot de passe"/>
						<?php if (ISSET($_REQUEST["field_messages"]["password"])) 
								echo "<span class=\"warningMessage\">".$_REQUEST["field_messages"]["password"]."</span>";
						?>
					</div>
					<div class="form-group row">
						<label for="password" class="col-sm-5 col-form-label-lg">Copie du mot de passe    :</label>
						<input name="password2" type="password" class="col-sm-6 form-control" placeholder="Mot de passe"/>
						<?php if (ISSET($_REQUEST["field_messages"]["password2"])) 
								echo "<span class=\"warningMessage\">".$_REQUEST["field_messages"]["password2"]."</span>";
						?>
					</div>
					<div class="row">
						<input name="action" value="inscrire" type="hidden" />
						<button type="submit"
					style="margin-left:10px; "					
						class="col-6 btn btn-primary">OK</button>
											
				</form>
				
					<form class="col-6" 
						style="margin:0px; margin-left:-10px; margin-right:auto;" method="post" action="?action=">							
						<input name="action" value="default" type="hidden" />
						<button type="submit" class="col-12 btn btn-danger">Annuler</button>		
					</form>
				

				
			</div> 
		</div> <!-- end CardBody -->
	</div> <!-- end Card loginFormCard -->
</div> <!-- end #accueil -->
