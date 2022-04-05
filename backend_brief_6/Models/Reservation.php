<?php 

class  Reservation
{
        static public function getAll_rv(){
            $query="SELECT *FROM Rendez_vous INNER JOIN utilisateur ON utilisateur.Reference = Rendez_vous.Reference";
            $stmt = DB::connect()->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll();
        }

        static public function Add($R_V){
            try {
                 $query="INSERT INTO Rendez_vous (Date,Horaire,Reference)VALUES(:Date,:Horaire,:Reference)";
                 $stmt = DB::connect()->prepare($query);
                 $stmt->bindParam(':Date',$R_V['Date']);
                 $stmt->bindParam(':Horaire',$R_V['Horaire']);
                 $stmt->bindParam(':Reference',$R_V['Reference']);
                 if ($stmt->execute()) {
                         return 1;
                     } else {
                         return 0;
                     }
            } catch (PDOException $ex) {
                echo 'erreur'.$ex->getMessage();
            }
        }
}
?>