<?php

/**
 * Created by PhpStorm.
 * User: joro
 * Date: 3/9/16
 * Time: 12:44 AM
 */
class CountryController extends Controller
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
        $errors=array();
        $where=array();
        $countrysCollection= new CountrysCollection();
        $filter=isset($_GET['filter'])&&$_GET['filter']!='0'?$_GET['filter']:'country_name ASC';

        $pattern=(isset($_GET['pattern'])?htmlspecialchars(trim($_GET['pattern'])):null);
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

        $rows=$countrysCollection->getCount($where,-1,0,$filter,$pattern);
        $data['errors']=$errors;
        $data['filter']=$filter;
        $data['pattern']=$pattern;
        $data['perPageSelect']=$perPageSelect;
        $data['$errors']=$errors;


        if(isset($_GET['id'])){
            $country=$countrysCollection->getOne($_GET['id']);
            if($country==null){
                header("Location:index.php?c=country&m=index");
                exit;
            }
            $inputData=array(
                'country_name'=>$country->getCountryName()
            );
            $_SESSION['id']=$_GET['id'];
            $data['inputData']=$inputData;

        }
        if(isset($_POST['change'])){
            $inputData=array(
                'country_name'=>isset($_POST['name'])?htmlspecialchars(trim($_POST['name'])):'',
                'id'=> $_SESSION['id'],
            );
            if(strlen($inputData['country_name'])<3||strlen($inputData['country_name']>255)){

                $errors['name']="грешно име";

            }
            $where['country_name']=$inputData['country_name'];
            $country=$countrysCollection->getAll($where);

            if(count($country)==1){

                $errors['name']="Страната е въведена";
            }
            $data['$errors']=$errors;
            if(empty($errors)){
                $countryEntity=new CountrysEntity();
                $countryEntity->init($inputData);
                $countrysCollection->save($countryEntity);
                $_SESSION['flashMessage']='Успешно промяна';
                header("Location:index.php?c=country&m=index");
                exit;
            }
        }

        if(isset($_POST['addcountry'])){
            $inputData=array(
                'country_name'=>isset($_POST['name'])?htmlspecialchars(trim($_POST['name'])):''
            );
            if(strlen($inputData['country_name'])<3||strlen($inputData['country_name']>255)){

                $errors['name']="грешно име";

            }
            $where['country_name']=$inputData['country_name'];
            $country=$countrysCollection->getAll($where);
            if(count($country)==1){

                $errors['name']="Страната е въведена";
            }
            $data['$errors']=$errors;
            $data['inputData']=$inputData;
            if(empty($errors)){
                $countryEntity=new CountrysEntity();
                $countryEntity->init($inputData);
                $countrysCollection->save($countryEntity);
                $_SESSION['flashMessage']='Успешно промяна';
                header("Location:index.php?c=country&m=index");
                exit;
            }
        }

        $page = isset($_GET['page'])? (int)$_GET['page'] : 1;

        $offset  = ($page) ? ($page-1) * $perPage : 0;
        $pagination = new Pagination();
        $pagination->setPerPage($perPage);
        $pagination->setTotalRows($rows);
        $pagination->setBaseUrl($_SERVER['SCRIPT_NAME']."?c=country&m=index&filter={$filter}&perPage={$perPageSelect}&pattern={$pattern}");
        $countries=$countrysCollection->getAll($where,$offset,$perPage,$filter,$pattern);
        $data['pagination']=$pagination;
        $data['countries']=$countries;
        $data['page']=$page;

        $this->loadView('country/listing',$data);
    }
    public function delete()
    {
        if(isset($_GET['id'])&&$_GET['id']>0){

            $countrysCollection=new CountrysCollection();
            $countrysCollection->delete($_GET['id']);

            $teamsCollection= new TeamsCollection();
            $teamsCollection->updateTeams(array('country_id'=>$_GET['id']),array('country_id'=>null));


        }
        $_SESSION['flashMessage']='Изтрита страна';
        header('Location:index.php?c=country&m=index');
        exit;
    }

}