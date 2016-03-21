<?php

/**
 * Created by PhpStorm.
 * User: joro
 * Date: 3/15/16
 * Time: 10:05 PM
 */
class HomeController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data=array();
        $messageCollection=new MessagesCollection();
        $messages=$messageCollection->getAll(array(),3,0,"m.reg_time DESC");
        $gamesCollection= new GamesCollection();
        $games=$gamesCollection->getAll(array(),5,0,'date_play DESC');
        $data['messages']=$messages;
        $data['games']=$games;


        $this->loadFrontView('home', $data);
    }


}