<?php

/**
 * Created by PhpStorm.
 * User: joro
 * Date: 3/7/16
 * Time: 10:02 PM
 */
class UserController extends Controller
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
        $userCollection=new UserCollection();

        $where=array();
        $pattern=(isset($_GET['pattern'])?htmlspecialchars(trim($_GET['pattern'])):null);
        $rows=count($userCollection->getAll($where,-1,0,$pattern))==0?1:count($userCollection->getAll($where,-1,0,$pattern));
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

        $pagination->setBaseUrl($_SERVER['SCRIPT_NAME']."?c=user&m=index&pattern={$pattern}&perPage={$perPageSelect}");
        $users=$userCollection->getAll($where,$offset,$perPage,$pattern);
        $data['pagination']=$pagination;
        $data['page']=$page;
        $data['perPageSelect']=$perPageSelect;
        $data['pattern']=$pattern;
        $data['users']=$users;


       $this->loadView('user/listing',$data);
    }
    public function create()
    {
        $data=array();

        if(!$this->isLogAdmin()){
            header('Location:index.php?c=login&m=login');
            exit;
        }
        $errors=array();
        $inputData= [
            'username'    =>'',
            'password' =>'',
            'email'     =>'',
            'gender'   =>''
        ];
        $data['errors']=$errors;
        $data['inputData']=$inputData;
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
                    $newUser=new UsersEntity();
                    $newUser->setUsername($inputData['username']);
                    $newUser->setPassword($inputData['password']);
                    $newUser->setEmail($inputData['email']);
                    $newUser->setGender($inputData['gender']);
                    $newUser->setRegTime($inputData['reg_time']);
                    $userCollection->save($newUser);
                    $_SESSION['flashMessage']='добавен потрбител';
                    header("Location:index.php?c=user&m=index");
                    exit;

                }
            }


        }

        $this->loadView('user/create',$data);
    }
    public function update()
    {
        $data=array();

        if(!$this->isLogAdmin()){
            header('Location:index.php?c=login&m=login');
            exit;
        }
        if(isset($_GET['id'])) {
            $id = $_GET['id'];
            $userCollection = new UserCollection();
            $user = $userCollection->getOne($id);

            $errors = array();
            $inputData = [

                'username' => $user->getUsername(),
                'email' => $user->getEmail(),
                'gender' => $user->getGender(),

            ];
            $data['errors']=$errors;
            $data['inputData']=$inputData;
            if (isset($_POST['change'])) {
                $inputData= [
                    'username'    =>isset($_POST['login'])?addslashes(trim($_POST['login'])):'',
                    'email'     =>isset($_POST['mail'])?addslashes(trim($_POST['mail'])):'',
                    'gender'   =>isset($_POST['gender'])?$_POST['gender']:'',

                ];

                $errors=$this->validationEditUserData($inputData);

                if(empty($errors)){
                    $user->init($inputData);
                    $userCollection->save($user);
                    $_SESSION['flashMessage']='променен потрбител';

                    header("Location:index.php?c=user&m=index");
                    exit;

                }


            }
        }

        $this->loadView('user/update',$data);
    }
    public function delete()
    {
        if(isset($_GET['id'])&&$_GET['id']>0){
            $id=(int)$_GET['id'];
            $userCollection = new UserCollection();
            $userCollection->delete($id);

            $_SESSION['flashMessage']='изтрит потрбител';
        }
        header('Location:index.php?c=user&m=index');
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
    private function validationEditUserData($inputData)
    {
        $errors=array();
        if (!isset($inputData['username'])||strlen($inputData['username'])<3||strlen($inputData['username'])>50) {
            $errors['username'] = 'Incorect username';
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