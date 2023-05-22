<?php
namespace App\Controllers;

use App\Core\MyController;
use App\Models\Sitefunction;

class User extends MyController
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Kolkata');
		$this->utc_time = date('Y-m-d H:i:s');
		$this->utc_date = date('Y-m-d');
        $this->dataModule=array();
        $this->dataModule['controller'] = $this;
    }

    public function index(){
        
    $results = array();
    $data = new Sitefunction();
    $databaseValues = $data->get_all_rows('student','*',array());
    
    $results['secondResult']=$databaseValues;

    // single table join
    $data = new Sitefunction();
    $join = array(
        TBL_CLG. ' as a' => 'a.student_id = s.id',
      );
        $databaseValues123 = $data->get_all_rows(TBL_STUDENT .' as s' ,'s.*,a.id as clg_id,a.clg_name',array(),$join, array());

       // return print json_encode($databaseValues123);
  
        // multiple table join
        // $data=new Sitefunction();
        // $join1=array(
        //     TBL_CLG .' as d'=>'d.id = c.clg_id',
        //     TBL_STUDENT. ' as s'=> 's.id = c.student_id'
        // );
        // $ggg=$data->get_all_rows(TBL_DEPARTMENT .' as c','c.*,d.*,s.*',array(),$join1,);
        // $results['secondResult'] = $ggg;

        
        
       
       echo view('user/index',  $results); 
    }

    public function add(){
        
        echo view('user/add',  $this->dataModule); 
     }



    public function update($id){
        
        $model = new Sitefunction();
        $records = $model->get_all_rows('student', '*', array('id' => $id));
        $results['results'] = $records[0];
        
        echo view('user/update',  $results); 
     }

    public function delete($id){
        
        $model = new Sitefunction();
        $deletedata=$model->delete_data('student',array('id'=>$id));
       
        $results = array();
        $data = new Sitefunction();
        $databaseValues = $data->get_all_rows('student','*',array('name' => 'Pratima'));
        // return json_encode($databaseValues);
        $data = new Sitefunction();
        $databaseValues123 = $data->get_all_rows('student','*');
            $results['firstResult'] = $databaseValues;
            $results['secondResult'] = $databaseValues123;
           echo view('user/index',  $results); 
       
     }



     public function submitFormdata(){
        $formData = $_POST;

        $dataToinsert = new Sitefunction();
        $checkIfemailExists = $dataToinsert->get_all_rows('student','*', array('email' => $formData['email']));

        if(empty($checkIfemailExists)){
            $dataToinsert = new Sitefunction();
            $dataToinsert->protect(false);
            $data = array(
                'name' => $formData['name'],
                'email' => $formData['email'],
                'mobile' => $formData['mobile'],
                'address' => $formData['address']
            );
            $dataToinsert->insert_data('student', $data);
            echo view('index/index');
        }else{
            return "Records already exist";
        }
        // return json_encode($checkIfemailExists);
        
     }

     //ajax call

     public function submitAjaxdata(){
        $ajaxData = $this->request->getPost();
        $dataToinsert = new Sitefunction();
        $checkIfemailExists = $dataToinsert->get_all_rows('student','*', array('email' => $ajaxData['email']));

        if(empty($checkIfemailExists)){
            $dataToinsert = new Sitefunction();
            $dataToinsert->protect(false);
            $data = array(
                'name' => $ajaxData['name'],
                'email' => $ajaxData['email'],
                'mobile' => $ajaxData['mobile'],
                'address' => $ajaxData['address']
            );
            $dataToinsert->insert_data('student', $data);
            return "1";
        }else{
            return "0";
        }

 
     }


     public function updateAjaxdata(){
        
        $ajaxData = $this->request->getPost();
    //    echo($ajaxData);
        $dataToupdate = new Sitefunction();
        // $checkIfemailExists = $dataToupdate->get_all_rows('student','*', array('email' => $ajaxData['email']));
        // if(empty($checkIfemailExists)){
            $dataToupdate = new Sitefunction();
            $dataToupdate->protect(false);
            $data = array(
                'name' => $ajaxData['name'],
                'email' => $ajaxData['email'],
                'mobile' => $ajaxData['mobile'],
                'address' => $ajaxData['address']
            );
            $dataToupdate->update_data('student', $data,array('id'=>$ajaxData['id']));
            return "1";
        // }else{
        //     return "0";
        // }

 
     }


     public function deleteData(){
        
        $ajaxData = $this->request->getPost();
        
        $dataTodelete = new Sitefunction();
        
            $dataTodelete->protect(false);
           
            $dataTodelete->delete_data('student',array('id'=>$ajaxData['id']));
            return "1";
        

 
     }







}