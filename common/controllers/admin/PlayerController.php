<?php

class PlayerController extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data=array();

        if(!$this->isLogAdmin()){
            header('Location:index.php?c=login&m=login');
            exit;
        }
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
        $pagination->setBaseUrl($_SERVER['SCRIPT_NAME']."?c=player&m=index&team_id={$teamId}&pos={$pos}&filter={$filter}&pattern={$pattern}&perPage={$perPageSelect}");
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

        $this->loadView('player/listing',$data);
    }
    public function create()
    {
        $data=array();

        if(!$this->isLogAdmin()){
            header('Location:index.php?c=login&m=login');
            exit;
        }

        $errors=array();

        $playerInfo=array(

            'first_name'        =>'',
            'last_name'         =>'',
            'team_id'           =>'',
            'position_player'   =>'',
            'image'             =>'',
            'country'           =>'',
            'games'             =>'',
            'goals'             =>'',
        );

        $teamCollection=new TeamsCollection();
        $teams=$teamCollection->getAll(array(),-1,0,"country_id,team_name ASC");
        $data['teams']=$teams;
        $data['errors']=$errors;
        $data['playerInfo']=$playerInfo;


        if(isset($_POST['change'])){
            $playerInfo['first_name']=isset($_POST['fname'])?addslashes(trim($_POST['fname'])):$playerInfo['first_name'];
            $playerInfo['last_name']=isset($_POST['lname'])?addslashes(trim($_POST['lname'])):$playerInfo['last_name'];
            $playerInfo['team_id']=isset($_POST['team_id'])?$_POST['team_id']:"";
            $playerInfo['position_player']=isset($_POST['position'])?$_POST['position']:$playerInfo['position_player'];
            $playerInfo['image']=strlen(addslashes(trim($_POST['imagePlayer'])))>3?addslashes(trim($_POST['imagePlayer'])):"http://cache.images.core.optasports.com/soccer/players/150x150/53096.png";
            $playerInfo['country']=isset($_POST['countryPlayer'])?addslashes(trim($_POST['countryPlayer'])):$playerInfo['country'];
            $playerInfo['games']=isset($_POST['games'])?$_POST['games']:$playerInfo['games'];
            $playerInfo['goals']=isset($_POST['goals'])?$_POST['goals']:$playerInfo['goals'];

            $errors=$this->validationPlayerInfo($playerInfo);
            $data['errors']=$errors;
            $data['playerInfo']=$playerInfo;


            if(empty($errors)){

                $player= new PlayersEntity();
                $player->init($playerInfo);
                $playerCollection=new PlayersCollection();
                $playerCollection->save($player);
                $_SESSION['flashMessage']= 'Успешенa добавяне';
                header("Location:index.php?c=player&m=index");
                exit;

            }
        }

        $this->loadView('player/create',$data);

    }
    public function update()
    {
        $data=array();

        if(!$this->isLogAdmin()){
            header('Location:index.php?c=login&m=login');
            exit;
        }
        $errors=array();
        $teamCollection=new TeamsCollection();
        $teams=$teamCollection->getAll(array(),-1,0,"country_id,team_name ASC");
        $playersCollection=new PlayersCollection();

        $player=$playersCollection->getOne($_GET['id']);
        $id=$_GET['id'];
        if($player==null){
            header("Location:index.php?c=player&m=index");
            exit;
        }

        $playerInfo=array(

            'first_name'        =>$player->getFirstName(),
            'last_name'         =>$player->getLastName(),
            'team_id'           =>$player->getTeamId(),
            'position_player'   =>$player->getPositionPlayer(),
            'image'             =>$player->getImage(),
            'country'           =>$player->getCountry(),
            'games'             =>$player->getGames(),
            'goals'             =>$player->getGoals(),
        );

        $data['teams']=$teams;
        $data['playerInfo']=$playerInfo;
        $data['errors']=$errors;
        $data['id']=$id;

        if(isset($_POST['change'])){
            $playerInfo['first_name']=isset($_POST['fname'])?addslashes(trim($_POST['fname'])):$playerInfo['first_name'];
            $playerInfo['last_name']=isset($_POST['lname'])?addslashes(trim($_POST['lname'])):$playerInfo['last_name'];
            $playerInfo['team_id']=isset($_POST['team_id'])?$_POST['team_id']:$playerInfo['team_id'];
            $playerInfo['position_player']=isset($_POST['position'])?$_POST['position']:$playerInfo['position_player'];
            $playerInfo['image']=isset($_POST['imagePlayer'])?addslashes(trim($_POST['imagePlayer'])):$playerInfo['image'];
            $playerInfo['country']=isset($_POST['countryPlayer'])?addslashes(trim($_POST['countryPlayer'])):$playerInfo['country'];
            $playerInfo['games']=isset($_POST['games'])?$_POST['games']:$playerInfo['games'];
            $playerInfo['goals']=isset($_POST['goals'])?$_POST['goals']:$playerInfo['goals'];


            $errors=$this->validationPlayerInfo($playerInfo);
            $data['playerInfo']=$playerInfo;
            $data['errors']=$errors;

            if(empty($errors)){
                $player->init($playerInfo);


                $playersCollection->save($player);

                $_SESSION['flashMessage']= 'Успешенa промяна';
                header("Location:index.php?c=player&m=index");

                exit;
            }
        }

        $this->loadView('player/update',$data);

    }
    public function delete()
    {
        if(!$this->isLogAdmin()){
            header('Location:index.php?c=login&m=login');
            exit;
        }
        if(isset($_GET['id'])&&$_GET['id']>0) {
            $id = (int)$_GET['id'];
            $playerCollection=new PlayersCollection();
            $playerCollection->delete($id);
            $gamesPlayerCollection= new GamesPlayersCollection();
            $gamesPlayerCollection->deletePlayer($id);
            $_SESSION['flashMessage']= 'премахнат играч';
        }
        header('Location:index.php?c=player&m=index');
        exit;
    }
    private function validationPlayerInfo($inputData){
        $errors=array();
        if (!isset($inputData['first_name'])||strlen($inputData['first_name'])<2||strlen($inputData['first_name'])>50) {
            $errors['first_name'] = 'Incorect name';
        }
        if (!isset($inputData['last_name'])||strlen($inputData['last_name'])<2||strlen($inputData['last_name'])>50) {
            $errors['last_name'] = 'Incorect name';
        }
        if (!isset($inputData['image'])||strlen($inputData['image'])<2||strlen($inputData['image'])>255) {
            $errors['image'] = 'Incorect image';
        }
        if (!isset($inputData['country'])||strlen($inputData['country'])<2||strlen($inputData['country'])>50) {
            $errors['country'] = 'Incorect country';
        }
        if (!isset($inputData['games'])||$inputData['games']<0) {
            $errors['games'] = 'Incorect games';
        }
        if (!isset($inputData['goals'])||$inputData['goals']<0) {
            $errors['goals'] = 'Incorect goals';
        }
        return $errors;
    }
}