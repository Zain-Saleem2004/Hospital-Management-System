<?php

namespace App\Repository\Doctors;

use App\Http\Controllers\Api\ApiResponseTrait;
use App\Http\Resources\DoctorResource;
use App\Interfaces\Doctors\DoctorRepositoryInterface;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Image;
use App\Models\Section;
use App\Traits\UploadTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DoctorRepository implements DoctorRepositoryInterface
{
    use UploadTrait,ApiResponseTrait;
   public function index()
   {$sections = Section::all();
    $doctors = Doctor::with('doctorappointments')->get();
    return view('Dashboard.Doctors.index',compact('doctors','sections'));
   }

   public function create()
   {
    $sections = Section::all();
    $appointments = Appointment::all();
    return view('Dashboard.Doctors.add',compact('sections','appointments'));
   }

   public function edit($id)
   {
    $appointments = Appointment::all();
    $sections = Section::all();
    $doctor = Doctor::findOrFail($id);
    return view('Dashboard.Doctors.edit',compact(['appointments','sections','doctor']));
   }

   public function store($request){

    DB::beginTransaction();

    try {

        $doctors = new Doctor();
        $doctors->email = $request->email;
        $doctors->password = Hash::make($request->password);
        $doctors->section_id = $request->section_id;
        $doctors->phone = $request->phone;
        $doctors->Status = 1;
        $doctors->save();

        // store trans
        $doctors->name = $request->name;
        $doctors->save();

        $doctors->doctorappointments()->attach($request->appointments);

        


        //Upload img
        $this->verifyAndStoreImage($request,'photo','doctors','upload-image',$doctors->id,'App\Models\Doctor');

        DB::commit();
        session()->flash('add');
        return redirect()->route('Doctors.create');

    }
    catch (\Exception $e) {
        DB::rollback();
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }


}

   public function update($request)
   {
    DB::beginTransaction();

    try {

        $doctors = Doctor::findOrFail($request->id);
        $doctors->email = $request->email;
        $doctors->password = Hash::make($request->password);
        $doctors->section_id = $request->section_id;
        $doctors->phone = $request->phone;
        $doctors->status = 1;
        $doctors->save();

        // store trans
        $doctors->name = $request->name;
        $doctors->save();

        // update pivot table
        $doctors->doctorappointments()->sync($request->appointments);

        if($request->has('photo')){
          if($doctors->image){
            $old_img = $doctors->image->file_name;
            $this->Delete_Attachment('upload-image','doctors/'.$old_img,$request->id,$old_img);
            
        }
        //Upload img
        $this->verifyAndStoreImage($request,'photo','doctors','upload-image',$request->id,'App\Models\Doctor');

    }

        DB::commit();
        session()->flash('edit');
        return redirect()->back();
      

    }
    catch (\Exception $e) {
        DB::rollback();
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }

   }

   public function destroy($request)
   {
      if($request->page_id==1){
        if($request->file_name){
            $this->Delete_Attachment('upload-image','doctors/'.$request->file_name,$request->id,$request->file_name);
        }
        Doctor::destroy($request->id);
        session()->flash('delete');
        return redirect()->route('Doctors.index');

      }


      else{
        $delete_select_id = explode(',',$request->delete_select_id);
        foreach($delete_select_id as $ids_delete){
            $doctor = Doctor::findOrFail($ids_delete);
            if($doctor->image)
            $this->Delete_Attachment('upload-image','doctors/'.$doctor->image->file_name,$ids_delete,$doctor->image->file_name);


        }
        Doctor::destroy($delete_select_id);
        
       
            
        
        session()->flash('delete');
        return redirect()->route('Doctors.index');

      }
   }

   public function update_password($request){
    try{
        $doctor = Doctor::findOrFail($request->id);
        $doctor->update([
            $doctor->password =Hash::make( $request->password),
        ]);
        session()->flash('edit');
        return redirect()->back();

    }
    catch(\exception $e){
        DB::rollback();
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }

   }

   public function update_status($request){
    try{
        $doctor = Doctor::findOrFail($request->id);
        $doctor->update([
            'Status' => $request->Status,
        ]);
        session()->flash('edit');
        return redirect()->back();
    }
    catch(\exception $e){
        DB::rollback();
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
   }
}
