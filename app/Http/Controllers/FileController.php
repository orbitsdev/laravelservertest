<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

      static function deleteFile(File $file) {
          $folder = $file->file_folder;
          if(Storage::disk('public')->exists($folder)){
              Storage::disk('public')->deleteDirectory($folder);
          }
    }

    static function testUpload($file){
      $file_folder = 'test/' . Str::uuid()->toString();
      $file_name = $file->getClientOriginalName();
      $mime_type = $file->getClientOriginalExtension();
      $full_path = $file_folder . '/' . $file_name;     
      $file->storeAs($file_folder, $file_name, 'public');
    }
}
