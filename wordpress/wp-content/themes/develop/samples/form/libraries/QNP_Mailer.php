<?php
namespace phuquang\Validation;

class QNP_Mailer
{
    public $Language = 'ja';
    public $From     = '';
    public $FromName = '';
    public $To       = '';
    public $ToName   = '';
    public $CharSet  = 'ISO-2022-JP';
    public $Encoding = '7bit';
    public $Type     = 'text/plain';
    public $Subject  = '';
    public $Body     = '';
    public $Data     = array();
    public $File     = '';
    public $Newline  = "\r\n";

    /**
     * set email from
     * @param string $email email from
     * @param string $name  name of email from
     */
    public function setFrom($email, $name = '')
    {
        if (empty($email)){
            return;
        }

        $this->From = $email;

        $this->FromName = $this->transferMimeEncode($name);
    }

    /**
     * set email to
     * @param string $email email to
     * @param string $name  name of email to
     */
    public function setTo($email, $name = '')
    {
        if (empty($email)){
            return;
        }

        $this->To = $email;

        $this->ToName = $this->transferMimeEncode($name);
    }

    /**
     * set subject
     * @param string $subject
     */
    public function setSubject($subject = '')
    {
        $this->Subject = $this->transferMimeEncode($subject);
    }

    /**
     * set body
     * @param string $body
     */
    public function setBody($body = '')
    {
        $this->Body = $this->transferEncode($body);
    }

    /**
     * set charset
     * @param string $charset
     */
    public function setCharSet($charset = 'ISO-2022-JP')
    {
        $this->CharSet = $charset;
    }

    /**
     * set encoding
     * @param string $encoding
     */
    public function setEncoding($encoding = '7bit')
    {
        $this->Encoding = $encoding;
    }

    /**
     * transfer mime encode
     * @param  string $string
     * @return string
     */
    public function transferMimeEncode($string = '')
    {
        if ($this->Language === 'ja'){
            return mb_encode_mimeheader($string);
        }else{
            return $string;
        }
    }

    /**
     * transfer encode
     * @param  string $string
     * @return string
     */
    public function transferEncode($string = '')
    {
        if ($this->Language === 'ja'){
            return mb_convert_encoding($string, $this->CharSet, "UTF-8");
        }else{
            return $string;
        }
    }

    /**
     * transfer array data to template
     * @param  array  $args
     * @param  string $template
     * @return string
     */
    public function transferFormToTemplate(array $args, $template)
    {
        foreach ($args as $key => $value) {
            if (strpos($template, '{$' . $key . '}') !== false) {
                $template = str_replace('{$' . $key . '}', $value, $template);
            }
        }
        return $template;
    }

    /**
     * set mail data
     * @param array $data
     */
    public function setMailData($data = array()){
        if (is_array($data) && !empty($data)){
            $this->Data = $data;
        }
    }

    /**
     * set mail template
     * @param string $file path of template
     */
    public function setMailTemplate($file)
    {
        if (!file_exists($file)) {
            return false;
        }
        $this->File = $file;

        $template = file_get_contents($file);

        if (!empty($this->Data)){
            $this->Body = $this->transferFormToTemplate($this->Data, $template);
        } else {
            $this->Body = $template;
        }
    }

    /**
     * set test email
     * @param  boolean $condition
     */
    public function test($condition = true)
    {
        if ($condition === true){
            $this->To = 'test@cybridge.jp';
            $this->ToName = 'Test Cybridge';
        }
    }

    /**
     * send mail
     * @param  array  $headers
     * @return boolean
     */
    public function send($headers = array())
    {
        if ( count($headers) === 0 ) {
            $headers = array(
                "MIME-Version: 1.0",
                "Content-Type: {$this->Type}; charset={$this->CharSet}",
                "Content-transfer-encoding: {$this->Encoding}",
                "From: {$this->FromName} <{$this->From}>",
            );
        }

        if ($this->Language === 'ja'){
            mb_language("Japanese");
            mb_internal_encoding('UTF-8');

            return mb_send_mail($this->To, $this->Subject, $this->Body, implode($this->Newline, $headers));
        } else {
            return mail($this->To, $this->Subject, $this->Body, implode($this->Newline, $headers));
        }
    }
}
