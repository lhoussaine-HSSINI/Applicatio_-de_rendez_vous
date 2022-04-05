<?php 
class Vol_controllers{
        public function getAllVol(){
            $vol= Vol::getAll();
            return $vol;
        }

        public function Add_vol(){
            if(isset($_POST['lieu_départ']) && isset($_POST['lieu_arrivé'])&&isset($_POST['date_départ']) &&
                isset($_POST['date_arrivé'])&&isset($_POST['prix'])&& isset($_POST['nombre_vol'])){
                $vols=array(

                    'lieu_départ' => $_POST['lieu_départ'],
                    'lieu_arrivé' => $_POST['lieu_arrivé'] ,
                    'date_départ' => date('Y-m-d H:i:s', strtotime($_POST['date_départ'])),
                    'date_arrivé' => date('Y-m-d H:i:s', strtotime($_POST['date_arrivé'])),
                    'prix' => $_POST['prix'],
                    'nombre_vol' =>$_POST['nombre_vol'],
                );
//
                $resul_Add=Vol::Add($vols);
                if ($resul_Add===1) {
                    header("Location: Dashboard");
                }else {
                    echo $resul_Add;
                }
            }
        }

        public function Edit_vol(){
        if(isset($_POST['lieu_départ']) && isset($_POST['lieu_arrivé'])&&isset($_POST['date_départ']) &&
            isset($_POST['date_arrivé'])&&isset($_POST['prix'])&& isset($_POST['nombre_vol'])&& isset($_POST['id_vol'])){
            $vols=array(

                'lieu_départ' => $_POST['lieu_départ'],
                'lieu_arrivé' => $_POST['lieu_arrivé'] ,
                'date_départ' => date('Y-m-d \TH:i:s', strtotime($_POST['date_départ'])),
                'date_arrivé' => date('Y-m-d \TH:i:s', strtotime($_POST['date_arrivé'])),
                'prix' => $_POST['prix'], 'nombre_vol' =>$_POST['nombre_vol'], 'id_vol'=>$_POST['id_vol'],
            );
            $resul_Add=Vol::Edit($vols);
            if ($resul_Add===1) {
                header("Location: Dashboard");
            }else {
                echo $resul_Add;
            }
        }
    }
        public function Delete_vol(){
            if(isset($_POST['id'])){
                $id = $_POST['id'];

                $resul_delete=Vol::Delete($id);
                if ($resul_delete==1) {
                    header("Location: Dashboard");
                }else {
                    echo $resul_delete;
                }
            }
        }
            public function getAllReservation_vol(){
                $all_reserve= Vol::getAll_reserv();
                return $all_reserve;
            }
            public function getAllReservation_passaér_vol(){
                $all_reserve= Vol::getAll_reserv_passagér();
                return $all_reserve;
            }
//        calculer nombre de place li reservahom user za2id nas(passager) li 9t3 liom howa
            public function calcul_nombre_place($id){
                if (is_numeric($id)){
                $numbre_reserve_passagér= Vol::calcul_nombre_place_de_passagéres($id);
                return $numbre_reserve_passagér['Resultat_nombre_place']+1;
                }
                return 1;
            }
//        calculer nombre de place li trezervaw fhad vol xhal dyal nas reservaw (user+passager) lkola vol
            public function calcul_nombre_place_rest_vol_user_passager($id){
            if (is_numeric($id)){
                $numbre_reserve_user_passagér= Vol::calcul_nombre_place_rest_vol($id);
                return $numbre_reserve_user_passagér['count_user_reservation']+$numbre_reserve_user_passagér['count_passageres_reservation'];
            }
            return 1;
            }


//    cherche wax kayn routeur fhad vol wla la
        public function si_vol_routeur($arrivé, $départ){
        if (is_string($arrivé) && is_string($départ)){
            return Vol::vol_routeur($arrivé, $départ);
        }
        return 0;
    }

//    reteurn id de vol
        public function get_id_vol_routeur($arrivé, $départ){
            if (is_string($arrivé) &&is_string($départ)){
                $id_vol_routeur=Vol::id_vol_routeur($arrivé, $départ);
                return $id_vol_routeur["id_vol"];
            }
            return 0;
        }
        //reteurn id de vol
        public function calcul_numbre_reserve_vol_routeur($id_vol){
            if (is_numeric($id_vol)){
                $numbre_place_vol=Vol::N_P_V($id_vol);
                $numbre_de_reserve_de_vol=$this->calcul_nombre_place_rest_vol_user_passager($id_vol);
                return $numbre_place_vol["nombre_vol"]-$numbre_de_reserve_de_vol;
            }
            return 0;
        }
        //reteurn id de vol
        public function test_user_reserve_or_no($id_user, $id_vol){
            if (is_numeric($id_vol)&&is_numeric($id_user)){
                $a=Vol::T_U_R_O_N($id_user, $id_vol);
                return $a;
            }
            return 0;
        }

}
?>