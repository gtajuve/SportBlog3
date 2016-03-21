<?php

class GameController extends Controller
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
        $pagination = new Pagination();
        $pagination->setPerPage($perPage);
        $pagination->setTotalRows($rows);
        $pagination->setBaseUrl($_SERVER['SCRIPT_NAME']."?c=game&m=index&team_id1={$teamId1}&team_id2={$teamId2}&filter={$filter}&perPage={$perPageSelect}");
        $games=$gamesCollection->getAllByTeam($where1,$where2,$offset,$perPage,$filter);

        $data['games']=$games;
        $data['pagination']=$pagination;
        $data['page']=$page;
        $data['perPageSelect']=$perPageSelect;
        $data['filter']=$filter;
        $data['teamId1']=$teamId1;
        $data['teamId2']=$teamId2;
        $data['teams']=$teams;

        $this->loadView('game/listing',$data);
    }
    public function create()
    {
        $data=array();

        if(!$this->isLogAdmin()){
            header('Location:index.php?c=login&m=login');
            exit;
        }
        $errors=array();
        $teamCollection= new TeamsCollection();
        $teams=$teamCollection->getAll();
        $inputData=array(
            'home_team_id'=>'',
            'away_team_id'=>'',
            'home_score'=>'',
            'away_score'=>''
        );
        $data['errors']=$errors;
        $data['teams']=$teams;
        $data['inputData']=$inputData;

        if(isset($_POST['change'])) {
            $inputData = array(
                'home_team_id' => $_POST['home_team_id'],
                'away_team_id' => $_POST['away_team_id'],
                'home_score' => $_POST['home_score'],
                'away_score' => $_POST['away_score']
            );

            $errors = $this->validationGameInfo($inputData);
            $data['errors']=$errors;
            $data['inputData']=$inputData;
            if (empty($errors)) {
                $inputData['score'] =$inputData['home_score'].':'.$inputData['away_score'];
                $inputData['date_play']=time();
                unset($inputData['home_score']);
                unset($inputData['away_score']);
                $game= new GamesEntity();
                $game->init($inputData);
                $gamesCollection=new GamesCollection();
                $gamesCollection->save($game);
                $_SESSION['flash_massage']="успешна добавяне";
                header("Location:index.php?c=game&m=index");
                exit;
            }
        }
        $this->loadView('game/create',$data);
    }
    public function update()
    {
        $data=array();

        if(!$this->isLogAdmin()){
            header('Location:index.php?c=login&m=login');
            exit;
        }


        $errors=array();
        if(!isset($_GET['id'])){
            header("Location:index.php?c=game&m=index");
            exit;
        }
        $id=$_GET['id'];
        $teamCollection= new TeamsCollection();
        $teams=$teamCollection->getAll();

        $gamesCollection=new GamesCollection();
        $game=$gamesCollection->getOne($_GET['id']);
        if($game==null){
            header('Location:index.php?c=game&m=index');
            exit;
        }

        $scoreArr=explode(':',$game->getScore());

        $inputData=array(
            'home_team_id'=>$game->getHomeTeamId(),
            'away_team_id'=>$game->getAwayTeamId(),
            'home_score'=>$scoreArr[0],
            'away_score'=>$scoreArr[1],
        );

        $data['errors']=$errors;
        $data['teams']=$teams;
        $data['inputData']=$inputData;
        $data['id']=$id;
        if(isset($_POST['change'])) {
            $inputData = array(
                'home_team_id' => $_POST['home_team_id'],
                'away_team_id' => $_POST['away_team_id'],
                'home_score' => $_POST['home_score'],
                'away_score' => $_POST['away_score']
            );
            $errors = $this->validationGameInfo($inputData);
            $data['errors']=$errors;
            $data['inputData']=$inputData;
            if (empty($errors)) {
                $score =$inputData['home_score'].':'.$inputData['away_score'];
                unset($inputData['home_score']);
                unset($inputData['away_score']);
                $inputData['score']=$score;

                $game->init($inputData);
                $gamesCollection->save($game);
                $_SESSION['flash_massage']="успешна промяна";
                header("Location:index.php?c=game&m=index");
                exit;
            }
        }


        $this->loadView('game/update',$data);
    }
    private function validationGameInfo($inputData){
        $errors=array();
        if (!isset($inputData['home_team_id'])||!isset($inputData['away_team_id'])||$inputData['away_team_id']==$inputData['home_team_id']) {
            $errors['teams'] = 'Incorect name';
        }
        if (!isset($inputData['home_score'])||$inputData['home_score']<0) {
            $errors['home_score'] = 'Incorect score';
        }
        if (!isset($inputData['away_score'])||$inputData['away_score']<0) {
            $errors['away_score'] = 'Incorect score';
        }
        return $errors;
    }


}