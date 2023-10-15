<?php
    while($row = mysqli_fetch_assoc($query)){
        
        $sql2 = "SELECT * FROM messages WHERE (incoming_msg_id = {$row['login_id']}
                OR outgoing_msg_id = {$row['login_id']}) AND (outgoing_msg_id = {$outgoing_id} 
                OR incoming_msg_id = {$outgoing_id}) ORDER BY msg_id DESC LIMIT 1";
        $query2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($query2);
        (mysqli_num_rows($query2) > 0) ? $result = $row2['msg'] : $result ="No message available";
        (strlen($result) > 28) ? $msg =  substr($result, 0, 28) . '...' : $msg = $result;
        $sql3="SELECT * FROM messages WHERE (outgoing_msg_id = {$row['login_id']}) AND (incoming_msg_id = {$outgoing_id})
        AND seen='unseen' ";
         $query3=mysqli_query($conn,$sql3);
         $c=mysqli_num_rows($query3);
        if($c==0){
            $c="";
        }
 
        
        if(isset($row2['outgoing_msg_id'])){
            ($outgoing_id == $row2['outgoing_msg_id']) ? $you = "You: " : $you = "";
        }else{
            $you = "";
        }
        ($row['status_online'] == "Offline now") ? $offline = "offline" : $offline = "";
        ($outgoing_id == $row['login_id']) ? $hid_me = "hide" : $hid_me = "";
        $imag='';   
        $s1=mysqli_query($conn,"SELECT * FROM `images` WHERE `login_id`='".$row['login_id']."'");
            while($r=mysqli_fetch_assoc($s1)){
$imag=$r['profile_pic'];
            }      
        $output .= '<a href="chat.php?login_id='. $row['login_id'] .'">
                    <div class="content">
                    <img src="'. $imag .'" alt="">
                    <div class="details">
                        <span>'. $row['first_name']. " " . $row['last_name'] .'</span>
                        <p>'. $you . $msg .'</p>
                    </div>
                    </div>
                    <div class="status-dot '. $offline .'"><i class="fas fa-circle">'.$c.'</i></div>
                </a>';
    }
    
?>