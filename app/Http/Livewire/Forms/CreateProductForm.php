<?php

namespace App\Http\Livewire\Forms;

use App\Models\File;
use App\Models\Product;
use Livewire\Component;
use WireUi\Traits\Actions;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\FileController;

class CreateProductForm extends Component

{

  use WithFileUploads;
  use Actions;

  public $showDialog = false;
  public $loading = false;
  public $isCreateModalShow = false;
  public $isUpdateMode =false;
  public $photo;
  public $product_name;
  public $product_price = 0;
  public $description;
  public $category = "clothing";
  public $tags = [];
  public $discounts;
  public $selectedData;
  protected $listeners = ['showFormToUpdate','showFormToDelete'];


  public function mount()
  {
  }
  public function render()
  {
    return view('livewire.forms.create-product-form');
  }

  public function showCreateProductForm()
  {
    $this->isCreateModalShow = true;
  }

  public function create()
  {

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

    FileController::uploadFile($this->photo, $new_product);
    $this->reset();



    $this->dialog()->success(
      $title = 'Product Save',
      $description = 'Your product was successfully saved'
    );
    $this->loading  = false;
    $this->isCreateModalShow = false;
    $this->emit('refreshComponent');

    // $this->showDialog = true;

    // $this->emit('showSuccess', $new_product->id);



  }

  // protected function getListeners()
  // {
  //     return ['showFormToUpdate'];
  // }


  public function showFormToUpdate(Product $product){
    
    
    $this->selectedData = $product->id;
   $this->isCreateModalShow = true;
   $this->product_name = $product->product_name ;
   $this->product_price = $product->product_price;
   $this->description =$product->description;
   $this->category = $product->category;
   $this->tags = json_decode($product->tags);
   $this->discounts = $product->discounts;

   

  }

  public function showFormToDelete(Product $product){
    
    
   $this->selectedData = $product->id;
   $this->dialog()->confirm([
    'title'       => 'Are you Do want to delete it',
    'description' => 'Delete product?',
    'acceptLabel' => 'Yes, Delete it',
    'method'      => 'delete',
    'params'      => 'Saved',
]);

   

  }



  public function update(){
    $new_product = Product::find($this->selectedData);

    
    $this->loading  = true;
    $validated = $this->validate([
      'product_name' => 'required',
      'product_price' => 'required|numeric',
      'description' => 'required',
      'category' => 'required',
      'tags' => 'required|array|min:1',
      'discounts' => 'required',
      // 'photo' => 'image|max:10240',
    ]);



    if($this->photo != null ){

        FileController::uploadFile($this->photo, $new_product);
        
      }
    // $validated['tags'] = json_encode($validated['tags']);
    
    $new_product->generateSlug();
    $new_product->product_name = $this->product_name;
    $new_product->product_price = $this->product_price;
    $new_product->description = $this->description;
    $new_product->tags = $this->tags;
    $new_product->discounts = $this->discounts;
    $new_product->save();

    $this->reset();
    
    


    $this->dialog()->success(
      $title = 'Product Updated',
      $description = 'Your product was successfully updated'
    );
    $this->loading  = false;
    $this->isCreateModalShow = false;
    $this->emit('refreshComponent');
    // $this->selectedData = null;
  }


  public function closeForm(){

    $this->isCreateModalShow = false;
    $this->selectedData = null;

  }

  public function delete()
  {
      $product = Product::find($this->selectedData);
  
      if ($product && $product->files()->count() > 0) {
          
          foreach ($product->files as $file){
            FileController::deleteFile($file);
          }
          $product->files()->delete();
      }
  
      if ($product) {
          $product->delete();
      }
  
      $this->selectedData = null;
      $this->emit('refreshComponent');
  }
  


  
}
