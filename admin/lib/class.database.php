<?php if(!defined('_lib')) die("Error");
class database{
	
	var $db;
	var $result;
	var $insert_id;
	var $sql = "";
	var $refix = "";

	var $servername;
	var $username;
	var $password;
	var $database;
	
	var $table = "";
	var $where = "";
	var $order = "";
	var $limit = "";
	
	var $error = array();

	function database($config = array()){
		if(!empty($config)){
			$this->init($config);
			$this->connect();
		}
	}

	function init($config = array()){
		foreach($config as $k=>$v)
			$this->$k = $v;
	}
	
	function connect(){
		$this->db = @mysql_connect($this->servername, $this->username, $this->password);
		
		if( !$this->db){
			die('Could not connect: ' . mysql_error());
		}
		
		if( !mysql_select_db($this->database, $this->db)){
			die(mysql_errno($this->db) . ": " . mysql_error($this->db));
			return false;
		}
		
		mysql_query('SET NAMES "utf8"',$this->db);
	}
	
	function query($sql=""){
		if($sql)
			$this->sql = str_replace('#_', $this->refix, $sql);
		$this->result = mysql_query($this->sql,$this->db);
		if(!$this->result){
			#die(mysql_errno($this->db) . ": " . mysql_error($this->db));
			die("syntax error: ".$this->sql);
		}
		return $this->result;	
	}
	
	function insert($data = array()){
		$key = "";
		$value = "";
		$sql = "SHOW COLUMNS FROM ".$this->refix.$this->table;
		$this->query($sql);
		foreach($this->result_array() as $k=>$v){
			if(!isset($data[$v['Field']])){
				$val = '';
				if(strpos($v['Type'], 'int') !== false | strpos($v['Type'], 'float') !== false | strpos($v['Type'], 'double') !== false ){
					$val = 0;
				}
				$data[$v['Field']] = $val;
			}else{
				if(strpos($v['Type'], 'int') !== false | strpos($v['Type'], 'float') !== false | strpos($v['Type'], 'double') !== false ){
					if($data[$v['Field']]==""){
						$data[$v['Field']] = 0;
					}
				}	
			}
		}
		unset($data['id']);
		foreach($data as $k => $v){
			$key .= "," . $k;
			$value .= ",'" . $v  ."'";
		}
		if($key{0} == ",") $key{0} = "(";
		$key .= ")";
		if($value{0} == ",") $value{0} = "(";
		$value .= ")";
		$this->sql = "insert into ".$this->refix.$this->table.$key." values ".$value;
		$this->query();
		$this->insert_id = mysql_insert_id();
		return $this->result;
	}
	
	function update($data = array()){
		$values = "";
		$this->query("select * from ".$this->refix.$this->table." ".$this->where);
		foreach($this->fetch_array() as $k=>$v){
			if(!isset($data[$k])){
				$data[$k] = magic_quote($v);
			}
		}
		$sql = "SHOW COLUMNS FROM ".$this->refix.$this->table;
		$this->query($sql);
		foreach($this->result_array() as $k=>$v){
			if(strpos($v['Type'], 'int') !== false | strpos($v['Type'], 'float') !== false | strpos($v['Type'], 'double') !== false ){
				if($data[$v['Field']]==""){
					$data[$v['Field']] = 0;
				}
			}
		}
		if(isset($data['id'])){
			if($data['id']==0){
				unset($data['id']);
			}
		}
		foreach($data as $k => $v){
			$values .= ", " . $k . " = '" . $v  ."' ";
		}
		if($values{0} == ",") $values{0} = " ";
		$this->sql = "update " . $this->refix . $this->table . " set " . $values;
		$this->sql .= $this->where;
		
		return $this->query();
	}
	
	function delete(){
		$this->sql = "delete from " . $this->refix . $this->table . $this->where;
		return $this->query();
	}
	
	function select($str = "*"){
		$this->sql = "select " . $str;
		$this->sql .= " from " . $this->refix .$this->table;
		$this->sql .=  $this->where;
		$this->sql .=  $this->order;
		$this->sql .=  $this->limit;
		return $this->query();
	}
	
	function num_rows(){
		return mysql_num_rows($this->result);
	}
	
	function fetch_array(){
		return mysql_fetch_assoc($this->result);
	}
	
	function result_array(){
		$arr = array();
		while ($row = mysql_fetch_assoc($this->result)) 
			$arr[] = $row;
		return $arr;
	}
	
	function setTable($str){
		$this->table = $str;
	}
	
	function setWhere($key, $value=""){
		if($value!=""){
			if($this->where == "")
				$this->where = " where " . $key . " = '" . $value . "'";
			else
				$this->where .= " and " . $key . " = '" . $value ."'";
		}
		else{
			if($this->where == "")
				$this->where = " where " . $key ;
			else
				$this->where .= " and " . $key ;
		}
	}
	
	function setWhereOr($key, $value){
		if($value!=""){
			if($this->where == "")
				$this->where = " where " . $key . " = " . $value;
			else
				$this->where .= " or " . $key . " = " . $value;
		}
		else{
			if($this->where == "")
				$this->where = " where " . $key ;
			else
				$this->where .= " or " . $key ;
		}
	}
	
	function setOrder($str){
		$this->order = " order by " . $str;
	}
	
	function setLimit($str){
		$this->limit = " limit " . $str;
	}
	
	function setError($msg){
		$this->error[] = $msg;
	}
	
	function showError(){
		foreach($this->error as $value)
			echo '<br>'.$value;
	}
	
	function reset(){
		$this->sql = "";
		$this->result = "";
		$this->where = "";
		$this->order = "";
		$this->limit = "";
		$this->table = "";
	}
	
	function debug(){
		echo "<br> servername: ".$this->servername;
		echo "<br> username: ".$this->username;
		echo "<br> password: ".$this->password;
		echo "<br> database: ".$this->database;
		echo "<br> ".$this->sql;
	}
	
	/**
	 * Escape String
	 *
	 * @access	public
	 * @param	string
	 * @return	string
	 */
	function escape_str($str)	
	{	
		if (is_array($str))
    	{
    		foreach($str as $key => $val)
    		{
    			$str[$key] = $this->escape_str($val);
    		}
    		
    		return $str;
    	}
	
		if (function_exists('mysql_real_escape_string') AND is_resource($this->db))
		{
			return mysql_real_escape_string($str, $this->db);
		}
		elseif (function_exists('mysql_escape_string'))
		{
			return mysql_escape_string($str);
		}
		else
		{
			return addslashes($str);
		}
	}
	
	function xssClean($str){
		#$str = htmlentities($str, ENT_QUOTES, "UTF-8");
		$str = str_replace("'", '&#039;', $str);
		$str = str_replace('"', '&quot;', $str);
		$str = str_replace('<', '&lt;', $str);
		$str = str_replace('>', '&gt;', $str);
		#$str = addslashes($str);
		return $str;
	}
}
?>