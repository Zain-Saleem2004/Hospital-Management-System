<?php

namespace App\Interfaces\Doctors;
use App\Models\SectionTranslation;

interface DoctorRepositoryInterface
{
    // get all doctor
    public function index();

    public function create();

    // store new doctor
    public function store($request);

    // update doctor
    public function update($request);

    // destroy doctor
    public function destroy($request);
    
    // edit doctor
    public function edit($id);

    public function update_password($request);

    public function update_status($request);
}
