<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Legal;
use DataTables;
use Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;


class LegalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Legal::query();
        return DataTables::of($projects)
            ->addColumn('action', function ($project) {
                $viewbtn =  '<button ' .
                                ' style="color: #fff; font-weight: 700; display: flex; gap: 3px; align-items: center;" class="btn btn-primary btn-sm" ' .
                                ' onclick="viewCase(' . $project->id . ')"><i style="font-size: 14px" class="bx bx-file"></i>Show' .
                            '</button> ';
                $deleteBtn =  '<button style="color: #fff; font-weight: 700; display: flex; gap: 3px; align-items: center;" ' .
                                ' class="btn btn-danger btn-sm" ' .
                                ' onclick="deleteCase(' . $project->id . ')" ><i style="font-size: 14px" class="bx bx-trash" ></i>Delete' .
                            '</button> ';
                $casefilebtn = '<a href="pdf/' . $project->id . '" style="color: #fff; font-weight: 700; display: flex; gap: 3px; align-items: center;" class="btn btn-warning btn-sm" target="_blank"><i class="bx bx-link"></i></a>';

                return '<div class="d-flex" style="gap: 5px;">' . $casefilebtn . $viewbtn . $deleteBtn . '</div>';
            })
            ->rawColumns(
            [
                'action',
            ])
            ->make(true);
            /*
        $cases = Legal::all();
        return view('home', compact('cases'));
        */
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
    // public function pdf($id){
    //     return $id;
    // }
    /**
     * Store a newly created resource in storage.
     */
    public function store( Request $request ) {
        $validator = Validator::make( $request->all(), [
        'name' => 'required|string',
        'address' => 'required|string',
        'casenumber' => 'required|string',
        'status' => 'required|string',
        'legalcasefile' => 'required|mimes:pdf',
        ],
        [
        'name.required' => 'Please Enter Company name',
        'address.required' => 'Please Enter Company address',
        'casenumber.required' => 'Please Enter Case number',
        'status.required' => 'Please Select Company status',
        'legalcasefile.required' => 'Please Upload Legal Case PDF',
        ] );

        if ( $validator->fails() ) {
        return response()->json( [ 'errors' => $validator->errors() ] );
        }

        $origFilename  = $request->legalcasefile;
        // if (request()->hasFile('legalcasefile')) {
            $file      = $request->file('legalcasefile');
            $extension = $file->extension();
            $filename  = time() . '-' . str_slug($origFilename) . '.' . $extension;
            $path  	   = $file->storeAs('public/cases', $filename);

            Legal::create([
                'company_name' => $request->name,
                'company_address' => $request->address,
                'case_number' => $request->casenumber,
                'status' => $request->status,
                'legalcasefile' => $filename,
            ]);
          return response()->json(['success' => 'Legal Case has been added!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Legal $id)
    {
        // $user = User::find($id);

        // return response()->json($user);

        return response()->json($id);
    }

    public function pdf(Legal $id)
    {
        // $pdf = PDF::loadView('pdf.legalcase', [$id->legalcasefile]);
        // $pdf->setPaper('legal','portrait');
        // return $pdf->stream();
        $file = $id -> legalcasefile;
        $filePath = storage_path('/app/public/cases/' . $file);
        $fileContents = Storage::get($filePath);
        $response = Response::make($fileContents, 200);
        $response->header('Content-Type', 'application/pdf');
        return response()->file($filePath);
    }

    // public function edit(User $user)
    // {
    //     return view('users.edit', compact('user'));
    // }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Legal $company)
    {
        $link = "";
        $legal = Legal::findOrFail($request -> vid);
        // $legal->update([
        //     'company_name' => $request->vname,
        //     'company_address' => $request->vaddress,
        //     'case_number' => $request->vcasenumber,
        //     'status' => $request->vstatus,
        // ]);
        $validator = Validator::make( $request->all(), [
            'vname' => 'required|string',
            'vaddress' => 'required|string',
            'vcasenumber' => 'required|string',
            'vstatus' => 'required|string',
        ],
        [
            'vname.required' => 'Please Enter Company name',
            'vaddress.required' => 'Please Enter Company address',
            'vcasenumber.required' => 'Please Enter Case number',
            'vstatus.required' => 'Please Select Company status',
        ]);
        if ( $validator->fails() ) {
            return response()->json( [ 'errors' => $validator->errors() ] );
        }
        if (request()->hasFile('vlegalcasefile')) {
            $origFilename  = $request->vlegalcasefile;
            $file      = $request->file('vlegalcasefile');
            $extension = $file->extension();
            $filename  = time() . '-' . str_slug($origFilename) . '.' . $extension;
            $path  	   = $file->storeAs('public/cases', $filename);
            $legal->update([
                'company_name' => $request->vname,
                'company_address' => $request->vaddress,
                'case_number' => $request->vcasenumber,
                'status' => $request->vstatus,
                'legalcasefile' => $filename,
            ]);
            $link = $path;

        }else{
            $legal->update([
                'company_name' => $request->vname,
                'company_address' => $request->vaddress,
                'case_number' => $request->vcasenumber,
                'status' => $request->vstatus,
            ]);
        }
        return response()->json($link);
        // return response()->json(['success' => 'Legal Case has been updated!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Legal $id)
    {
        $id->delete();
        return response()->json(['message' => 'Case deleted successfully']);
    }
}
