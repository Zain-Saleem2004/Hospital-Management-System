<?php

namespace App\Interfaces\Sections;
use App\Models\SectionTranslation;

interface SectionRepositoryInterface
{
    // get all sections
    public function index();

    // store new section
    public function store($request);

    // update section
    public function update($request);

    // destroy section
    public function destroy($request);

    // show doctors related for the section
    public function show($id);

}
