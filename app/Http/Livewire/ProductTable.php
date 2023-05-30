<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class ProductTable extends Component
{

    protected $listeners = ['refreshComponent'=> '$refresh'];


    public function render()
    {   


        return view('livewire.product-table',[
            'products'=> Product::paginate(2),
        ]);  
    }
}
