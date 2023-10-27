<?php

namespace App\Models\Settings;

use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SetStatusModel extends Model
{
    use HasFactory;

    public function __construct()
    {
        $this->statusWorkDB = DB::connection('mysql');
    }

    public function gatDataStatus($request)
    {
        $query = $this->statusWorkDB->table('status_work')->where('deleted', 0);
        // คำสั่งเรียงลำดับ (Sorting)
        $columns = ['ID', 'status_name', 'status_use', 'status', 'flag_type'];
        $orderColumn = $columns[$request->input('order.0.column')];
        $orderDirection = $request->input('order.0.dir');
        $query->orderBy($orderColumn, $orderDirection);

        // คำสั่งค้นหา (Searching)
        $searchValue = $request->input('search.value');
        if (!empty($searchValue)) {
            $query->where(function ($query) use ($columns, $searchValue) {
                foreach ($columns as $column) {
                    $query->orWhere('status_name', 'like', '%' . $searchValue . '%');
                }
            });
        }

        $recordsTotal = $query->count();
        // รับค่าที่ส่งมาจาก DataTables
        $start = $request->input('start');
        $length = $request->input('length');

        $data = $query->offset($start)
            ->limit($length)
            ->orderBy('status','DESC')
            ->orderBy('flag_type','DESC')
            ->get();

        $output = [
            'draw' => $request->input('draw'),
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsTotal, // หรือจำนวนรายการที่ผ่านการค้นหา
            'data' => $data,
        ];

        return $output;
    }

    public function gatDataFlagType($request)
    {
        $query = $this->statusWorkDB->table('flag_type')->where('deleted', 0);

        // คำสั่งเรียงลำดับ (Sorting)
        $columns = ['ID', 'flag_name_th', 'flag_name_en', 'class'];
        $orderColumn = $columns[$request->input('order.0.column')];
        $orderDirection = $request->input('order.0.dir');
        $query->orderBy($orderColumn, $orderDirection);

        // คำสั่งค้นหา (Searching)
        $searchValue = $request->input('search.value');
        if (!empty($searchValue)) {
            $query->where(function ($query) use ($columns, $searchValue) {
                foreach ($columns as $column) {
                    $query->orWhere('flag_name_th', 'like', '%' . $searchValue . '%');
                }
            });
        }

        $recordsTotal = $query->count();
        // รับค่าที่ส่งมาจาก DataTables
        $start = $request->input('start');
        $length = $request->input('length');

        $data = $query->offset($start)
            ->limit($length)
            ->get();

        $output = [
            'draw' => $request->input('draw'),
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsTotal, // หรือจำนวนรายการที่ผ่านการค้นหา
            'data' => $data,
        ];

        return $output;
    }

    public function saveDataStatus($getData)
    {
        try {
            // dd(Auth::user()->emp_code);
            $saveToDB = $this->statusWorkDB->table('status_work')->insertGetId([
                'status_name'   => $getData['statusName'],
                'status_use'    => $getData['statusUse'],
                'status'        => $getData['status'],
                'flag_type'     => $getData['flagType'],
                'created_user'  => Auth::user()->emp_code,
                'created_at'    => Carbon::now()
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

    public function getStatusID($statusID){
        $getData = $this->statusWorkDB->table('status_work')->where('ID',$statusID)->get();
        // dd($getData);
        return $getData;
    }

    public function editStatus($dataEdit,$statusID){
        try{
            $this->statusWorkDB->table('status_work')->where('ID',$statusID)->update([
                'status_name'   => $dataEdit['edit_statusName'],
                'status_use'    => $dataEdit['edit_statusUse'],
                'status'        => $dataEdit['edit_status'],
                'flag_type'     => $dataEdit['edit_flagType'],
                'update_user'  => Auth::user()->emp_code,
                'update_at'    => Carbon::now()
            ]);

            $returnStatus = [
                'status'    => 200,
                'message'   => 'Edit Success'
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
