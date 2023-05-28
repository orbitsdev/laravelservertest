<?php

namespace App\Models;

use App\Models\File;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];



    //helpers

    public function generateSlug(){
        $baseSlug = Str::slug($this->product_name);
        $slug = $baseSlug;
        $counter = 1;

        while (self::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        $this->slug = $slug;
    }


    //relationship

    public function files(): MorphMany
    {
        return $this->morphMany(File::class, 'fileable');
    }

}
