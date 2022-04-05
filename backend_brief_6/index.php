<?php
header('Access-control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
require_once './Autoloade.php';

$home=new Home_controllers();

$query= "SELECT * FROM utilisateur WHERE Reference=?";
$stmt = DB::connect()->prepare($query);
$result=array();
$result['error']=false;
if ($_SESSION['is_db_connected']){
    $result["is_db_connected"]=true;
    $result["connction_msg"]="Connected successfully";
}else{
    $result["is_db_connected"]=false;
    $result["connction_msg"]="Connected failed";
}




$pages=[ 'Login','Logout','Read-rv','Inscription'];
    if(isset($_GET['page']) !== null ){
        if (isset($_GET['page'])) {
            if (in_array($_GET['page'], $pages)) {
                $page=$_GET['page'];
                if ($page=="Read-rv"){
//                    $result["ana"]="wfatma failed";
                    $result_rv=array();
                    $data = new Reservation();
                    $result_rv=$data->getAll_Rv();
                    $result['r_v']=$result_rv;
                }
                if ($page=="Add_rv"){

                }
                if ($page=="Delete_rv"){

                }
                if ($page=="Update_rv"){

                }
                if ($page=="Login_u"){

                }
                if ($page=="Inscription_u"){

                }
                if ($page=="Logout_u"){

                }

            }
        }
    }
echo json_encode($result);
