<?php

namespace App\Http\Controllers\Dashboard_doctor;

use App\Http\Controllers\Controller;
use App\Interfaces\doctor_dashboard\RaysRepositoryInterface;
use Illuminate\Http\Request;

class RayController extends Controller
{
    private $rays;
    public function __construct(RaysRepositoryInterface $rays)
    {
        $this->rays = $rays;
    }
   
   

    public function store(Request $request)
    {
        return $this->rays->store($request);
    }


    public function update(Request $request, $id)
    {
        return $this->rays->update($request,$id);
    }

    
    public function destroy($id)
    {
        return $this->rays->destroy($id);

    }
}
