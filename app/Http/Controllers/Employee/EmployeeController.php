<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Master\getDataMasterModel;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    private $masterModel;

    public function __construct()
    {
        $this->masterModel = new getDataMasterModel;
    }
    public function getAllEmployee(){
        $url        = request()->segments();
        $urlName    = "ข้อมูลพนักงาน";
        $urlSubLink = "list-all-employee";

        return view('app.employee.getAllEmployee',[
            'url'           => $url,
            'urlName'       => $urlName,
            'urlSubLink'    => $urlSubLink,
        ]);
    }

    public function addEmployee(){
        $url        = request()->segments();
        $urlName    = "เพิ่มข้อมูลพนักงาน";
        $urlSubLink = "add-employee";

        $prefixName     = $this->masterModel->getDataPrefixName();
        $provinceName   = $this->masterModel->getDataProvince();
        $getCompany     = $this->masterModel->getDataCompany();
        $getClassList   = $this->masterModel->getClassList();
        // dd($provinceName);

        return view('app.employee.add-employee.addEmployee',[
            'url'           => $url,
            'urlName'       => $urlName,
            'urlSubLink'    => $urlSubLink,
            'dataPrefixName'    => $prefixName,
            'provinceName'      => $provinceName,
            'dataCompany'       => $getCompany,
            'dataClassList'     => $getClassList
        ]);
    }
}
