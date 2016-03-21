<?php

class BlogController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        $data=array();
        $teamId=isset($_GET['id'])?$_GET['id']:0;
        $where=$teamId>0?array('team_id'=>$teamId):array();
        $messagesCollection=new MessagesCollection();
        $messages=$messagesCollection->getAll($where);
        $data['messages']=$messages;
        $errors=array();
        $userid=$_SESSION['user']->getId();
        $userTeamsCollection= new UserTeamsCollection();
        $userteams= $userTeamsCollection->getAll(array('user_id'=>$userid));
        $messageInfo=array(
            'user_id'       =>$_SESSION['user']->getId(),
            'message'       =>'',
            'title'         =>'',
            'team_id'       =>$teamId,
            'reg_time'      =>'',
        );




        if(isset($_POST['post'])) {
            $messageInfo['title'] = isset($_POST['title']) ? addslashes(trim($_POST['title'])) : $messageInfo['title'];
            $messageInfo['message'] = isset($_POST['message']) ? addslashes(trim($_POST['message'])) : $messageInfo['message'];
            $messageInfo['reg_time']=time();

            $errors = $this->validationMessageInfo($messageInfo);


            if (empty($errors)) {
                $messageEntity=new MessagesEntity();
                $messageEntity->init($messageInfo);

                $messagesCollection->save($messageEntity);

                header("Location:index.php?c=blog&id={$teamId}");
                exit;
            }

        }
        $data['userteams']=$userteams;
        $data['teamId']=$teamId;
        $data['errors']=$errors;
        $this->loadFrontView('blog/listing',$data);
    }
    public function update()
    {
        $data=array();
        $teamId=isset($_GET['id'])?$_GET['id']:0;
        $messageId=isset($_GET['m_id'])?$_GET['m_id']:0;
        if($messageId==0){
            header('Location:index.php?c=user');
            exit;
        }

        $messagesCollection=new MessagesCollection();
        $message=$messagesCollection->getOne($messageId);

        $errors=array();
        $userid=$_SESSION['user']->getId();
        $userTeamsCollection= new UserTeamsCollection();
        $userteams= $userTeamsCollection->getAll(array('user_id'=>$userid));
        $messageInfo=array(
            'id'            =>$messageId,
            'user_id'       =>$_SESSION['user']->getId(),
            'message'       =>$message->getMessage(),
            'title'         =>$message->getTitle(),
            'team_id'       =>$teamId,
            'reg_time'      =>'',
        );

        $data['messageInfo']=$messageInfo;


        if(isset($_POST['post'])) {
            $messageInfo['title'] = isset($_POST['title']) ? addslashes(trim($_POST['title'])) : $messageInfo['title'];
            $messageInfo['message'] = isset($_POST['message']) ? addslashes(trim($_POST['message'])) : $messageInfo['message'];
            $messageInfo['reg_time']=time();

            $errors = $this->validationMessageInfo($messageInfo);


            if (empty($errors)) {

                $message->init($messageInfo);

                $messagesCollection->save($message);

                header("Location:index.php?c=blog&id={$teamId}");
                exit;
            }

        }
        $data['userteams']=$userteams;
        $data['teamId']=$teamId;
        $data['errors']=$errors;
        $this->loadFrontView('blog/update',$data);
    }
     public function delete()
     {
         $teamId=isset($_GET['id'])?$_GET['id']:0;
         $messageId=isset($_GET['m_id'])?$_GET['m_id']:0;
         if($messageId==0){
             header('Location:index.php?c=user');
             exit;
         }
         $messagesCollection=new MessagesCollection();
         $messagesCollection->delete($messageId);
         header("Location:index.php?c=blog&id={$teamId}");
         exit;

     }
    function validationMessageInfo($inputData){
        $errors=array();
        if (!isset($inputData['title'])||strlen($inputData['title'])<2||strlen($inputData['title'])>100) {
            $errors['title'] = 'Incorect title';
        }
        if (!isset($inputData['message'])||strlen($inputData['message'])<2||strlen($inputData['message'])>5000) {
            $errors['message'] = 'Incorect message';
        }
        return $errors;
    }

}