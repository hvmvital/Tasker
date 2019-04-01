


<!-- SECTION PROJETS -->
<section class="lastProjects">
<div class="sectionTitle" >Les Invitations envoyees</div>
<div class="row">


 <?php
	require_once('./modele/classes/InvitationEnvoye.class.php');
	require_once('./modele/classes/ListeInvitEnv.class.php');
	require_once('./modele/InvitEnvDAO.class.php');
	$dao = new InvitEnvDAO();

	$liste = $dao->findAll();
	while ($liste->next())
	{
		$p = $liste->getCurrent();
		if ($p!=null)
		{
			echo '
			<div class="col-xs-6 col-sm-6 col-md-4 col-lg-3">
				<div class="card text-dark bg-warning mb-3">
					<div class="card-header" style="padding-bottom: 0px;">
						<h5 class="card-title" >'.$p->getNumInvEnv().'</h5>
					</div>
					<div class="card-body">
						<p class="card-text ">'.$p->getNumProjet().'</p>
						' ; if (ISSET($_SESSION["connected"]))
						{  echo' 
						<form method="post" action="?action=projet">
						    <input type="hidden" name="numeroProjet" value="'.$p->getNumProjet().'">
						    <input  type="submit" value="Details" class="col col-sm-12 col-lg-12 btn btn-primary btn-sm" style="margin:0 5px; margin-left:auto; margin-right:auto;" >
						</form>'
						;} 
						echo '
					</div>
				</div>
			</div>';
			
			

		
		}
	}
	//echo $var_value = $_POST['numeroProjet'];
	//$_SESSION['numProjet'] =   $p->getNumProjet();
	//$_SESSION['numProjet'] = "P02";
	//$_SESSION['numProjet'] = $var_value;
	
 ?>
 <!--
 <div class="card-columns">
 
    
  <div class="card p-3 text-right">
   <blockquote class="blockquote mb-0">
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
      <footer class="blockquote-footer">
        <small class="text-muted">
          Someone famous in <cite title="Source Title">Source Title</cite>
        </small>
      </footer>
    </blockquote>
  </div>
  
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Card title</h5>
      <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
      <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
    </div>
  </div>
</div>
 </div>
</section>
 -->


