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
    $databaseValues = $data->get_all_rows('student','*',array('name' => 'Pratima'));
    // return json_encode($databaseValues);
    $data = new Sitefunction();
    $databaseValues123 = $data->get_all_rows('student','*');
        $results['firstResult'] = $databaseValues;
        $results['secondResult'] = $databaseValues123;
       echo view('user/index',  $results); 
    }

    public function add(){
        
        echo view('user/add',  $this->dataModule); 
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

 /*       $validmob=$dataToinsert->get_all_rows('student','*', array('mobile' => $ajaxData['mobile']));
        if(empty($validmob))
        {
            $error="please enter mob no";
        }
        elseif(strlen($validmob)<10)
        {
            $error="mob no should be 10 digit";
        }*/

     }

}