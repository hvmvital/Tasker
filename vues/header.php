<!DOCTYPE html>
<html>
<head>
		<meta http-equiv="Content-Language" content="fr-ca">
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		
		<title>TASKER - gestion de tâches</title>	
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
		<link rel="stylesheet" href="bootstrap-4.1.3-dist/css/bootstrap.min.css" > 
		<link rel="stylesheet" type="text/css" href="css/style.css?<?php echo time(); ?>" />
		<link rel="shortcut icon" type="image/png" href="img/favicon.png"/>
		

		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="bootstrap-4.1.3-dist\js/bootstrap.min.js"></script>
		
		<script type="text/javascript" src="scripts.js"></script>
</head>
<body>


<header>

	<nav  class="navbar navbar-expand-md navbar-light">
    <a href="index.php" class="navbar-brand d-flex w-50 mr-auto">TASKER</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsingNavbar3">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="navbar-collapse collapse w-100" id="collapsingNavbar3">
        <ul class="navbar-nav w-100 justify-content-center">
			<!-- 
			<li class="nav-item"> 
				<a class="nav-link" href="index.php">ACCUEIL</span></a> 
			</li>
			-->
		    <li class="nav-item"> 
				<a class="nav-link" href="?action=listeProjets">PROJETS</a> 
			</li>

        </ul>
		<ul  class="nav navbar-nav ml-auto w-100 justify-content-end">
			<li class="dropdown">
			   <a href="#" class="dropdown-toggle notif_toggle" data-toggle="dropdown">
					<span class=" count" style="border-radius:10px;"></span>
					<img src='./img/icons8-alarm-filled-48.png' 
							width="30" tooltip="Déconnecter" class="d-inline-block align-top" 
							 
							onmouseover="this.src='./img/icons8-alarm-filled-48.png'" 
							onmouseout="this.src='./img/icons8-alarm-filled-48.png'">
				    
				   
				   
			   </a>
				<ul class="dropdown-menu notif_menu"></ul>
			</li>
        </ul>
        <ul  class="nav navbar-nav ml-auto w-100 justify-content-end">
            	
	  
			   <!--<li> <a href="index.php"> Contact </a> </li>-->
		
				<?php
					if (!ISSET($_SESSION)) session_start();
					if (ISSET($_SESSION["connected"]))
					{
				?>
				<li class="nav-item dropdown">
			        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			        <img style="width: 36px;" 
										  src='./img/icons8-customer-filled-100.png'>
			        <?php echo $_SESSION["connected"]; ?>
			        </a>
			        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
						
						<a class="dropdown-item" href="?action=mesProjets"> Mes Projets </a> 
						<a class="dropdown-item" href="?action=invitationsEnvoyees"> Mes Invitations</a> 

			         <!--<a class="dropdown-item" href="?action=invitationsEnvoyees"> Mes Invitations envoyees </a> -->

			         <a class="dropdown-item" href="?action=deconnecter" >
							
							   
							<img src='./img/icons8-export-64.png' 
							width="30" tooltip="Déconnecter" class="d-inline-block align-top" 
							 
							onmouseover="this.src='./img/icons8-export-filled-64.png'" 
							onmouseout="this.src='./img/icons8-export-64.png'">

							Déconnection
					</a>


			      
			     </li>
							
				<?php	
					}
					else
					{
				?>
					
					<li class="nav-item">
						
						<a class="nav-link" href="?action=connecter" title="Se connecter">
								  <img width="36" 
								  src='./img/icons8-enter-64.png' 
								  onmouseover="this.src='./img/icons8-enter-filled-64.png'" 
								  onmouseout="this.src='./img/icons8-enter-64.png'">
						</a>

					</li>
					<li  class="nav-item">
						<a class="nav-link" href="?action=inscrire" title="S'inscrire">
								  <img width="36" 
								  src='./img/icons8-add-user-male-64.png' 
								  onmouseover="this.src='./img/icons8-add-user-male-filled-64.png'" 
								  onmouseout="this.src='./img/icons8-add-user-male-64.png'">
						</a>
						
					</li>

					<?php	
						}
					?>	
        </ul>
    </div>
	</nav>

	

</header>	
<script>
$(document).ready(function(){
 
 function load_unseen_notification(view = '')
 {
  $.ajax({
   url:"fetch_test_ajax.php",
   method:"POST",
   data:{view:view},
   dataType:"json",
   success:function(data)
   {
    $('.notif_menu').html(data.notification);
    if(data.unseen_notification > 0)
    {
     $('.count').html(data.unseen_notification);
    }
   }
  });
 }
 
 load_unseen_notification();
 
 $('#comment_form').on('submit', function(event){
  event.preventDefault();
  if($('#subject').val() != '' && $('#comment').val() != '')
  {
   var form_data = $(this).serialize();
   $.ajax({
    url:"insert.php",
    method:"POST",
    data:form_data,
    success:function(data)
    {
     $('#comment_form')[0].reset();
     load_unseen_notification();
    }
   });
  }
  else
  {
   alert("Both Fields are Required");
  }
 });
 
 $(document).on('click', '.notif_toggle', function(){
  $('.count').html('');
  load_unseen_notification('yes');
 });
 
 setInterval(function(){ 
  load_unseen_notification();; 
 }, 5000);
 
});
</script>
