<?php 
    session_start();
    if(isset($_SESSION['login_id'])){
        include_once "../../_config.php";
        $outgoing_id = $_SESSION['login_id'];
        $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
        $output = "";
        $s="UPDATE messages SET seen='seen' WHERE (outgoing_msg_id = {$incoming_id} AND incoming_msg_id = {$outgoing_id})";
        mysqli_query($conn,$s);

        $sql = "SELECT * FROM messages LEFT JOIN registation ON registation.login_id = messages.outgoing_msg_id
                WHERE (outgoing_msg_id = {$outgoing_id} AND incoming_msg_id = {$incoming_id})
                OR (outgoing_msg_id = {$incoming_id} AND incoming_msg_id = {$outgoing_id}) ORDER BY msg_id";
        $query = mysqli_query($conn, $sql);
        if(mysqli_num_rows($query) > 0){
            while($row = mysqli_fetch_assoc($query)){
                $images="";
                $check=$row['seen'];
                if($check=='seen'){
                    $check='<i class=" fas fa-duotone fas fa-check" style="color:#E7717D;"></i><i class=" fas fa-duotone fas fa-check" style="color:#E7717D;"></i>';
                }
                else{
                    $check='<i class=" fas fa-duotone fas fa-check" style="color:green;"></i>';
                }
                $s22=mysqli_query($conn,"SELECT * FROM `images` WHERE `login_id`='".$incoming_id."'");
                while($rq=mysqli_fetch_assoc($s22)){
                    $images=$rq['profile_pic'];
                }
                if($row['outgoing_msg_id'] === $outgoing_id){
                    $output .= '<div class="chat outgoing">
                                <div class="details">
                                    <p>'. $row['msg'] .'</p>
                               
                                    <span class="badge badge-success badge-pill small" style="font-size:12px; margin:10px;"> '.$check.'</span>
                                    </div>
                                </div>';
                }else{
                    $output .= '<div class="chat incoming">
                                <img src="'.$images.'" alt="">
                                <div class="details">
                                    <p>'. $row['msg'] .'</p>
                                </div>
                                </div>';
                }
            }
        }else{
            $output .= '<div class="text">No messages are available. Once you send message they will appear here.</div>';
        }
        echo $output;
    }else{
        header("location: ../login.php");
    }

?>