<?php


class RosterController extends Controller
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
        $this->loadView('roster/listing',$data);
    }
    public function update()
    {
        $data=array();

        if(!$this->isLogAdmin()){
            header('Location:index.php?c=login&m=login');
            exit;
        }
        $errors=array();
        if(isset($_GET['id'])){
            $gameId=(int)$_GET['id'];
        }
        $gameCollection= new GamesCollection();
        $game=$gameCollection->getOne($gameId);
        if($game==null){
            header("Location:index.php?c=game&m=index");
            exit;
        }

        $scoreArr=explode(':',$game->getScore());
        $where=array();
        $playerCollection= new PlayersCollection();
        $where['team_id']=$game->getHomeTeamId();
        $where['g.id']=$gameId;
        $playersHT=$playerCollection->getAllForGame($where);
        $where['team_id']=$game->getAwayTeamId();
        $playersAT=$playerCollection->getAllForGame($where);
        $data['game']=$game;
        $data['gameId']=$gameId;
        $data['game']=$game;
        $data['playersHT']=$playersHT;
        $data['playersAT']=$playersAT;

        if(isset($_POST['submitPlayers'])){
            $gamesPlayersCollection=new GamesPlayersCollection();
            $gamesPlayersCollection->delete($gameId);
            $playersScore=array();
            $checkScoreHT=0;
            $checkScoreAT=0;
            if(empty($_POST['playersHT'])||empty($_POST['playersAT'])){
                $errors['player']="въведи играчи";
            }else{

                foreach ($_POST['playersHT'] as $player) {
                    $playersScore[$player]=(isset($_POST['goalsHT'.$player])&&$_POST['goalsHT'.$player]>-1)?$_POST['goalsHT'.$player]:0;
                    $checkScoreHT+=$playersScore[$player];
                }
                foreach ($_POST['playersAT'] as $player) {
                    $playersScore[$player]=(isset($_POST['goalsAT'.$player])&&$_POST['goalsAT'.$player]>-1)?$_POST['goalsAT'.$player]:0;
                    $checkScoreAT+=$playersScore[$player];
                }
                if($checkScoreHT!=$scoreArr[0]&&$checkScoreAT!=$scoreArr[1]){
                    echo 'Check Goalscorers';
                }else{
                    foreach ( $playersScore as $key=> $goals) {
                        $dataInput=array(
                            'game_id'  =>$gameId,
                            'player_id'=>$key,
                            'goals_ongame'=>$goals,
                        );

                        $gamesPlayersCollection= new GamesPlayersCollection();
                        $gamesPlayersCollection->create($dataInput);

                    }
                    foreach ( $playersScore as $key=> $goals) {

                        $player=$playerCollection->getOne($key);

                        $player->setGames($player->getGames()+1);
                        $player->setGoals($player->getGoals()+$goals);

                        $playerCollection->save($player);
                    }

                    header("Location:index.php?c=roster&m=index&id={$gameId}");
                    exit;

                }
            }

        }
        $this->loadView('roster/update',$data);
    }
    public function create()
    {
        $data=array();

        if(!$this->isLogAdmin()){
            header('Location:index.php?c=login&m=login');
            exit;
        }
        $errors=array();
        if(isset($_GET['id'])){
            $gameId=(int)$_GET['id'];
        }
        $gameCollection= new GamesCollection();
        $game=$gameCollection->getOne($gameId);
        if($game==null){
            header("Location:index.php?c=game&m=index");
            exit;
        }
        $scoreArr=explode(':',$game->getScore());
        $where=array();
        $playerCollection= new PlayersCollection();
        $where['team_id']=$game->getHomeTeamId();
        $playersHT=$playerCollection->getAll($where);
        $where['team_id']=$game->getAwayTeamId();
        $playersAT=$playerCollection->getAll($where);
        $data['game']=$game;
        $data['gameId']=$gameId;
        $data['playersHT']=$playersHT;
        $data['playersAT']=$playersAT;

        if(isset($_POST['submitPlayers'])){
            $playersScore=array();
            $checkScoreHT=0;
            $checkScoreAT=0;
            if(empty($_POST['playersHT'])||empty($_POST['playersAT'])){
                $errors['player']="въведи играчи";
            }else{

                foreach ($_POST['playersHT'] as $player) {
                    $playersScore[$player]=(isset($_POST['goalsHT'.$player])&&$_POST['goalsHT'.$player]>-1)?$_POST['goalsHT'.$player]:0;
                    $checkScoreHT+=$playersScore[$player];
                }
                foreach ($_POST['playersAT'] as $player) {
                    $playersScore[$player]=(isset($_POST['goalsAT'.$player])&&$_POST['goalsAT'.$player]>-1)?$_POST['goalsAT'.$player]:0;
                    $checkScoreAT+=$playersScore[$player];
                }
                if($checkScoreHT!=$scoreArr[0]&&$checkScoreAT!=$scoreArr[1]){
                    echo 'Check Goalscorers';
                }else{
                    foreach ( $playersScore as $key=> $goals) {
                        $dataInput=array(
                            'game_id'  =>$gameId,
                            'player_id'=>$key,
                            'goals_ongame'=>$goals,
                        );

                        $gamesPlayersCollection= new GamesPlayersCollection();
                        $gamesPlayersCollection->create($dataInput);

                    }
                    foreach ( $playersScore as $key=> $goals) {

                        $player=$playerCollection->getOne($key);

                        $player->setGames($player->getGames()+1);
                        $player->setGoals($player->getGoals()+$goals);

                        $playerCollection->save($player);
                    }

                    header("Location:index.php?c=roster&m=index&id={$gameId}");
                    exit;

                }
            }

        }


        $this->loadView('roster/create',$data);
    }
    public function delete()
    {
        if(isset($_GET['id'])&&$_GET['id']>0){
            $game_id=(int)$_GET['id'];
            $gamesPlayersCollection=new GamesPlayersCollection();
            $gamesPlayersCollection->delete($game_id);

        }
        header('Location:index.php?c=roster&id='.$game_id);
        exit;
    }

}