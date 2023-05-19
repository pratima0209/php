<?php
namespace App\Models;
use CodeIgnitor\Model;

class StudentModel extends Model
{
    protected $table='Student';
    protected $allowedFileds=['name','mobile','email','address'];
} 



?>
