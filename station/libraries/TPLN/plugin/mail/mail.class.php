<?php
/**
 * TPLN mail Plugin
 * @package Template Engine
 */
class Mail extends Rss
{
	protected $from = '';
	protected $fromLabel = '';
	protected $replyTo = '';
	protected $to = '';
	protected $cc = '';
	protected $bcc = '';
	protected $subject = '';
	protected $body = '';
	protected $format = '';
	protected $files = array();
	protected $charset = 'iso-8859-1';
	protected $urgent = false;
	protected $confirm  = false;
	protected $mailErr = '';

	/**
	 * this method verifies if the email adress is correct
	 *
	 * @param string $address
	 *
	 * @return boolean
	 * @author H2LSOFT */
	public function isMail($address)
	{
		if (preg_match('`([[:alnum:]]([-_.]?[[:alnum:]])*@[[:alnum:]]([-_.]?[[:alnum:]])*\.([a-z]{2,4}))`', $address))
			return true;
		else
			return false;
	}

	/**
	 * This method allows to define a mail with a urgent priority.
	 *
	 * @param boolean $bool
	 * @author H2LSOFT */
	public function mailUrgent($bool)
	{
		$this->urgent = $bool;
	}

	/**
	 * This method allows to change encode by default ISO-8859-15 or UTF8 of the mail.
	 *
	 * @param string $str
	 * @author H2LSOFT */
	public function mailCharset($str)
	{
		$this->charset = $str;
	}

	/**
	 * This method allows to add a confirmation of answer to the email.
	 *
	 * @param boolean $bool
	 *
	 * @since 2.7
	 * @author H2LSOFT */
	public function mailConfirm($bool)
	{
		$this->confirm = $bool;
	}

	/**
	 * This method allows to define the sender of the mail.
	 *
	 * @param string $str
	 * @param string $label
	 * @author H2LSOFT */
	public function mailFrom($str, $label='')
	{
		$this->from = $str;
		$this->fromLabel = $label;
	}

	/**
	 *This method allows to define a email address for response.
	 *
	 * @param string $str
	 * @author H2LSOFT */
	public function mailReplyTo($str)
	{
		$this->replyTo = $str;
	}

	/**
	 * This method allows to define one of more email address of recipient.
	 *
	 * @param string $str
	 * @author H2LSOFT */
	public function mailTo($str)
	{
		$this->to = $str;
	}

	/**
	 * This method allows to send a conform copy of the mail.
	 *
	 * @param string $str
	 * @author H2LSOFT */
	public function mailCC($str)
	{
		$this->cc = $str;
	}

	/**
	 * This method allows to send a conform copy of the mail.
	 *
	 * @param string $str
	 * @author H2LSOFT */
	public function mailBCC($str)
	{
		$this->bcc = $str;
	}

	/**
	 * This methode allows to define the object of the email.
	 *
	 * @param string $str
	 * @author H2LSOFT */
	public function mailSubject($str)
	{
		$this->subject = $str;
	}

	/**
	 * This method allows to define the body of the message.
	 *
	 * @param string $str
	 * @param string $format HTML or TXT
	 * @author H2LSOFT */
	public function mailBody($str, $format)
	{
		$this->body = $str;
		$this->format = $format;
	}

	/**
	 * This method allows to attach files to the email.
	 *
	 * if $type parameter is not filled, it will affect a type regarding file extension
	 *
	 * @param string $src
	 * @param string $name
	 * @param string $type
	 * @author H2LSOFT */
	public function mailAttachFile($src, $name, $type='')
	{
		// type of file is not filled
		if(empty($type))
		{
			// try to recognize the extention
			switch(strrchr(basename($name), "."))
			{
				case ".gz": $type = "application/x-gzip";
					break;
				case ".tgz": $type = "application/x-gzip";
					break;
				case ".zip": $type = "application/zip";
					break;
				case ".pdf": $type = "application/pdf";
					break;
				case ".png": $type = "image/png";
					break;
				case ".gif": $type = "image/gif";
					break;
				case ".jpg": $type = "image/jpeg";
					break;
				case ".txt": $type = "text/plain";
					break;
				case ".htm": $type = "text/html";
					break;
				case ".html": $type = "text/html";
					break;
				default: $type = "application/octet-stream";
					break;
			}
		}
		$this->files[] = array(
			'src' => $src,
			'name' => $name,
			'type' => $type
		);
	}

