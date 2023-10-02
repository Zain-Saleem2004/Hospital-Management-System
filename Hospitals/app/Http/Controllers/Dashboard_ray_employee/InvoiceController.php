<?php

namespace App\Http\Controllers\Dashboard_ray_employee;

use App\Http\Controllers\Controller;
use App\Interfaces\Dashboard_Ray_Employee\InvoicesRepositoryInterface;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{

    private $ray_empployee;
    public function __construct(InvoicesRepositoryInterface $ray_empployee)
    {
        $this->ray_empployee = $ray_empployee;
    
        
    }
    
    public function index()
    {
        return $this->ray_empployee->index();
    }

  
   
    public function edit($id)
    {
        return $this->ray_empployee->edit($id);
    }

    
    public function update(Request $request, $id)
    {
        return $this->ray_empployee->update($request,$id);
    }

    public function completed_invoices()
    {
        return $this->ray_empployee->completed_invoices();
    }
   
    public function viewRays($id)
    {
        return $this->ray_empployee->view_rays($id);
    }
}
