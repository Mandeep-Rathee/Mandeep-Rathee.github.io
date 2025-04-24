<?php

class PHP_Email_Form {
  public $to = '';
  public $from_name = '';
  public $from_email = '';
  public $subject = '';
  public $smtp = false;
  public $ajax = false;
  private $messages = array();

  public function add_message($content, $label = '', $length = 0) {
    if (!empty($content)) {
      $message = $label ? "$label: $content" : $content;
      $this->messages[] = $message;
    }
  }

  public function send() {
    if (empty($this->to) || empty($this->from_email) || empty($this->subject)) {
      return 'Missing required fields.';
    }

    $headers = "From: {$this->from_name} <{$this->from_email}>\r\n";
    $headers .= "Reply-To: {$this->from_email}\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    $body = implode("\n", $this->messages);

    if ($this->smtp) {
      return 'SMTP not supported in this basic version.';
    } else {
      if (mail($this->to, $this->subject, $body, $headers)) {
        return 'OK';
      } else {
        return 'Failed to send email.';
      }
    }
  }
}
