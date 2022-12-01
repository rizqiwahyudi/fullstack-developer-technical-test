<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Position;
use Illuminate\Http\Request;
use DataTables;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $employees = Employee::all();
            
            return DataTables::of($employees)
                    ->addColumn('name', function($row){
                        return $row->name;
                    })
                    ->addColumn('jabatan', function($row){
                        return $row->position->name;
                    })
                    ->addColumn('departemen', function($row){
                        return $row->departemen;
                    })
                    ->addColumn('phone', function($row){
                        return $row->phone;
                    })
                    ->addColumn('status', function($row){
                        return $row->status;
                    })
                    ->addColumn('action', function($row){
                        $button = '';
                        $button .= '&nbsp;&nbsp;';
                        $button .= '<a href="'.route('employee.edit',$row->id).'" class="btn btn-circle btn-secondary btn-sm"><i class="fa fa-edit"></i></a>';
                        $button .= '&nbsp;&nbsp;';
                        $button .= '<a href="'.route('employee.show',$row->id).'" class="btn btn-circle btn-primary btn-sm"><i class="fa fa-eye"></i></a>';
                        $button .= '&nbsp;&nbsp;';
                        $button .= '<a href="javascrip:void(0)" onclick="deleteItem(this)" data-name="'.$row->name.'" data-id="'.$row->id.'" class="btn btn-circle btn-danger btn-sm"><i class="fa fa-trash"></i></a>';

                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->addIndexColumn()
                    ->make(true);
        }

        return view('employee');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $positions = Position::all();
        return view('create-employee', compact('positions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'string|required',
            'nip'           => 'string|required|unique:employees,nip',
            'tanggal_lahir' => 'required',
            'tahun_lahir'   => 'required',
            'departemen'    => 'required|string',
            'position'      => 'required',
            'phone'         => 'required',
            'agama'         => 'required',
            'alamat'        => 'required',
            'ktp'           => 'required|image|mimes:jpg,png',
        ]);

        $data = $request->all();
        $data['tanggal_lahir'] = date($data['tahun_lahir'].'-'.$data['tanggal_lahir']);
        $data['phone']  = str_replace(" ", "", $data['phone']);
        
        if ($request->has('status')) {
            $data['status'] = 'active';
        }else{
            $data['status'] = 'inactive';
        }

        if ($request->file('ktp')) {
            $image_file     = $data['ktp'];
            $image_name     = str_replace([" ", ":"], ["-", "-"], Carbon::now()).'_'.$image_file->hashName();
            $data['ktp']  = $image_name;
        }

        $employee = Employee::create([
            'position_id'   => $data['position'],
            'name'          => $data['name'],
            'nip'           => $data['nip'],
            'departemen'    => $data['departemen'],
            'tanggal_lahir' => $data['tanggal_lahir'],
            'alamat'        => $data['alamat'],
            'phone'         => $data['phone'],
            'agama'         => $data['agama'],
            'status'        => $data['status'],
            'ktp'           => $data['ktp']
        ]);

        if ($employee) {
            $image_file->storeAs('ktp', $image_name);

            return response()->json([
                'success'   => true,
                'message'   => 'Employee Berhasil Dibuat.'
            ]);
        }else{
            return response()->json([
                'success'   => false,
                'message'   => 'Employee Gagal Dibuat.'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        return view('show-employee', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        $positions = Position::all();
        return view('edit-employee', compact('employee', 'positions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'name'          => 'string|required',
            'nip'           => 'string|required|unique:employees,nip,'.$employee->id,
            'tanggal_lahir' => 'required',
            'tahun_lahir'   => 'required',
            'departemen'    => 'required|string',
            'position'      => 'required',
            'phone'         => 'required',
            'agama'         => 'required',
            'alamat'        => 'required',
            'ktp'           => 'nullable|image|mimes:jpg,png',
        ]);

        $data = $request->all();
        $data['tanggal_lahir'] = date($data['tahun_lahir'].'-'.$data['tanggal_lahir']);
        $data['phone']  = str_replace(" ", "", $data['phone']);

        if ($request->has('status')) {
            $data['status'] = 'active';
        }else{
            $data['status'] = 'inactive';
        }

        if ($request->file('ktp')) {
            $image_file     = $data['ktp'];
            $image_name     = str_replace([" ", ":"], ["-", "-"], Carbon::now()).'_'.$image_file->hashName();
            $data['ktp']  = $image_name;
        }

        $upEmployee = $employee->update([
            'position_id'   => $data['position'],
            'name'          => $data['name'],
            'nip'           => $data['nip'],
            'departemen'    => $data['departemen'],
            'tanggal_lahir' => $data['tanggal_lahir'],
            'alamat'        => $data['alamat'],
            'phone'         => $data['phone'],
            'agama'         => $data['agama'],
            'status'        => $data['status'],
            'ktp'           => $request->file('ktp') ? $data['ktp'] : $employee->ktp,
        ]);

        if ($employee) {
            if ($request->file('ktp')) {
                $image_file->storeAs('ktp', $image_name);
            }

            return response()->json([
                'success'   => true,
                'message'   => 'Employee Berhasil Diupdate.'
            ]);
        }else{
            return response()->json([
                'success'   => false,
                'message'   => 'Employee Gagal Diupdate.'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        $temp_ktp = $employee->ktp;
        $del_emp  = $employee->delete();

        if ($del_emp) {
            Storage::delete('ktp/'.$temp_ktp);

            return response()->json([
                'success'   => true,
                'message'   => 'Employee Berhasil Dihapus.'
            ]);
        }else{
            return response()->json([
                'success'   => false,
                'message'   => 'Employee Gagal Dihapus.'
            ]);
        }
    }
}
