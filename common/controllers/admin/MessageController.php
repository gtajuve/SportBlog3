<?php

class MessageController extends Controller
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

        $messagesCollection=new MessagesCollection();

        $usersCollection= new UserCollection();
        $users=$usersCollection->getAll();
        $teamCollection=new TeamsCollection();
        $teams=$teamCollection->getAll(array(),-1,0,"country_id,team_name ASC");

        $where=array();
        $userId=(isset($_GET['user_id'])&&$_GET['user_id']!='0'?$where['user_id']=(int)$_GET['user_id']:'');
        $teamId=(isset($_GET['team_id'])&&$_GET['team_id']!='0'?$where['team_id']=(int)$_GET['team_id']:'');
        $filter=(isset($_GET['filter'])&&$_GET['filter']!='0'?$_GET['filter']:'reg_time ASC');

        $pattern=(isset($_GET['pattern'])?htmlspecialchars(trim($_GET['pattern'])):null);
        $rows=count($messagesCollection->getAll($where,-1,0,$filter,$pattern))==0?1:count($messagesCollection->getAll($where,-1,0,$filter,$pattern));
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
        $pagination->setBaseUrl($_SERVER['SCRIPT_NAME']."?c=message&m=index&team_id={$teamId}&user_id={$userId}&filter={$filter}&pattern={$pattern}&perPage={$perPageSelect}");
        $messages=$messagesCollection->getAll($where,$offset,$perPage,$filter,$pattern);
        $data['messages']=$messages;
        $data['pagination']=$pagination;
        $data['page']=$page;
        $data['perPageSelect']=$perPageSelect;
        $data['pattern']=$pattern;
        $data['filter']=$filter;
        $data['teamId']=$teamId;
        $data['userId']=$userId;
        $data['teams']=$teams;
        $data['users']=$users;

        $this->loadView('message/listing',$data);
    }


}