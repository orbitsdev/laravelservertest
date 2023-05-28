<?php

namespace App\Http\Livewire\Forms;

use App\Models\File;
use App\Models\Product;
use Livewire\Component;
use WireUi\Traits\Actions;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use App\Http\Controllers\FileController;

class CreateProductForm extends Component

{

  use WithFileUploads;
  use Actions;

    public $showDialog = false;
    public $loading = false;
    public $photo;
    public $product_name; 
    public $product_price = 0;
    public $description;
    public $category="clothing";
    public $tags = [];
    public $discounts;


    public function mount(){
    }
    public function render()
    {
        return view('livewire.forms.create-product-form');
    }

    public function create(){

      $this->loading  = true;
      $validated = $this->validate([
        'product_name' => 'required',
        'product_price' => 'required|numeric',
        'description' => 'required',
        'category' => 'required',
        'tags' => 'required|array|min:1',
        'discounts' => 'required',
        'photo' => 'image|max:10240',
    ]);
    
    
    $photo = $validated['photo']; // Store the photo in a separate variable
    unset($validated['photo']); 
    $validated['tags'] = json_encode($validated['tags']);

    $new_product = Product::create($validated);
    $new_product->generateSlug();
    $new_product->save();

    FileController::uploadFile($this->photo ,$new_product);
    $this->reset();



    $this->dialog()->success(
      $title = 'Product Save',
      $description = 'Your product was successfully saved'
  );
  $this->loading  = false;



    // $this->showDialog = true;
   
    // $this->emit('showSuccess', $new_product->id);
  
  
        
    }

    
}
