<?php

defined('VIEW_DIR') or
    define('VIEW_DIR', realpath(dirname(__FILE__) .'/../views'));

class defaultController {
    private $loader;
    private $twig;
    
    /**
     * Constructor
     */
    public function __construct() {
        $this->loader = new Twig_Loader_Filesystem(VIEW_DIR);
        $this->twig = new Twig_Environment($this->loader, array(
          //  'cache' => '/tmp/twig',
        ));
    }
    
    /**
     * Index method
     */
    public function index() {
        echo $this->twig->render('index.html');
    }
}