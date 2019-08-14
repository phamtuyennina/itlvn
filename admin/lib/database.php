<?php
	#$db = new Db();
	
	#$db->insert('user', array('username'=>'user', 'password'=>"''\ \'pass'"));
	#$db->update('user', array('username'=>'user', 'password'=>'pass2'), "where id=1");
	#$db->delete('user', "where id=2");
	#$db->select('user', '*', "where id=2");
	#$db->select("select * from user where id=".mysql_insert_id());
	#echo $db->count();

class mydb
{
	var $db;
	var $result = false;
	var $sql = "";
	var $refix = "dnt_";
	
	
	var $servername = "localhost";
	var $username = "root";
	var $password = "admin";
	var $database = "dacnhantam";
	
	/*
	var $servername = "localhost";
	var $username = "web152_u1";
	var $password = "b2f1fb333e03";
	var $database = "web152_db1";
	*/
	
	function mydb($arr = array()){
		if(count($arr)>0)
			foreach($arr as $k=>$v)
				$this->$k = $v;
		$this->connect();
	}
	
	function connect(){
		$this->db = @mysql_connect($this->servername, $this->username, $this->password);
		
		if( !$this->db){
			if( DEBUG )
				$msg =  "	<br>ERROR : "
								."<br>servername=".$this->servername
								."<br>username=".$this->username
								."<br>password=".$this->password
								."<br>";
			else
				$msg = "<br>Can not open a connection to a MySQL Server<br>";
			die ($msg);
		}
		
		if( !mysql_select_db($this->database,$this->db)){
			if( DEBUG )
				$msg =  "	<br>ERROR : "
								."<br>database=".$this->database
								."<br>";
			else
				$msg = "<br>Can not connect to a database<br>";
			die ($msg);
		}
		
		mysql_query('SET NAMES "utf8"',$this->db);
	}
	
	function query($sql){ //return records
		$this->sql = str_replace('#_', $this->refix, $sql);
		$this->result = mysql_query($this->sql,$this->db);
		if( $this->result == false){
			if( DEBUG ) die ("<br>ERROR : $sql <br>");
			else die ("<br>ERROR : syntax error <br>");
		}
		return $this->result;	
	}
	
	function num_rows($record){ //return int
		return mysql_num_rows($record);
	}
	
	function fetch($record){
		return mysql_fetch_assoc($record);
	}
	
	function mk_arr($record){
		$arr = array();
		while ($row = mysql_fetch_assoc($record)) 
			$arr[] = $row;
		return $arr;
	}
	
#-------------------------------------
	function insert($tblname, $arr){ # return true, false
		$key = ' (';
		$value = ' values (';
		foreach($arr as $k=>$v){
			$key .= $k.",";
			$value .= "'".$this->themdau($v)."',";
		}
		$key{strlen($key)-1} = ')';
		$value{strlen($value)-1} = ')';
		$sql = "insert into ".$this->refix.$tblname.$key.$value;

		return $this->query($sql);
	}
	
	function select($sql, $str='', $where=''){ #return arr
		if($str == '') $str = '*';
		if( !is_int(strpos($sql, 'select')))
			$sql = "select ".$str." from ".$this->refix.$sql." ".$where;
		$this->query($sql);
		
		$arr = array();
		while ($row = mysql_fetch_assoc($this->result)) 
			$arr[] = $row;
		return $arr;
	}
	
	function select_cay($id=0){ #theo cay
		$r=array();
		$i=0;
		if($id==0){
			$row=array("id"=>0, "ten_vi"=>'----',"id_cha"=>-1,"stt"=>0);
			$r[$i++]=$row;
		}
		$rs=$this->select("pro_cat",'',"where id_cha={$id} order by stt,ten_vi");
		for($j=0;$j<count($rs);$j++)
		{
			$r[$i++]=$rs[$j];
			#var_dump($rs[$j]);
			$r2=$this->select_cay($rs[$j]['id']);
			foreach($r2 as $row2)
			{
				$row2['ten_vi']="- ".$row2['ten_vi'];
				$r[$i++]=$row2;
			}
		}
		return $r;
	}
	
	function select_cay_2($table, $id_cha=0, $s="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"){ #theo c y
		$result = array();
		$r = $this->select($table, "id, ten_vi, ten_en", "where id_cha={$id_cha} order by stt");
		
		for($i=0; $i<count($r); $i++){
			if($id_cha){
				$r[$i]['ten_vi'] = $s.$r[$i]['ten_vi'];
			}
			$result[] = $r[$i];
			$r2 = $this->select_cay_2($table, $r[$i]['id']);
			for($j=0; $j<count($r2); $j++)
				$result[] = $r2[$j];
		}
		
		return $result;
	}
	
	function update($tblname, $arr, $where=''){
		$sql = "update ".$this->refix.$tblname." set ";
		foreach($arr as $k=>$v)
			$sql .= $k."='".$this->themdau($v)."',";
		$sql{strlen($sql)-1} = ' ';
		$sql .= $where;
		return $this->query($sql);
	}
	
	function delete($tblname, $where=''){
		return $this->query("delete from ".$this->refix.$tblname." {$where}");
	}
	
	function themdau($s){
		#$s = htmlentities($s, ENT_QUOTES,"UTF-8");
		#$s = str_replace("'", '&#039;', $s);
		#$s = str_replace('"', '&quot;', $s);
		#$s = str_replace('<', '&lt;', $s);
		#$s = str_replace('>', '&gt;', $s);
		$s = addslashes($s);

		return $s;
	}
	
	function dump($arr, $f = 0){
	echo "<pre>";
	if($f)
		var_dump($arr);
	else
		print_r($arr);
	echo "<pre>";	
}
}
?>