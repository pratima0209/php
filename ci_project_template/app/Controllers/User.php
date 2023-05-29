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
        $this->dataModule = array();
        $this->dataModule['controller'] = $this;
    }

    public function index()
    {

        $results = array();
        $data = new Sitefunction();
        $databaseValues = $data->get_all_rows('student', '*', array());

        $results['secondResult'] = $databaseValues;

        // single table join
        $data = new Sitefunction();
        $join = array(
            TBL_CLG . ' as a' => 'a.student_id = s.id',
        );
        $databaseValues123 = $data->get_all_rows(TBL_STUDENT . ' as s', 's.*,a.clg_name', array('s.id' => 74), $join, array());
        $results['secondResult'] = $databaseValues123;

        //  return print json_encode($databaseValues123);

        //multiple table join
        $data = new Sitefunction();
        $join1 = array(
            TBL_CLG . ' as d' => 'd.id = c.clg_id',
            TBL_STUDENT . ' as s' => 's.id = c.student_id',
            TBL_MARKS . ' as m' =>  'm.student_id =s.id',
            TBL_SUBJECT . ' as sb' => 'sb.id = m.sub_id'
        );
        $ggg = $data->get_all_rows(TBL_DEPARTMENT . ' as c', 'c.department_name,d.clg_name,s.*,m.marks,sb.sname', array(), $join1, array(), '', '', array(), 's.id');
        $results['rrr'] = $ggg;
        //return print json_encode($results['rrr']);


        //   $data=new Sitefunction();
        //   $join2=array(
        //         TBL_STUDENT. ' as s ' =>'s.id=c.student_id',
        //        // TBL_DEPARTMENT. ' as d ' => 'd.id'
        //     );
        //     $databasevalue=$data->get_all_rows(TBL_CLG. ' as c','c.*,s.*',array('c.student_id'=>75),$join2);
        //     // return print json_encode($databasevalue);
        //     $results['secondResult'] = $databasevalue;


        echo view('user/index',  $results);
    }

    public function bdisplay()
    {

        $results = array();
        $data = new Sitefunction();
        $databaseValues = $data->get_all_rows('product1', '*', array());
        //return print json_encode($databaseValues);
        $results['second'] = $databaseValues;
        echo view('user/bdisplay',  $results);
    }
    public function add()
    {

        echo view('user/add',  $this->dataModule);
    }



    public function update($id)
    {

        $model = new Sitefunction();
        $records = $model->get_all_rows('student', '*', array('id' => $id));
        $results['results'] = $records[0];

        echo view('user/update',  $results);
    }

    public function delete($id)
    {

        $model = new Sitefunction();
        $deletedata = $model->delete_data('student', array('id' => $id));

        $results = array();
        $data = new Sitefunction();
        $databaseValues = $data->get_all_rows('student', '*', array('name' => 'Pratima'));
        // return json_encode($databaseValues);
        $data = new Sitefunction();
        $databaseValues123 = $data->get_all_rows('student', '*');
        $results['firstResult'] = $databaseValues;
        $results['secondResult'] = $databaseValues123;
        echo view('user/index',  $results);
    }



    public function submitFormdata()
    {
        $formData = $_POST;

        $dataToinsert = new Sitefunction();
        $checkIfemailExists = $dataToinsert->get_all_rows('student', '*', array('email' => $formData['email']));

        if (empty($checkIfemailExists)) {
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
        } else {
            return "Records already exist";
        }
        // return json_encode($checkIfemailExists);

    }

    //ajax call

    public function submitAjaxdata()
    {
        $ajaxData = $this->request->getPost();
        $dataToinsert = new Sitefunction();
        $checkIfemailExists = $dataToinsert->get_all_rows('student', '*', array('email' => $ajaxData['email']));

        if (empty($checkIfemailExists)) {
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
        } else {
            return "0";
        }
    }


    public function updateAjaxdata()
    {

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
        $dataToupdate->update_data('student', $data, array('id' => $ajaxData['id']));
        return "1";
        // }else{
        //     return "0";
        // }


    }


    public function deleteData()
    {

        $ajaxData = $this->request->getPost();

        $dataTodelete = new Sitefunction();

        $dataTodelete->protect(false);

        $dataTodelete->delete_data('student', array('id' => $ajaxData['id']));
        return "1";
    }


    public function login()
    {




        $results = array();
        $data = new Sitefunction();
        $databaseValues = $data->get_all_rows('login', '*');

        $results["product"] = $databaseValues;
        echo view('user/login', $results);
    }


    public function productajaxdata()
        {
            $ajaxData = $this->request->getJson();
        // return json_encode(($ajaxData));
            $dataToinsert = new Sitefunction();
        
            for ($i = 0; $i < sizeof($ajaxData); $i++) {
                $quantity = $ajaxData[$i]->quantity;
                $subtotal = $ajaxData[$i]->sub_total;
                $gtotal = $ajaxData[$i]->grand_total;
                $pro_id = $ajaxData[$i]->pro_id;
        
                $data = array(
                    'quantity' => $quantity,
                    'sub_total' => $subtotal,
                    'grand_total' => $gtotal,
                    'pro_id' => $pro_id,
                );
                $dataToinsert = new Sitefunction();
                $dataToinsert->protect(false);
                $dataToinsert->insert_data('total', $data);
            }
        
            return "1";
        }


        // return json_encode($data_arr);
        
        // }
        // else{
        //     return "0";
        // }



    

    public function product()
    {
        echo view('user/calculate', $this->dataModule);
    }

    public function loginAjaxdata()
    {

        $ajaxData = $this->request->getJSON();
      $username=$ajaxData->uname;
      $password=$ajaxData->password;
      $dataToupdate = new Sitefunction();
      $dataToupdate->protect(false);
      $data = array(
          'uname' => $username,
          'password' => $this->encrypt_password($password),
        );
        $dataToupdate = new Sitefunction();
        $result=$dataToupdate->get_single_row('login','*',array('uname'=>strtolower($username)));
        // return json_encode($result);
    if(!empty($result))
    {
        $storepass=$result['password'];
        if($this->verify_password($password,$storepass))
        {
            $this->session->set('id',strval($result['id']));
            $this->session->set('username',($result['username']));
            $dataArray=array(
                'id'=>$result["id"],
                'username'=>$username,

            );
            // return json_encode($dataArray);
            $key = $this->getKey();
            $iat = time(); // current timestamp value
            $nbf = $iat;
            $exp = $iat + (30 * 86400);
            $alg = 'HS256';
            $payload = array(
                "iss" => "The_admin",
                "aud" => "The_Aud", 
                "iat" => $iat, // issued at
                "nbf" => $nbf, //not before in seconds
                "exp" => $exp, // expire time in seconds
                "data" => $result["id"],
            );
            $token = JWT::encode($payload, $key, $alg);
            $dataArray['token'] = $token;
            return json_encode($token);
        }else{
              return 0;
            }
    }
    else{
            return 0;
        }

        $dataToupdate->insert_data('login', $data);
        return "1";
        
    }


}
