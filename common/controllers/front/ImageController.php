<?php

/**
 * Created by PhpStorm.
 * User: joro
 * Date: 3/18/16
 * Time: 11:16 PM
 */
class ImageController extends Controller
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
        $teamsImagesCollection= new TeamsImagesCollection();
        $images=$teamsImagesCollection->getAll($where);
        $data['images']=$images;
        $userid=$_SESSION['user']->getId();
        $userTeamsCollection= new UserTeamsCollection();
        $userteams= $userTeamsCollection->getAll(array('user_id'=>$userid));
        $data['userteams']=$userteams;
        $this->loadFrontView('team/gallery',$data);
    }

}