<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\Master\getDataMasterModel;
use App\Models\Settings\AboutCompanyModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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

        // dd($getCompany);
        // $getFlagType = $this->getMaster->getDataFlagType();
        // dd($url);
        return view('app.settings.about-company.setCompany', [
            'url'               => $url,
            'urlName'           => $urlName,
            'urlSubLink'        => $urlSubLink,
        ]);
    }

    public function showCompanyModal()
    {
        if (request()->ajax()) {
            return view('app.settings.about-company.dialog.save.addCompany');
        }
        return abort(404);
    }

    public function showDepartmentModal()
    {
        if (request()->ajax()) {
            $getCompany     = $this->getMaster->getDataCompany();

            return view('app.settings.about-company.dialog.save.addDepartment', [
                'getCompany'        => $getCompany,
            ]);
        }
        return abort(404);
    }

    public function showGroupModal()
    {
        if (request()->ajax()) {
            $getCompany     = $this->getMaster->getDataCompany();
            $getDepartment  = $this->getMaster->getDataDepartment();
            return view('app.settings.about-company.dialog.save.addGroup', [
                'getCompany'        => $getCompany,
                'getDepartment'     => $getDepartment
            ]);
        }
        return abort(404);
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
        $this->validate($request, [
            'companyNameTH', 'companyNameEN'    => 'required|string|regex:/^[a-zA-Z0-9ก-๏\s]+$/u',
            'statusOfCompany'                            => 'required|integer',
        ]);
        $saveData = $this->aboutCompany->saveDataCompany($request->input());
        return response()->json(['status' => $saveData['status'], 'message' => $saveData['message']]);
    }

    public function saveDataDepartment(Request $request)
    {
        // dd($request->input());
        $this->validate($request, [
            'departmentName'    => 'required|string|regex:/^[a-zA-Z0-9ก-๏\s]+$/u',
            'statusForDep', 'company'  => 'required|integer',
        ]);
        $saveData = $this->aboutCompany->saveDataDepartment($request->input());
        return response()->json(['status' => $saveData['status'], 'message' => $saveData['message']]);
    }

    public function saveDataGroup(Request $request)
    {
        // dd($request->input());
        $this->validate($request, [
            'groupName'                                         => 'required|string|regex:/^[a-zA-Z0-9ก-๏\s]+$/u',
            'companyForGroup', 'department', 'statusForGroup'     => 'required|integer',
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

    public function showEditCompany($companyID)
    {
        // $getCompany = $this->aboutCompany->showEditCompany($companyID);
        // // dd($getCompany);
        // return response()->json($getCompany);
        if (request()->ajax()) {
            $returnData     =  $this->aboutCompany->showEditCompany($companyID);
            return view('app.settings.about-company.dialog.edit.editCompany', [
                'dataCompany'        => $returnData,
            ]);
        }
        return abort(404);
    }

    public function editCompany(Request $request, $companyID)
    {
        // dd($request->input(),$companyID);
        $this->validate($request, [
            'edit_companyNameTH', 'edit_companyNameEN'  => 'required|string|regex:/^[a-zA-Z0-9ก-๏\s]+$/u',
            'edit_status'                               => 'required|integer',
        ]);
        $saveData = $this->aboutCompany->saveEditDataCompany($request->input(), $companyID);

        return response()->json(['status' => $saveData['status'], 'message' => $saveData['message']]);
    }

    public function deleteCompany($companyID)
    {
        $deletedData = $this->aboutCompany->deleteCompany($companyID);
        return response()->json(['status' => $deletedData['status'], 'message' => $deletedData['message']]);
    }

    public function showEditDepartment($departmentID)
    {
        if (request()->ajax()) {
            $getCompany     = $this->getMaster->getDataCompany();
            $returnData     = $this->aboutCompany->showEditDepartment($departmentID);
            return view('app.settings.about-company.dialog.edit.editDepartment', [
                'getCompany'            => $getCompany,
                'dataDepartment'        => $returnData
            ]);
        }
        return abort(404);
    }

    public function editDepartment(Request $request, $departmentID)
    {
        // dd($request->input(),$departmentID);
        $this->validate($request, [
            'edit_departmentName' => 'required|string|regex:/^[a-zA-Z0-9ก-๏\s]+$/u',
            'edit_statusForDep', 'edit_company' => 'required|integer',
        ]);
        $saveData = $this->aboutCompany->saveEditDataDepartment($request->input(), $departmentID);
        return response()->json(['status' => $saveData['status'], 'message' => $saveData['message']]);
    }

    public function deleteDepartment($departmentID)
    {
        $deletedData = $this->aboutCompany->deleteDepartment($departmentID);
        return response()->json(['status' => $deletedData['status'], 'message' => $deletedData['message']]);
    }

    public function showEditGroup($groupID)
    {
        if (request()->ajax()) {
            $getCompany     = $this->getMaster->getDataCompany();
            $getDepartment  = $this->getMaster->getDataDepartment();
            $returnData     = $this->aboutCompany->showEditGroup($groupID);
            return view('app.settings.about-company.dialog.edit.editGroup', [
                'getCompany'            => $getCompany,
                'getDepartment'         => $getDepartment,
                'dataGroup'             => $returnData
            ]);
        }
        return abort(404);
    }

    public function editGroup(Request $request, $groupID)
    {
        // dd($request->input(),$groupID);
        $this->validate($request, [
            'edit_groupName' => 'required|string|regex:/^[a-zA-Z0-9ก-๏\s]+$/u',
            'edit_statusForGroup', 'edit_companyForGroup', 'edit_department' => 'required|integer',
        ]);
        $saveData = $this->aboutCompany->saveEditDataGroup($request->input(), $groupID);
        return response()->json(['status' => $saveData['status'], 'message' => $saveData['message']]);
    }

    public function deleteGroup($groupID)
    {
        $deletedData = $this->aboutCompany->deleteGroup($groupID);
        return response()->json(['status' => $deletedData['status'], 'message' => $deletedData['message']]);
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
