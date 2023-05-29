<?php

namespace App\Http\Controllers;

use App\Exports\EmployeeExport;
use Illuminate\Http\Request;
use App\Models\Employee;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\UsersExport;
use App\Imports\EmployeeImport;
use Maatwebsite\Excel\Facades\Excel;

class EmployeeController extends Controller
{
    public function index(Request $request){

        if($request->has( 'search' )){
            $data = Employee::where('nama','LIKE','%' .$request->search.'%')->paginate(5);
        }

        else{
        // $data = Employee::all();
        $data = Employee::paginate(5);
        }
        return view('datapegawai', compact('data'));
        //return view('datapegawai');
    }

    public function insertdata(Request $request){
        $data = Employee::create($request->all());
        if($request->hasFile('foto')){
            $request->file('foto')->move('fotopegawai/', $request->file('foto')->getClientOriginalName());
            $data->foto = $request->file('foto')->getClientOriginalName();
            $data->save();
        }
        return redirect()-> route('pegawai')->with('success','Data Berhasil Ditambahkan');
    }

    public function ubahdata($id){
        $data = Employee::find($id);
        // dd($data);
        return view('ubahdata', compact('data'));
    }

    public function updatedata(Request $request, $id){
        $data = Employee::find($id);
        $data->update($request->all());

        return redirect()-> route('pegawai')->with('success','Data Berhasil Diupdate');
    }

    public function hapusdata($id){
        $data = Employee::find($id);
        $data->delete();

        return redirect()-> route('pegawai')->with('success','Data Berhasil Dihapus');
    }

    public function exportpdf(){
        $data = Employee::all();
        view()->share('data', $data);
        $pdf = Pdf::loadview('datapegawai-pdf');
        return $pdf->download('datapegawai.pdf');
    }

    public function exportexcel(){
        // $data = Employee::all();
        return Excel::download(new EmployeeExport, 'daftarpegawai.xlsx');
    }

    public function importexcel(Request $request){
        $data = $request->file('file');

        $namafile = $data->getClientOriginalName();
        $data->move('EmployeeData', $namafile);

        Excel::import(new EmployeeImport, \public_path('/EmployeeData/'.$namafile));
        return \redirect()->back();
        
    }

}
