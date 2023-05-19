<?php
namespace App\Controllers;

use App\Core\MyController;
use App\Models\Sitefunction;

class Student extends MyController
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
        
       echo view('user/index',  $this->dataModule); 
    }

    public function add(){
        $session=\Config\Service::session();
        helper('form')

        $data=[]
        
        if ($this->required->getMethod()=='post'){
            $input=$this->validate([
            'name=>required|min_length[5]',
            'mobile=>required',
            'email=>required',
            ]);
            if ($input==true)
            {
                $model=new StudentModel();
                $model->save([
                    'name'=$this->request->getPost('name'),
                    'mobile'=$this->request->getPost('mobile'),
                    'email'=$this->request->getPost('email'),
                    'address'=$this->request->getPost('address'),



                ]);
                session->setFlashdata("data added succesfully..");
                return redirect()->to('index');
            }
            else{
                $data['validation']=$this->validator;
            }
        }
        
        return view('user/add',  $this->$data); 
     }
}
?>