<?php
class Conexion
{
	private static $con = null;

	public function __construct()
	{
	}

	public static function getConnection()
	{
		if (self::$con == null) {
			self::$con = new mysqli("45.235.98.90", "pp3", "Q9z*s#]3P!N[AZ", "pp3");

			if (self::$con->connect_errno) {
				printf("Conexion fallida: %s\n", self::$con->connect_error);
				exit();
			}
		}
		return self::$con;
	}
}
?>