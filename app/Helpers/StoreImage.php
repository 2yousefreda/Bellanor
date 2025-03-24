<?php 

use Illuminate\Support\Facades\Storage;
function StoreImage($Image,$Path){
    $path=Storage::disk('public')->put($Path,$Image);
    return $path;
}