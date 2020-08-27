<?php
    require_once('connection.php');

    $storesq = "SELECT * from loja";

    $get_stores = mysqli_query($conn, $storesq);

    if(mysqli_num_rows($get_stores) == 0){
        echo '<tr>
                <td>Não há nenhuma loja registrada.</td>
              </tr>';
    }else{
        while($row = mysqli_fetch_assoc($get_stores)){
            $data[] = $row;
        }

        echo json_encode(array('store'=>$data));
    }
?>