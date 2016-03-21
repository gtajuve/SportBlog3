<?php

class DashboardController extends Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if (!$this->loggedIn()) {
            header('Location: index.php?c=login&m=login');
        }
        $data=array();
        $userCollection=new UserCollection();
        $numUsers=count($userCollection->getAll());
        $teamsCollection= new TeamsCollection();
        $numTeams=count($teamsCollection->getAll());
        $playersCollection=new PlayersCollection();
        $numPlayers=count($playersCollection->getAll());
        $gamesCollection=new GamesCollection();
        $numGames=count($gamesCollection->getAll());
        $data['numUsers']=$numUsers;
        $data['numTeams']=$numTeams;
        $data['numPlayers']=$numPlayers;
        $data['numGames']=$numGames;

        $this->loadView('dashboard', $data);
    }


}