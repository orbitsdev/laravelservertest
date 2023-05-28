<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Product;

class FileController extends Controller
{
    public static  function uploadFile($file , $model){ 

   
        $file_folder = 'products/' . Str::uuid()->toString();
        $file_name = $file->getClientOriginalName();
        $mime_type = $file->getClientOriginalExtension();
        $full_path = $file_folder . '/' . $file_name;
        
      $file->storeAs($file_folder, $file_name, 'public');
        
        $file_data = [
           'file_folder'=> $file_folder,
           'file_name'=>$file_name,
           'file_type'=>$mime_type,
           'file_path'=>$full_path,
        ];
  
        $model->files()->create($file_data);
        
  
      }
}
