<?php

class GamesController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data=array();
        if($this->isLog()){
            $userid=$_SESSION['user']->getId();
            $userTeamsCollection= new UserTeamsCollection();
            $userteams= $userTeamsCollection->getAll(array('user_id'=>$userid));
            $data['userteams']=$userteams;
        }

        $gamesCollection=new GamesCollection();
        $where1=array();
        $where2=array();
        $teamCollection= new TeamsCollection();
        $teams=$teamCollection->getAll(array(),-1,0,"country_id,team_name ASC");

        $teamId1=(isset($_GET['team_id1'])&&$_GET['team_id1']!=0?(int)$_GET['team_id1']:'');
        $teamId2=(isset($_GET['team_id2'])&&$_GET['team_id2']!=0?(int)$_GET['team_id2']:'');
        if($teamId1!=''){
            $where1['home_team_id']=$teamId1;
            $where1['away_team_id']=$teamId1;
        }
        if($teamId2!=''){
            $where2['home_team_id']=$teamId2;
            $where2['away_team_id']=$teamId2;
        }

        $filter=(isset($_GET['filter'])&&$_GET['filter']!='0'?$_GET['filter']:'date_play ASC');

        $rows=count($gamesCollection->getAllByTeam($where1,$where2,-1,0,$filter))==0?1:count($gamesCollection->getAllByTeam($where1,$where2,-1,0,$filter));
        $perPageSelect = (isset($_GET['perPage'])) ? (int)$_GET['perPage'] : 0;
        switch ($perPageSelect) {
            case 0:
                $perPage = 10;
                break;
            case 1:
                $perPage = 5;
                break;
            case 2:
                $perPage = 10;
                break;
            case 3:
                $perPage = 20;
                break;
            case 4:
                $perPage = 50;
                break;
            default:
                $perPage = 10;
        }




        $page = isset($_GET['page'])? (int)$_GET['page'] : 1;

        $offset  = ($page) ? ($page-1) * $perPage : 0;
        $pagination = new Pagination2();
        $pagination->setPerPage($perPage);
        $pagination->setTotalRows($rows);
        $pagination->setBaseUrl($_SERVER['SCRIPT_NAME']."?c=games&m=index&team_id1={$teamId1}&team_id2={$teamId2}&filter={$filter}&perPage={$perPageSelect}");

        $games=$gamesCollection->getAllByTeam($where1,$where2,$offset,$perPage,$filter);

        $data['games']=$games;
        $data['pagination']=$pagination;
        $data['page']=$page;
        $data['perPageSelect']=$perPageSelect;
        $data['filter']=$filter;
        $data['teamId1']=$teamId1;
        $data['teamId2']=$teamId2;
        $data['teams']=$teams;

        $this->loadFrontView('game/listing',$data);
    }
}