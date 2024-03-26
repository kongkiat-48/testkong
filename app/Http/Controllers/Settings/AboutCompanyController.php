<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\Master\getDataMasterModel;
use App\Models\Settings\AboutCompanyModel;
use Illuminate\Http\Request;

class AboutCompanyController extends Controller
{
    private $aboutCompany;
    private $getMaster;

    public function __construct()
    {
        $this->aboutCompany = new AboutCompanyModel;
        $this->getMaster    = new getDataMasterModel;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $url = request()->segments();
        // dd($url);
        $urlName        = "กำหนดค่าภายในองค์กร";
        $urlSubLink     = "about-company";
        $getCompany     = $this->getMaster->getDataCompany();
        $getDepartment  = $this->getMaster->getDataDepartment();
        // dd($getCompany);
        // $getFlagType = $this->getMaster->getDataFlagType();
        // dd($url);
        return view('app.settings.about-company.setCompany', [
            'url'               => $url,
            'urlName'           => $urlName,
            'urlSubLink'        => $urlSubLink,
            'getCompany'        => $getCompany,
            'getDepartment'     => $getDepartment
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

    public function saveDataCompany(Request $request)
    {
        // dd($request->input());
        $this->validate($request, [
            'companyNameTH', 'companyNameEN'    => 'required|string|regex:/^[a-zA-Z0-9ก-๏\s]+$/u',
            'status'                            => 'required|integer',
        ]);
        $saveData = $this->aboutCompany->saveDataCompany($request->input());
        return response()->json(['status' => $saveData['status'], 'message' => $saveData['message']]);
    }

    public function saveDataDepartment(Request $request)
    {
        // dd($request->input());
        $this->validate($request, [
            'departmentName'    => 'required|string|regex:/^[a-zA-Z0-9ก-๏\s]+$/u',
            'statusForDep','company'  => 'required|integer',
        ]);
        $saveData = $this->aboutCompany->saveDataDepartment($request->input());
        return response()->json(['status' => $saveData['status'], 'message' => $saveData['message']]);
    }

    public function saveDataGroup(Request $request)
    {
        // dd($request->input());
        $this->validate($request, [
            'groupName'                                         => 'required|string|regex:/^[a-zA-Z0-9ก-๏\s]+$/u',
            'companyForGroup','department','statusForGroup'     => 'required|integer',
        ]);
        $saveData = $this->aboutCompany->saveDataGroup($request->input());
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

    public function showDataCompany(Request $request)
    {
        $getDataToTable = $this->aboutCompany->getDataCompany($request);
        return response()->json($getDataToTable);
    }

    public function showDataDepartment(Request $request)
    {
        $getDataToTable = $this->aboutCompany->getDataDepartment($request);
        return response()->json($getDataToTable);
    }

    public function showDataGroup(Request $request)
    {
        $getDataToTable = $this->aboutCompany->getDataGroup($request);
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
