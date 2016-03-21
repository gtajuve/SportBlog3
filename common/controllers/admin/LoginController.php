<?php

class LoginController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function login(){
        $data=array();
        $errors=array();
        if($this->isLogAdmin()){
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

                    header('Location:index.php');
                    exit;
                }else{
                    $errors['login']="Incorect data";

                }
            }


        }
        $data['errors']=$errors;
        $this->loadView('login',$data);
    }
    public function logout(){
        unset($_SESSION['user']);
        unset($_SESSION['login']);
        header('Location:index.php?c=login&m=login');
        exit;
    }

}