
<?php

include('connect_test_ajax.php');

if (!ISSET($_SESSION)) session_start();

//if(isset($_POST['view'])){



//if($_POST["view"] != '')
//{
//    $update_query = "UPDATE comments SET comment_status = 1 WHERE comment_status=0";
//    mysqli_query($con, $update_query);
//}

$query = "SELECT * FROM invitationenvoyee WHERE ETAT='en_attente' and COURRIEL = '".$_SESSION["connected"]."'";
$result = mysqli_query($con, $query);
$output = '';
if(mysqli_num_rows($result) > 0)
{
	while($row = mysqli_fetch_array($result))
		{
			$output .= '
			<a href="?action=invitationsEnvoyees" class="text-bold text-italic">
			<li class="p-1">
		   			   
			   <small> Invitation  reçue #'.$row["NUM_INVITATION_ENVOYEE"].'</small>
			   <hr class="m-0 p-0"/>
		   
			</li>
			</a>
			';
		}
} else {
     $output .= '
     <li><a href="?action=invitationsEnvoyees" class="text-bold text-italic">Pas de notifications</a></li>';
}

				//"SELECT * FROM projet INNER JOIN invitationenvoyee ON projet.NUM_PROJET = invitationenvoyee.NUM_PROJET WHERE projet.COURRIEL = :x "
				
				//$status_query = "SELECT * FROM invitationrecue AS ir 
				//		FULL JOIN invitationenvoyee AS ie ON ir.COURRIEL = t2.COURRIEL 
				//		WHERE ETAT='en_attente' and COURRIEL = '".$_SESSION["connected"]."'";
				
				
				
				
$status_query = "SELECT * FROM invitationenvoyee WHERE ETAT='en_attente' and COURRIEL = '".$_SESSION["connected"]."'";

$result_query = mysqli_query($con, $status_query);
$count = mysqli_num_rows($result_query);
$data = array(
    'notification' => $output,
    'unseen_notification'  => $count
);

echo json_encode($data);

//}

?>