	/**
	 * This method allows to return the last error message
	 *
	 * @return string
	 * @author H2LSOFT */
	public function mailError()
	{
		return 'Error: '.$this->mailErr;
	}

	/**
	 * This method allows to send an email.
	 *
	 * @return boolean
	 * @author H2LSOFT */
	public function mailSend()
	{
		// obligatory FROM
		if(!$this->isMail($this->from))
		{
			$this->mailErr = "$this->from is not a valid email address";
			return false;
		}

		// obligatory TO
		$arr = explode(',', $this->to);
		foreach($arr as $to)
		{
			$to = trim($to);
			if(!$this->isMail($to))
			{
				$this->mailErr = "$to is not a valid email address in To";
				return false;
			}
		}

		// check REPLYTO
		if(!empty($this->replyTo))
		{
			if(!$this->isMail($this->replyTo))
			{
				$this->mailErr = "$this->replyTo is not a valid email address";
				return false;
			}
		}



		// headers
		$headers = '';

		if(!empty($this->fromLabel))$this->from = "$this->fromLabel <$this->from>";
		$headers .= "From: $this->from"."\n";
		if(count($this->files) > 0)$headers .= "MIME-Version: 1.0\n";

		//$headers .= "To: $this->to"."\n";
		$headers .= "Return-Path: $this->from"."\n";
		if(!empty($this->replyTo))$headers .= "Reply-To: $this->replyTo"."\n";
		if(!empty($this->cc))$headers .= "Cc: $this->cc"."\n";
		if(!empty($this->bcc))$headers .= "Bcc: $this->bcc"."\n";
		if(!empty($this->confirm))$headers .= "Disposition-Notification-To: $this->from"."\n";
		$headers .= 'X-Mailer: PHP/'.phpversion()."\n";

		if($this->urgent)$headers .= "X-Priority: 1\n";

		// there are any files ?
		if(count($this->files) > 0)
		{
			// add the message
			if($this->format == 'HTML')
				$this->mailAttachFile($this->body, '', 'text/html');
			else
				$this->mailAttachFile($this->body, '', 'text/plain');

			$boundary = "b".md5(uniqid(time()));
			$headers .= "Content-Type: multipart/mixed; boundary = $boundary\n\nThis is a MIME encoded message.\n\n--$boundary";

			// construct the mime with towards
			for($i=count($this->files)-1; $i >=  0; $i--)
			{
				// construct the message
				$headers .= "\n";
				$message = $this->files[$i]['src'];
				$message = chunk_split(base64_encode($message));
				$headers .= "Content-Type: ".$this->files[$i]['type'];
				if(!empty($this->files[$i]['name']))
					$headers .= "; name = \"".$this->files[$i]['name']. "\"";
				$headers .= "\nContent-Transfer-Encoding: base64\n\n";
				if(!empty($this->files[$i]['name']))
					$headers .= "Content-Disposition: attachment;\n\n";
				$headers .= "$message\n";
				$headers .= "--$boundary";
			}
			$headers .= "--";


			// send
			if(!@mail($this->to, $this->subject, '', $headers))
			{
				$this->mailErr = "Email has not been sent";
				return false;
			}
		}
		else
		{
			// send with HTML ?
			$headers .= "MIME-Version: 1.0\n";
			if($this->format == 'HTML')
				$headers .= "content-type: text/html; charset=$this->charset\n";

			if(!@mail($this->to, $this->subject, $this->body, $headers))
			{
				$this->mailErr = "Email has not been sent";
				return false;
			}
		}

		return true;
		
	}
}

?>