<?php

class TeamsController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        $data=array();

        $teamsCollection= new TeamsCollection();
        $countrysCollection=new CountrysCollection();
        $countrys=$countrysCollection->getAll();
        $where=array();
        $countryId=(isset($_GET['country_id'])&&$_GET['country_id']!=0?$where['country_id']=(int)$_GET['country_id']:'');
        $filter=(isset($_GET['filter'])?$_GET['filter']:'team_name ASC');
        $filter='country_id,'.$filter;
        $pattern=(isset($_GET['pattern'])?htmlspecialchars(trim($_GET['pattern'])):null);
        $rows=count($teamsCollection->getAll($where,-1,0,$filter,$pattern))==0?1:count($teamsCollection->getAll($where,-1,0,$filter,$pattern));
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
        $pagination = new Pagination();
        $pagination->setPerPage($perPage);
        $pagination->setTotalRows($rows);

        $pagination->setBaseUrl($_SERVER['SCRIPT_NAME']."?c=teams&m=index&country_id={$countryId}&filter={$filter}&pattern={$pattern}&perPage={$perPageSelect}");
        $teams=$teamsCollection->getAll($where,$offset,$perPage,$filter,$pattern);
        $data['teams']=$teams;
        $data['pagination']=$pagination;
        $data['countrys']=$countrys;
        $data['pattern']=$pattern;
        $data['filter']=$filter;
        $data['countryId']=$countryId;
        $data['perPageSelect']=$perPageSelect;
        $data['page']=$page;

        $this->loadFrontView("team/listing",$data);

    }
    public function single()
    {
        $data=array();
        $filter='last_name ASC';
        if(isset($_GET['f'])){
            switch ($_GET['f']) {
                case 0:
                    $filter='position_player ASC';
                    break;
                case 1:
                    $filter='games DESC';
                    break;
                case 2:
                    $filter='goals DESC';
                    break;
            }
        }
        if($this->isLog()){
            $userid=$_SESSION['user']->getId();
            $userTeamsCollection= new UserTeamsCollection();
            $userteams= $userTeamsCollection->getAll(array('user_id'=>$userid));
            $data['userteams']=$userteams;
        }

        $teamId=isset($_GET['id'])?$_GET['id']:0;
        $teamsCollection=new  TeamsCollection();
        $teamInfo=$teamsCollection->getOne($teamId);
        $gamesCollection= new GamesCollection();
        $where['home_team_id']=$teamId;
        $where['away_team_id']=$teamId;
        $games=$gamesCollection->getAllByTeam($where,array(),5,0,'date_play DESC');
        $playersCollection= new PlayersCollection();
        $players=$playersCollection->getAll(array('team_id'=>$teamId),-1,0,$filter);
        $data['teamId']=$teamId;

        $data['players']=$players;
        $data['games']=$games;
        $data['teamInfo']=$teamInfo;
        $this->loadFrontView('team/info',$data);

    }

}