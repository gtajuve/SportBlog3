<?php


class LoginController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function login(){
        $data=array();

        if($this->isLog()){
            header('Location:index.php');
            exit;
        }
        if (isset($_POST['login'])&&  strlen(trim($_POST['login']))>3) {
            $login=trim($_POST['login']);

            $usercollection= new UserCollection();
            $user=$usercollection->getOnebyUsername($login);


            if ($user==null) {
                $errors['login']='incorect user' ;
            }else{
                if ($user->getPassword()==sha1(trim($_POST['pass']))) {
                    $user->deletePassword();
                    $_SESSION['login']=1;
                    $_SESSION['user']=$user;

                    header('Location:index.php?c=user&m=index');
                    exit;
                }else{
                    $errors['login']="Incorect data";

                }
            }


        }else{
            $errors['login']="Incorect data";
        }
        $data['errors']=$errors;
        $this->loadFrontView('login',$data);
    }
    public function registration(){
        $data=array();

        if($this->isLog()){
            header('Location:index.php');
            exit;
        }
        $teamCollection= new TeamsCollection();
        $teams=$teamCollection->getAll(array(),-1,0,"country_name,team_name ASC");

        $errors=array();
        $inputData= [
            'login'    =>'',
            'password' =>'',
            'mail'     =>'',
            'gender'   =>'',

        ];
        if (isset($_POST['register'])) {
            $inputData= [
                'username'    =>isset($_POST['login'])?addslashes(trim($_POST['login'])):'',
                'password' =>isset($_POST['pass'])?(trim($_POST['pass'])):'',
                'email'     =>isset($_POST['mail'])?addslashes(trim($_POST['mail'])):'',
                'gender'   =>isset($_POST['gender'])?$_POST['gender']:'',

            ];

            $errors=$this->validationUserData($inputData);
            $data['errors']=$errors;
            $data['inputData']=$inputData;

            if(empty($errors)){
                $userCollection = new UserCollection();

                $user=$userCollection->getOnebyUsername($inputData['username']);
                if($user!=null){
                    $errors['username']= 'Името съществува';
                    $data['errors']=$errors;
                }else{
                    $inputData['password']=sha1($inputData['password']);
                    $inputData['reg_time']=time();

                    $userCollection->create($inputData);
                    $userEntity=$userCollection->getOnebyUsername($inputData['username']);

                    if(isset($_POST['team_id'])){
                        $inputInfo=[
                           'user_id'=> $userEntity->getId(),
                          'team_id'=> $_POST['team_id'],
                        ];

                        $userTeamCollection=new UserTeamsCollection();
                        $userTeamCollection->create($inputInfo);

                    }
                    header("Location:index.php?c=login&m=login");
                    exit;

                }
            }


        }
        $data['teams']=$teams;
        $data['errors']=$errors;
        $this->loadFrontView('registration',$data);
    }
    public function logout(){
        unset($_SESSION['user']);
        unset($_SESSION['login']);
        header('Location:index.php?c=login&m=login');
        exit;
    }

    private function validationUserData($inputData)
    {
        $errors=array();
        if (!isset($inputData['username'])||strlen($inputData['username'])<3||strlen($inputData['username'])>50) {
            $errors['username'] = 'Incorect username';
        }
        if(!isset($inputData['password'])||strlen($inputData['password'])<3||strlen($inputData['password'])>50) {
            $errors['pass']='Incorect Password';
        }
        if(!isset($inputData['email'])||strlen($inputData['email'])<6||strlen($inputData['email'])>50) {
            $errors['mail']='Incorect Email';
        }

        if(!isset($inputData['gender'])||($inputData['gender']!='male'&&$inputData['gender']!='female')){
            $errors['gender']='Please choose gender';
        }


        return $errors;
    }

}