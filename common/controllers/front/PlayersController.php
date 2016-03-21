<?php


class PlayersController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        $playersCollection=new PlayersCollection();
        $teamsCollection= new TeamsCollection();
        $teams=$teamsCollection->getAll(array(),-1,0,"country_id,team_name ASC");
        $countrysCollection=new CountrysCollection();
        $countrys=$countrysCollection->getAll();

        $country=-1;
        $openTag=false;

        $where=array();
        $teamId=(isset($_GET['team_id'])&&$_GET['team_id']!=0?$where['team_id']=(int)$_GET['team_id']:'');
        $pos=(isset($_GET['pos'])&&$_GET['pos']!=''?$where['position_player']=$_GET['pos']:'');
        $filter=(isset($_GET['filter'])&&$_GET['filter']!='0'?$_GET['filter']:'last_name ASC');
        $pattern=(isset($_GET['pattern'])?htmlspecialchars(trim($_GET['pattern'])):null);
        $rows=count($playersCollection->getAll($where,-1,0,$filter,$pattern))==0?1:count($playersCollection->getAll($where,-1,0,$filter,$pattern));
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
        $pagination->setBaseUrl($_SERVER['SCRIPT_NAME']."?c=players&m=index&team_id={$teamId}&pos={$pos}&filter={$filter}&pattern={$pattern}&perPage={$perPageSelect}");
        $players=$playersCollection->getAll($where,$offset,$perPage,$filter,$pattern);
        $data['players']=$players;
        $data['pagination']=$pagination;
        $data['page']=$page;
        $data['perPageSelect']=$perPageSelect;
        $data['pattern']=$pattern;
        $data['filter']=$filter;
        $data['pos']=$pos;
        $data['teamId']=$teamId;
        $data['openTag']=$openTag;
        $data['country']=$country;
        $data['countrys']=$countrys;
        $data['teams']=$teams;


        $this->loadFrontView("player/listing",$data);

    }
    public function single()
    {
        $data=array();
        $id=isset($_GET['id'])?$_GET['id']:0;
        $playerCollection=new PlayersCollection();
        $player= $playerCollection->getOne($id);
        switch ($player->getPositionPlayer()) {
                case 'G':
                    $player->setPositionPlayer('Вратар');
                    break;
                case 'D':
                    $player->setPositionPlayer('Защитник');
                    break;
                case 'M':
                    $player->setPositionPlayer('Полузащитник');
                    break;
                case 'F':
                    $player->setPositionPlayer('Нападател');
                    break;
            }

        $data['player']=$player;
        if($this->isLog()){
            $userid=$_SESSION['user']->getId();
            $userTeamsCollection= new UserTeamsCollection();
            $userteams= $userTeamsCollection->getAll(array('user_id'=>$userid));
            $data['userteams']=$userteams;
        }
        $this->loadFrontView("player/single",$data);

    }
}