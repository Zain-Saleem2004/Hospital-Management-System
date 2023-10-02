<?php

namespace App\Interfaces\Services;


interface SingleServiceRepositoryInterface
{
    //get singleservice
    public function index();

    //store singleservice
    public function store($request);

    //update singleservice
    public function update($request);

    //destroy singleservice
    public function destory($request);
}