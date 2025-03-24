<?php 

use Illuminate\Support\Facades\Storage;
function StoreImage($Image,$Path,$OldImage=null){
    if($OldImage!=null){
        Storage::disk('public')->delete($OldImage);
    }
    $path=Storage::disk('public')->put($Path,$Image);
    return $path;
}