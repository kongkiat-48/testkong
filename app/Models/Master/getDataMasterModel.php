<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class getDataMasterModel extends Model
{
    use HasFactory;

    private $getDatabase;

    public function __construct()
    {
        $this->getDatabase = DB::connection('mysql');
    }

    public function getDataFlagType()
    {
        $getFlagType = $this->getDatabase->table('flag_type')
            ->select('flag_name', 'type_work', 'ID')
            ->where('deleted', 0)
            ->get();
        return $getFlagType;
    }

    public function getDataCompany()
    {
        $getCompany = $this->getDatabase->table('tbm_company')
            ->select(
                'ID',
                'company_name_th',
                'company_name_en'
            )
            ->where('status',1)
            ->where('deleted', 0)
            ->get();

        return $getCompany;
    }

    public function getDataDepartment()
    {
        $getDepartment = $this->getDatabase->table('tbm_department AS depart')
            ->leftJoin('tbm_company AS company', 'depart.company_id', '=', 'company.ID')
            ->select(
                'depart.ID',
                'depart.department_name AS departmentName',
                'company.company_name_th AS companyName'
            )
            ->where('depart.deleted', 0)
            ->where('company.status',1)
            ->where('company.deleted', 0)
            ->get();

        return $getDepartment;
    }

    public function getDataCompanyForID($id)
    {
        // dd($id);
        $returnCompany = $this->getDatabase->table('tbm_department AS depart')
            ->leftJoin('tbm_company AS company', 'depart.company_id', '=', 'company.ID')
            ->select(
                'company.ID',
                'depart.department_name AS departmentName',
                'company.company_name_th AS company_name_th'
            )
            ->where('depart.ID', $id)
            ->where('depart.deleted', 0)
            ->where('company.deleted', 0)
            ->get();

        // dd($returnCompany);

        return $returnCompany;
    }

    public function getDataDepartmentForID($id)
    {
        $returnDepartment = $this->getDatabase->table('tbm_department AS depart')
            ->leftJoin('tbm_company AS company', 'depart.company_id', '=', 'company.ID')
            ->select(
                'company.ID',
                'depart.department_name AS departmentName',
                'company.company_name_th AS company_name_th'
            )
            ->where('company.ID', $id)
            ->where('depart.status',1)
            ->where('depart.deleted', 0)
            ->where('company.deleted', 0)
            ->get();

        // dd($returnDepartment);

        return $returnDepartment;
    }
}
