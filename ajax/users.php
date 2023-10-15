<?php
    session_start();
    $_SESSION['organization_id'];
    include_once "../../_config.php";
    $outgoing_id = $_SESSION['login_id'];
    // $sql = "SELECT * FROM registation WHERE NOT login_id = {$outgoing_id} ORDER BY login_id DESC";
 $sql="SELECT  registation.status_online ,registation.login_id, registation.first_name, registation.last_name, org_role_access.organization_id
 FROM org_role_access
 INNER JOIN registation
 ON org_role_access.login_id=registation.login_id
 WHERE org_role_access.organization_id='".$_SESSION['organization_id']."' AND NOT org_role_access.login_id='".$_SESSION['login_id']."'  ORDER BY login_id DESC";


 $query = mysqli_query($conn, $sql);

    $output = "";
    if(mysqli_num_rows($query) == 0){
        $output .= "No users are available to chat";
    }elseif(mysqli_num_rows($query) > 0){
        include_once "data.php";
    }
    echo $output;

?>