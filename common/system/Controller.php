<?php

class Controller {

    public function __construct()
    {
        session_start();
        header('Content-Type: text/html; charset=utf-8');
    }

    public function index() {
        echo 'Please create index method';
        die();
    }

    protected function loggedIn()
    {
        if (isset($_SESSION['login']) && $_SESSION['login'] == 1 && isset($_SESSION['user'])) {
            return true;
        }
        return false;
    }

    protected function loadView($view, $data = array()) {
        extract($data);
        require(__DIR__.'/../views/admin/'.$view.'.php');
    }
    protected function loadFrontView($view, $data = array()) {
        extract($data);
        require(__DIR__.'/../views/front/'.$view.'.php');
    }
    function isLogAdmin(){
        if(isset($_SESSION['login'])&&$_SESSION['login']==1&&isset($_SESSION['user'])&&$_SESSION['user']->getPermition()=='1'){
            return true;

        }
        else {
            return false;
        }

    }
    function isLog(){
        if(isset($_SESSION['login'])&&$_SESSION['login']==1&&isset($_SESSION['user'])){
            return true;

        }
        else {
            return false;
        }

    }

}