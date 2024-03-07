<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\Settings\AboutCompanyModel;
use Illuminate\Http\Request;

class AboutCompanyController extends Controller
{
    private $aboutCompany;

    public function __construct()
    {
        $this->aboutCompany = new AboutCompanyModel;
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
        $urlName = "กำหนดค่าภายในองค์กร";
        $urlSubLink = "about-company";
        // $getFlagType = $this->getMaster->getDataFlagType();
        // dd($url);
        return view('app.settings.about-company.setCompany', [
            'url'           => $url,
            'urlName'       => $urlName,
            'urlSubLink'    => $urlSubLink
            // 'flagType'  => $getFlagType
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
            'companyNameTH', 'companyNameEN'    => 'required|string|regex:/^[a-zA-Z0-9ก-๏\s]+$/',
            'status'                            => 'required|integer',
        ]);
        $saveData = $this->aboutCompany->saveDataCompany($request->input());
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
