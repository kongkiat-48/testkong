<?php

namespace App\Models\Employee;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class EmployeeModel extends Model
{
    use HasFactory;

    private $getDatabase;

    public function __construct(){
        $this->getDatabase = DB::connection('mysql');
    }

    public function saveEmployee($saveData){
        dd($saveData);
    }
}
