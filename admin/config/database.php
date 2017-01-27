<?php

class Configuration{
	public static function mysqli_configation(){
		/*
		$host_name = "localhost";
		$local_db_user = "teccrooz_bedmuth";
		$local_db_password = "nN#fevNsh?vQ";
		$local_db_name = "teccrooz_econutrivet";
		*/
		$host_name = "localhost";
		$local_db_user = "ecotechz_multisi";
		$local_db_password = "Toshiba4757";
		$local_db_name = "poultry_farm";
		

		
		$mysqli = new mysqli($host_name, $local_db_user, $local_db_password, $local_db_name);
		if ($mysqli->connect_errno) {
			echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
			return null;
		}
		return $mysqli;
	}
}
?>