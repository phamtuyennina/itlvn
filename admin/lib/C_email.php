<?php
#--------------------------------------------------------------------- example
#$to = 'nthaih@yahoo.com';
#$subject = 'Hà ngọc thái test email';
#$body = '
#	<table width="70%">
#		<tr style="color:#FF0000;">
#			<th>Họ</th><th>Tên</th>
#		</tr>
#		<tr>
#			<td>Hà</td><td>Ngọc thái</td>
#		</tr>
#	</table>';
#$from = "ngọc thái <nthaih@yahoo.com>";
#$e = new C_email;
#$mail_sent = $e->MailSend( $to, $subject, $body, $from );
#echo $mail_sent ? "Mail sentaaa" : "Mail failed";
#

#--------------------------------------------------------
class C_email
{

	var $CharSet			= "utf-8";
	var $LE			  = "\n";
	var $Sender			= "";
	
	/**
	 * Sends mail using the PHP mail() function.
	 * @access private
	 * @return bool
	 */
	function MailSend($to, $subject, $body, $from) {
		
		if(is_array($to)){
			$to_name = $this->EncodeHeader($to['name']);
			$to_email = $to['email'];
		}else{
			$to_name = "";
			$to_email = $to;
		}
		$to = $to_name.' < '.$to_email.' > ';
		$subject = $this->EncodeHeader($subject);
		
		if(is_array($from)){
			$from_name = $this->EncodeHeader($from['name']);
			$from_email = $from['email'];
		}else{
			$from_name = "";
			$from_email = $from;
		}
		$from = $from_name.' < '.$from_email.' > ';
		
		$header = "MIME-Version: 1.0\r\n";
		$header .= "Content-type: text/html; charset=utf-8 \r\n";
		$header .= "From: ".$from."\r\n";
		
		$rt = @mail($to, $subject, $body, $header);
		
		return $rt;
	}
	
	/**
	 * Encode a header string to best of Q, B, quoted or none.
	 * @access private
	 * @return string
	 */
	function EncodeHeader ($str, $position = 'text') {
	  $x = 0;

	  switch (strtolower($position)) {
		case 'phrase':
		  if (!preg_match('/[\200-\377]/', $str)) {
			// Can't use addslashes as we don't know what value has magic_quotes_sybase.
			$encoded = addcslashes($str, "\0..\37\177\\\"");

			if (($str == $encoded) && !preg_match('/[^A-Za-z0-9!#$%&\'*+\/=?^_`{|}~ -]/', $str))
			  return ($encoded);
			else
			  return ("\"$encoded\"");
		  }
		  $x = preg_match_all('/[^\040\041\043-\133\135-\176]/', $str, $matches);
		  break;
		case 'comment':
		  $x = preg_match_all('/[()"]/', $str, $matches);
		  // Fall-through
		case 'text':
		default:
		  $x += preg_match_all('/[\000-\010\013\014\016-\037\177-\377]/', $str, $matches);
		  break;
	  }

	  if ($x == 0)
		return ($str);

	  $maxlen = 75 - 7 - strlen($this->CharSet);
	  // Try to select the encoding which should produce the shortest output
	  if (strlen($str)/3 < $x) {
		$encoding = 'B';
		$encoded = base64_encode($str);
		$maxlen -= $maxlen % 4;
		$encoded = trim(chunk_split($encoded, $maxlen, "\n"));
	  } else {
		$encoding = 'Q';
		$encoded = $this->EncodeQ($str, $position);
		$encoded = $this->WrapText($encoded, $maxlen, true);
		$encoded = str_replace("=".$this->LE, "\n", trim($encoded));
	  }

	  $encoded = preg_replace('/^(.*)$/m', " =?".$this->CharSet."?$encoding?\\1?=", $encoded);
	  $encoded = trim(str_replace("\n", $this->LE, $encoded));

	  return $encoded;
	}
	
	/**
	 * Encode string to q encoding.
	 * @access private
	 * @return string
	 */
	function EncodeQ ($str, $position = "text") {
		// There should not be any EOL in the string
		$encoded = preg_replace("[\r\n]", "", $str);

		switch (strtolower($position)) {
		  case "phrase":
			$encoded = preg_replace("/([^A-Za-z0-9!*+\/ -])/e", "'='.sprintf('%02X', ord('\\1'))", $encoded);
			break;
		  case "comment":
			$encoded = preg_replace("/([\(\)\"])/e", "'='.sprintf('%02X', ord('\\1'))", $encoded);
		  case "text":
		  default:
			// Replace every high ascii, control =, ? and _ characters
			$encoded = preg_replace('/([\000-\011\013\014\016-\037\075\077\137\177-\377])/e',
				  "'='.sprintf('%02X', ord('\\1'))", $encoded);
			break;
		}

		// Replace every spaces to _ (more readable than =20)
		$encoded = str_replace(" ", "_", $encoded);

		return $encoded;
	}
	
	/**
	 * Wraps message for use with mailers that do not
	 * automatically perform wrapping and for quoted-printable.
	 * Original written by philippe.
	 * @access private
	 * @return string
	 */
	function WrapText($message, $length, $qp_mode = false) {
		$soft_break = ($qp_mode) ? sprintf(" =%s", $this->LE) : $this->LE;

		$message = $this->FixEOL($message);
		if (substr($message, -1) == $this->LE)
			$message = substr($message, 0, -1);

		$line = explode($this->LE, $message);
		$message = "";
		for ($i=0 ;$i < count($line); $i++)
		{
		  $line_part = explode(" ", $line[$i]);
		  $buf = "";
		  for ($e = 0; $e<count($line_part); $e++)
		  {
			  $word = $line_part[$e];
			  if ($qp_mode and (strlen($word) > $length))
			  {
				$space_left = $length - strlen($buf) - 1;
				if ($e != 0)
				{
					if ($space_left > 20)
					{
						$len = $space_left;
						if (substr($word, $len - 1, 1) == "=")
						  $len--;
						elseif (substr($word, $len - 2, 1) == "=")
						  $len -= 2;
						$part = substr($word, 0, $len);
						$word = substr($word, $len);
						$buf .= " " . $part;
						$message .= $buf . sprintf("=%s", $this->LE);
					}
					else
					{
						$message .= $buf . $soft_break;
					}
					$buf = "";
				}
				while (strlen($word) > 0)
				{
					$len = $length;
					if (substr($word, $len - 1, 1) == "=")
						$len--;
					elseif (substr($word, $len - 2, 1) == "=")
						$len -= 2;
					$part = substr($word, 0, $len);
					$word = substr($word, $len);

					if (strlen($word) > 0)
						$message .= $part . sprintf("=%s", $this->LE);
					else
						$buf = $part;
				}
			  }
			  else
			  {
				$buf_o = $buf;
				$buf .= ($e == 0) ? $word : (" " . $word);

				if (strlen($buf) > $length and $buf_o != "")
				{
					$message .= $buf_o . $soft_break;
					$buf = $word;
				}
			  }
		  }
		  $message .= $buf . $this->LE;
		}

		return $message;
	}
	
	/**
	 * Changes every end of line from CR or LF to CRLF.
	 * @access private
	 * @return string
	 */
	function FixEOL($str) {
		$str = str_replace("\r\n", "\n", $str);
		$str = str_replace("\r", "\n", $str);
		$str = str_replace("\n", $this->LE, $str);
		return $str;
	}
}
?>