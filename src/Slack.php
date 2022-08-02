<?php
namespace booosta\slack;

use \booosta\Framework as b;
b::init_module('slack');


class Slack extends \booosta\base\Module
{ 
  use moduletrait_slack;

  protected $url, $rest;


  public function __construct($url = null)
  {
    parent::__construct();
    if($url) $this->url = $url;
  }

  public function set_url($url) { $this->url = $url; }

  public function say($content)
  {
    if(!is_object($this->rest)) $this->rest = $this->makeInstance("\\booosta\\slack\\restapp", $this->url);
    $this->rest->say($content);
  }
}


class restapp extends \booosta\rest\Application
{
  public function __construct($url)
  {
    parent::__construct();
    $this->url = $url;
  }

  public function say($content)
  {
    $result = $this->post('', ['text' => $content]);
  }
}
