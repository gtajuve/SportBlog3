<?php

/**
 * Created by PhpStorm.
 * User: joro
 * Date: 3/19/16
 * Time: 12:23 AM
 */
class RosterController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data=array();


        if(isset($_GET['id'])){
            $gameId=(int)$_GET['id'];
        }else{
            header("Location:index.php?c=game&m=index");
            exit;
        }
        $gamesCollection=new GamesCollection();
        $game=$gamesCollection->getOne($gameId);
        if($game==null){
            header("Location:index.php?c=game&m=index");
            exit;
        }
        $where=array();
        $where['game_id']=$gameId;
        $gamePlayersCollection=new GamesPlayersCollection();
        $gameInfo=$gamePlayersCollection->getAll($where);

        $data['game']=$game;
        $data['gameInfo']=$gameInfo;
        $data['gameId']=$gameId;

        if($this->isLog()){
            $userid=$_SESSION['user']->getId();
            $userTeamsCollection= new UserTeamsCollection();
            $userteams= $userTeamsCollection->getAll(array('user_id'=>$userid));
            $data['userteams']=$userteams;
        }

        $this->loadFrontView('roster',$data);
    }

}