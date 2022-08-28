<?php
class database
{
	// private $severname='localhost';
	// private $username='root';
	// private $password='';
	// private $database='demo1';
	private $severname='localhost';
	private $username='zgkoloki_tuthien';
	private $password='x)Ja3Y*}$Q;=';
	private $database='zgkoloki_tuthien';
	private $conn = null;
	private $result = null;

	public function __construct()
	{
		$this->connect();
	}

	public function __destruct()
	{
		$this->disconect();
	}

	public function connect()
	{

		$this->conn = mysqli_connect($this->severname, $this->username, $this->password, $this->database);
	}

	public function disconect()
	{
		if ($this->conn) {
			mysqli_close($this->conn);
		}
	}

	public function query($sql)
	{
		$this->result = mysqli_query($this->conn, $sql);
	}

	public function insert_query($sql)
	{
		mysqli_query($this->conn, $sql);
		$id = mysqli_insert_id($this->conn);
		return $id;
	}


	public function num_rows()
	{
		if ($this->result) {
			$row = mysqli_num_rows($this->result);
		} else $row = 0;
		return $row;
	}

	public function fetch_array()
	{
		if ($this->result) {
			$data = mysqli_fetch_array($this->result, MYSQLI_ASSOC);
		} else $data = 0;
		return $data;
	}

	public function fetch_assoc()
	{
		if ($this->result) {
			$data = mysqli_fetch_assoc($this->result);
		} else $data = 0;
		return $data;
	}
}
