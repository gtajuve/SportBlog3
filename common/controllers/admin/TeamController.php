<?php

class TeamController extends Controller
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


        $teamsCollection= new TeamsCollection();
        $countrysCollection=new CountrysCollection();
        $countrys=$countrysCollection->getAll();
        $where=array();
        $countryId=(isset($_GET['country_id'])&&$_GET['country_id']!=0?$where['country_id']=(int)$_GET['country_id']:'');
        $filter=(isset($_GET['filter'])?$_GET['filter']:'team_name ASC');
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

        $pagination->setBaseUrl($_SERVER['SCRIPT_NAME']."?c=team&m=index&country_id={$countryId}&filter={$filter}&pattern={$pattern}&perPage={$perPageSelect}");
        $teams=$teamsCollection->getAll($where,$offset,$perPage,$filter,$pattern);
        $data['teams']=$teams;
        $data['pagination']=$pagination;
        $data['countrys']=$countrys;
        $data['pattern']=$pattern;
        $data['filter']=$filter;
        $data['countryId']=$countryId;
        $data['perPageSelect']=$perPageSelect;
        $data['page']=$page;

        $this->loadView('team/listing',$data);
    }

    public function create()
    {
        $data=array();
        if(!$this->isLogAdmin()){
            header('Location:index.php?c=login&m=login');
            exit;
        }
        $errors=array();
        $countrysCollection=new CountrysCollection();
        $countrys=$countrysCollection->getAll();
        $inputData=array(
            'team_name'      =>'',
            'image'     =>'',
            'address'   =>'',
            'country_id'=>''
        );
        $data['inputData']=$inputData;
        $data['countrys']=$countrys;
        $data['errors']=$errors;
        if(isset($_POST['change'])){
            $inputData=array(
                "team_name"=>addslashes(trim($_POST['name'])),
                "image"=>addslashes(trim($_POST['image'])),
                "address"=>addslashes(trim($_POST['address'])),
                "country_id"=>$_POST['country_id']
            );

            $errors=$this->validationTeamInfo($inputData);
            $data['errors']=$errors;
            $teamsCollection=new TeamsCollection();
            $team=new TeamsEntity();
            $team->init($inputData);

            if(empty($errors)){

                $teamsCollection->save($team);

                $_SESSION['flashMessage']="успешна добавяне";

                header("Location:index.php?c=team&m=index");
                exit;
            }
        }


        $this->loadView('team/create',$data);

    }
    public function update()
    {
        $data=array();
        if(!$this->isLogAdmin()){
            header('Location:index.php?c=login&m=login');
            exit;
        }

        $countrysCollection=new CountrysCollection();
        $countrys=$countrysCollection->getAll();
        $data['countrys']=$countrys;
        $errors=array();
        $data['errors']=$errors;
        if(!isset($_GET['id'])){
            header('index.php?c=team&m=index');
            exit;
        }
        $id=(int)$_GET['id'];

        $teamsCollection=new TeamsCollection();
        $team=$teamsCollection->getOne($id);
        if($team==null){
            header('index.php?c=team&m=index');
            exit;
        }

        $inputData=array(
            "team_name"=>$team->getTeamName(),
            "image"=>$team->getImage(),
            "address"=>$team->getAddress(),
            "country_id"=>$team->getCountryId()
        );
        $data['inputData']=$inputData;
        $data['id']=$id;

        if(isset($_POST['change'])){
            $inputData=array(
                "team_name"=>addslashes(trim($_POST['name'])),
                "image"=>addslashes(trim($_POST['image'])),
                "address"=>addslashes(trim($_POST['address'])),
                "country_id"=>$_POST['country_id']
            );
            $errors=$this->validationTeamInfo($inputData);
            $data['errors']=$errors;
            $data['inputData']=$inputData;
            if(empty($errors)){


                $team->setTeamName($inputData['team_name']);
                $team->setImage($inputData['image']);
                $team->setAddress($inputData['address']);
                $team->setCountryId($inputData['country_id']);

                $teamsCollection->save($team);
                $_SESSION['flashMessage']="успешна промяна";

                header("Location:index.php?c=team&m=index");
                exit;
            }


        }

        $this->loadView('team/update',$data);

    }
    public function delete()
    {

        if(!$this->isLogAdmin()){
            header('Location:index.php?c=login&m=login');
            exit;
        }
        if(isset($_GET['id'])&&$_GET['id']>0){

            $teamsCollection=new TeamsCollection();
            $teamsCollection->delete($_GET['id']);
            $playersCollection=new PlayersCollection();
            $playersCollection->updatePlayer(array('team_id'=>$_GET['id']),array('team_id'=>null));

            $_SESSION['flashMessage']="изтрит отбор";

        }
        header('Location:index.php?c=team&m=index');
        exit;

    }
    public function images()
    {
        $data=array();
        if(!$this->isLogAdmin()){
            header('Location:index.php?c=login&m=login');
            exit;
        }
        if(!isset($_GET['id'])) {

            header('Location:index.php?c=team&m=index');
            exit;
        }
        $team_id=$_GET['id'];
        $where=array();
        $where['team_id']=$team_id;
        $teamsImagesCollection=new TeamsImagesCollection();


        $images=$teamsImagesCollection->getAll($where);
        $data['images']=$images;
        $data['team_id']=$team_id;
        if(isset($_POST['addimage'])){

            $imageTitle=isset($_POST['title'])?htmlspecialchars(trim($_POST['title'])):'';
            $fileUpload= new UploadFile("image");
            $file = $fileUpload->getFilename();

            $fileExtention = $fileUpload->getFileExtention();

            $imageErrors = array();
            $data['imageErrors']=$imageErrors;

            if ($file != '') {

                $imageErrors =  $fileUpload->validate();
                $data['imageErrors']=$imageErrors;
                $newName = sha1(time()).'.'.$fileExtention;
                $insertInfo = array(
                    'team_id' => $_GET['id'],
                    'image_name' => $newName,
                    'title'=>$imageTitle
                );


                if (empty($imageErrors)) {
                    $teamImagesEntity=new TeamsImagesEntity();
                    $teamImagesEntity->init($insertInfo);
                    $teamsImagesCollection->save($teamImagesEntity);
                    $fileUpload->upload('uploads/teams/images/'.$newName);
                    header("Location: index.php?c=team&m=images&id=".$team_id);
                }
            }


        }
        $this->loadView("team/images",$data);


    }
    public function deleteimage()
    {
        if(!$this->isLogAdmin()){
            header('Location:index.php?c=login&m=login');
            exit;
        }
        if(isset($_GET['id'])&&$_GET['id']>0){
            $id=(int)$_GET['id'];

            $teamsImagesCollection=new TeamsImagesCollection();
            $image=$teamsImagesCollection->getOne($id);

            unlink("uploads/teams/images/{$image->getImageName()}");
            $teamsImagesCollection->delete($id);

            header('Location:index.php?c=team&m=images &id='.$image->getTeamId());
            exit;

        }
    }
    private function validationTeamInfo($inputData){
        $errors=array();
        if (!isset($inputData['team_name'])||strlen($inputData['team_name'])<3||strlen($inputData['team_name'])>50) {
            $errors['name'] = 'Incorect name';
        }
        if (!isset($inputData['image'])||strlen($inputData['image'])<3||strlen($inputData['image'])>255) {
            $errors['image'] = 'Incorect path';
        }
        if (!isset($inputData['address'])||strlen($inputData['address'])<3||strlen($inputData['address'])>255) {
            $errors['address'] = 'Incorect address';
        }
        return $errors;
    }


}