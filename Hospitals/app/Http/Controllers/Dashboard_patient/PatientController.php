<?php

namespace App\Http\Controllers\Dashboard_patient;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Laboratorie;
use App\Models\Ray;
use App\Models\ReceiptAccount;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function invoices(){
        $invoices = Invoice::where('patient_id',auth()->user()->id)->get();
        return view('Dashboard.dashboard_patient.invoices',compact('invoices'));
    }

    public function laboratories(){
        $laboratories = Laboratorie::where('patient_id',auth()->user()->id)->get();
        return view('Dashboard.dashboard_patient.laboratories',compact('laboratories'));
    }

    public function viewLaboratories($id){
        $laboratories = Laboratorie::findOrFail($id);
        if($laboratories->patient_id != auth()->user()->id){
            return 1;
        }
        return view('Dashboard.dashboard_LaboratorieEmployee.invoices.patient_details',compact('laboratories'));
    }

    public function rays(){
        $rays = Ray::where('patient_id',auth()->user()->id)->get();
        return view('Dashboard.dashboard_patient.rays',compact('rays'));
    }

    public function viewRays($id){
        $rays = Ray::findOrFail($id);
        if($rays->patient_id != auth()->user()->id){
            return 1;
        }
        return view('Dashboard.dashboard_RayEmployee.invoices.patient_details',compact('rays'));
    }

    public function payments(){
        $payments = ReceiptAccount::where('patient_id',auth()->user()->id)->get();
        return view('Dashboard.dashboard_patient.payments',compact('payments'));
    }

}
