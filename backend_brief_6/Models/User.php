<?php
 class User{
    function __construct() {
			$this->conn = new mysqli("localhost","root","","brief-5");
		}
		public function user_inscription($Reference, $Nom,$Prénom, $Date_de_naissance) {

			$query= "SELECT * FROM utilisateur WHERE Reference=?";
			$stmt = $this->conn->prepare($query);
			$stmt->bind_param("s",$Reference);
			$stmt->execute();
			$result= $stmt->get_result();
			$row1 = mysqli_num_rows($result);
			if ($row1 == 1) {
                header("Location:Login");
			} else {
				
				$stmt =$this->conn->prepare("INSERT INTO utilisateur (Reference,Nom, Prénom,Date_de_naissance) values(?,?,?,?)");
				$stmt->bind_param("ssssss", $Reference,$Nom, $Prénom,$Date_de_naissance, );
				$stmt->execute();
				header("Location:Login");
			}	
		}
		public function  user_connecter($Reference) {
			$query= "SELECT * FROM utilisateur WHERE Reference=?";
			$stmt =$this->conn->prepare($query);
			$stmt->bind_param("s",$Reference);
			$stmt->execute();
			$result= $stmt->get_result();
			$row1 = mysqli_num_rows($result);
			$row2 = $result->fetch_assoc();
			$_SESSION['login']=true;
			$_SESSION["statut"] =  $row2["statut"];
			$_SESSION["id_user"] =  $row2["id_utilisateur"];
			if ($row1 == 1 ) {
                    $_SESSION['admin_bool']=false ;
                    $_SESSION['admin']='';
                    $_SESSION['user_bool']=true ;
                    $_SESSION['user']='user';
					# code...
					header("Location: Home");

			} else {
                $_SESSION['login'] == true;
				header("Location: Login");
			}
		}
		
		public function log_out()
		{
			session_destroy();
			$_SESSION['login']=false;
            $_SESSION['admin_bool']=false ;
            $_SESSION['admin']='';
            $_SESSION['user_bool']=false ;
            $_SESSION['user']='';
			header("Location: index");
		}
}
?>