<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\Master\getDataMasterModel;
use App\Models\Settings\SetStatusModel;
use Illuminate\Http\Request;

class SetStatusController extends Controller
{
    private $setStatusModel;
    private $getMaster;

    public function __construct()
    {
        $this->setStatusModel   = new SetStatusModel;
        $this->getMaster        = new getDataMasterModel;

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $url        = request()->segments();
        $urlName    = "ตั้งค่าสถานะงาน";
        $urlSubLink = "work-status";
        $getFlagType = $this->getMaster->getDataFlagType();
        // dd($url);
        return view('app.settings.work-status.setStatus', [
            'url'           => $url,
            'urlName'       => $urlName,
            'urlSubLink'    => $urlSubLink,
            'flagType'      => $getFlagType
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

    public function saveDataWorkStatus(Request $request)
    {
        // dd($request->input());
        $this->validate($request, [
            'statusName','statusUse','flagType'         => 'required|string|regex:/^[a-zA-Z0-9ก-๏\s]+$/u',
            'statusWS'                                  => 'required|integer',
        ]);
        $saveData = $this->setStatusModel->saveDataStatus($request->input());
        return response()->json(['status' => $saveData['status'], 'message' => $saveData['message']]);
    }

    public function saveDataFlagType(Request $request) {
        // dd($request->input());
        $this->validate($request, [
            'flagName','typeWork'    => 'required|string|regex:/^[a-zA-Z0-9ก-๏\s]+$/u',
        ]);
        $saveData = $this->setStatusModel->saveDataFlagType($request->input());
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
            return response()->json($getDataStatus);
        } else {
            return response()->json(['error' => 'ไม่พบข้อมูล'], 404);
        }
    }

    public function editStatus(Request $request,$statusID){
        $this->validate($request, [
            'edit_statusName','edit_statusUse','edit_flagType'          => 'required|string|regex:/^[a-zA-Z0-9ก-๏\s]+$/u',
            'edit_statusWS'                                             => 'required|integer',
        ]);
        $editData = $this->setStatusModel->editStatus($request->input(),$statusID);
        return response()->json(['status' => $editData['status'], 'message' => $editData['message']]);
    }

    public function showEditFlagType($flagID){
        // dd($flagID);
        $getDataStatus = $this->setStatusModel->getflagID($flagID);
        if ($getDataStatus) {
            // ถ้าพบข้อมูล
            return response()->json($getDataStatus);
        } else {
            // ถ้าไม่พบข้อมูล
            return response()->json(['error' => 'ไม่พบข้อมูล'], 404);
        }
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
