<?php
    session_start();
    include_once "../../_config.php";

    $outgoing_id = $_SESSION['login_id'];
    $searchTerm = mysqli_real_escape_string($conn, $_POST['searchTerm']);

//    echo $sql = "SELECT * FROM registation WHERE NOT login_id = {$outgoing_id} AND (first_name LIKE '%{$searchTerm}%' OR last_name LIKE '%{$searchTerm}%') ";
     $sql="SELECT registation.status_online, registation.login_id, registation.first_name, registation.last_name, org_role_access.organization_id
    FROM org_role_access
    INNER JOIN registation
    ON org_role_access.login_id=registation.login_id
    WHERE org_role_access.organization_id='3' AND (first_name Like '%{$searchTerm}%' OR last_name LIKE '%{$searchTerm}%')";    
$output = "";
    $query = mysqli_query($conn, $sql);
    if(mysqli_num_rows($query) > 0){
        include_once "data.php";
    }else{
        $output .= 'No user found related to your search term';
    }
    echo $output;
?>