<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DoctorResource;
use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    use ApiResponseTrait;
    public function index()
    {
        $doctorPosts = DoctorResource::collection(Doctor::get());
        return $this->ApiResponse($doctorPosts, null, 200);
    }
    public function show($id)
    {
        $doctorPosts = Doctor::find($id);
        if ($doctorPosts) {
            return $this->ApiResponse(new DoctorResource($doctorPosts), "ok", 200);
        }
        return $this->ApiResponse(null, "not ff", 401);
    }
}
