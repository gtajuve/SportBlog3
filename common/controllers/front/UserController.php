<?php


class UserController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function  index()
    {
       $data=array();
        if(!$this->isLog()){
            header('Location:index.php?c=home');
            exit;
        }
       $userid=$_SESSION['user']->getId();
       $userTeamsCollection= new UserTeamsCollection();
        $userteams= $userTeamsCollection->getAll(array('user_id'=>$userid));
        $data['userteams']=$userteams;
        $where=array();
       foreach($userteams as $team) {
            $where[]=$team->getTeamId();
        }
        $gamesCollection= new GamesCollection();
        $games=$gamesCollection->getAllManyTeams($where,5);
        $messageCollection=new MessagesCollection();
        $messages=$messageCollection->getAllByTeams($where,3,0,"m.reg_time DESC");
        $data['games']=$games;
        $data['messages']=$messages;

       $this->loadFrontView("user/home",$data);
    }
    public function add()
    {
        $data=array();
        if(!$this->isLog()){
            header('Location:index.php?c=home');
            exit;
        }
        $userid=$_SESSION['user']->getId();
        if(isset($_POST['add'])){
            $teamId=$_POST['team_id'];
            $inputData=array(
                'user_id'=>$userid,
                'team_id'=>$teamId,
            );
            $userTeamsCollection=new UserTeamsCollection();
            $userTeamsCollection->create($inputData);
            header("Location:index.php?c=teams&m=single&id={$teamId}");
            exit;
        }

        $userTeamsCollection= new UserTeamsCollection();
        $userteams= $userTeamsCollection->getAll(array('user_id'=>$userid));
        $where=array();
        foreach($userteams as $team) {
            $where[]=$team->getTeamId();
        }
        $teamCollection= new TeamsCollection();
        $teams=$teamCollection->getAllExp($where,-1,0,"country_id,team_name ASC");
        $data['teams']=$teams;
        $data['userteams']=$userteams;
        $this->loadFrontView("user/add",$data);

    }
}