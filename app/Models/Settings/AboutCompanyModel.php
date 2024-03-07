<?php

namespace App\Models\Settings;

use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AboutCompanyModel extends Model
{
    use HasFactory;

    public function __construct()
    {
        $this->getDatabase = DB::connection('mysql');
    }

    public function getDataCompany($request)
    {
        $query = $this->getDatabase->table('tbm_company')->where('deleted', 0);
        // คำสั่งเรียงลำดับ (Sorting)
        $columns = ['ID', 'company_name_th', 'company_name_en', 'status'];
        $orderColumn = $columns[$request->input('order.0.column')];
        $orderDirection = $request->input('order.0.dir');
        $query->orderBy($orderColumn, $orderDirection);

        // คำสั่งค้นหา (Searching)
        $searchValue = $request->input('search.value');
        if (!empty($searchValue)) {
            $query->where(function ($query) use ($columns, $searchValue) {
                foreach ($columns as $column) {
                    $query->orWhere('company_name_th', 'like', '%' . $searchValue . '%');
                    $query->orWhere('company_name_en', 'like', '%' . $searchValue . '%');
                }
            });
        }

        $recordsTotal = $query->count();
        // รับค่าที่ส่งมาจาก DataTables
        $start = $request->input('start');
        $length = $request->input('length');

        $data = $query->offset($start)
            ->limit($length)
            ->orderBy('status', 'DESC')
            ->get();

        $output = [
            'draw' => $request->input('draw'),
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsTotal, // หรือจำนวนรายการที่ผ่านการค้นหา
            'data' => $data,
        ];

        return $output;
    }

    public function getDataDepartment($request)
    {
        $query = $this->getDatabase->table('tbm_department')->where('deleted', 0);
        // คำสั่งเรียงลำดับ (Sorting)
        $columns = ['ID', 'department_name', 'company_name', 'status'];
        $orderColumn = $columns[$request->input('order.0.column')];
        $orderDirection = $request->input('order.0.dir');
        $query->orderBy($orderColumn, $orderDirection);

        // คำสั่งค้นหา (Searching)
        $searchValue = $request->input('search.value');
        if (!empty($searchValue)) {
            $query->where(function ($query) use ($columns, $searchValue) {
                foreach ($columns as $column) {
                    $query->orWhere('department_name', 'like', '%' . $searchValue . '%');
                    $query->orWhere('company_name', 'like', '%' . $searchValue . '%');
                }
            });
        }

        $recordsTotal = $query->count();
        // รับค่าที่ส่งมาจาก DataTables
        $start = $request->input('start');
        $length = $request->input('length');

        $data = $query->offset($start)
            ->limit($length)
            ->orderBy('status', 'DESC')
            ->get();

        $output = [
            'draw' => $request->input('draw'),
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsTotal, // หรือจำนวนรายการที่ผ่านการค้นหา
            'data' => $data,
        ];

        return $output;
    }

    public function getDataGroup($request)
    {
        $query = $this->getDatabase->table('tbm_group')->where('deleted', 0);
        // คำสั่งเรียงลำดับ (Sorting)
        $columns = ['ID', 'group_name', 'department_name', 'company_name', 'status'];
        $orderColumn = $columns[$request->input('order.0.column')];
        $orderDirection = $request->input('order.0.dir');
        $query->orderBy($orderColumn, $orderDirection);

        // คำสั่งค้นหา (Searching)
        $searchValue = $request->input('search.value');
        if (!empty($searchValue)) {
            $query->where(function ($query) use ($columns, $searchValue) {
                foreach ($columns as $column) {
                    $query->orWhere('group_name', 'like', '%' . $searchValue . '%');
                    $query->orWhere('department_name', 'like', '%' . $searchValue . '%');
                    $query->orWhere('company_name', 'like', '%' . $searchValue . '%');
                }
            });
        }

        $recordsTotal = $query->count();
        // รับค่าที่ส่งมาจาก DataTables
        $start = $request->input('start');
        $length = $request->input('length');

        $data = $query->offset($start)
            ->limit($length)
            ->orderBy('status', 'DESC')
            ->get();

        $output = [
            'draw' => $request->input('draw'),
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsTotal, // หรือจำนวนรายการที่ผ่านการค้นหา
            'data' => $data,
        ];

        return $output;
    }

    public function saveDataCompany($getData)
    {
        try {
            // dd(Auth::user()->emp_code);
            $saveToDB = $this->getDatabase->table('tbm_company')->insertGetId([
                'company_name_th'   => $getData['companyNameTH'],
                'company_name_en'   => $getData['companyNameEN'],
                'status'            => $getData['status'],
                'created_user'      => Auth::user()->emp_code,
                'created_at'        => Carbon::now()
            ]);
            // dd($saveToDB);
            $returnStatus = [
                'status'    => 200,
                'message'   => 'Success',
                'ID'        => $saveToDB
            ];
        } catch (Exception $e) {
            $returnStatus = [
                'status'    => $e->getCode(),
                'message'   => $e->getMessage()
            ];
            Log::info($returnStatus);
        } finally {
            return $returnStatus;
        }
    }
}
