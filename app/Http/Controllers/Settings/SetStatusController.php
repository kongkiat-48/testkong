<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\InsertWorkStatusRequest;
use App\Models\Settings\SetStatusModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SetStatusController extends Controller
{
    private $setStatusModel;

    public function __construct()
    {
        $this->setStatusModel = new SetStatusModel;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $url = request()->segments();
        $urlName = "ตั้งค่าสถานะงาน";
        // dd($url);
        return view('app.settings.work-status.setStatus', [
            'url'       => $url,
            'urlName'   => $urlName
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    public function saveDataWorkStatus(InsertWorkStatusRequest $request)
    {
        // dd($request->input());
        $saveData = $this->setStatusModel->saveDataStatus($request->input());
        return response()->json(['status' => $saveData['status'], 'message' => $saveData['message']]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function showDataStatus(Request $request)
    {
        $getDataToTable = $this->setStatusModel->gatDataStatus($request);
        return response()->json($getDataToTable);
    }

    public function showDataFlagType(Request $request)
    {
        $getDataToTable = $this->setStatusModel->gatDataFlagType($request);
        return response()->json($getDataToTable);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    public function showEditStatus($statusID){
        // dd($statusID);
        $getDataStatus = $this->setStatusModel->getStatusID($statusID);
        if ($getDataStatus) {
            // ถ้าพบข้อมูล
            return response()->json($getDataStatus);
        } else {
            // ถ้าไม่พบข้อมูล
            return response()->json(['error' => 'ไม่พบข้อมูล'], 404);
        }
    }

    public function editStatus(Request $request,$statusID){
        $dataEdit = $request->input();
        $editData = $this->setStatusModel->editStatus($dataEdit,$statusID);
        return response()->json(['status' => $editData['status'], 'message' => $editData['message']]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
