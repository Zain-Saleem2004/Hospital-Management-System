<?php

namespace APP\Traits;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


trait UploadTrait
{
    public function verifyAndStoreImage(Request $request, $inputname, $foldername, $disk, $imageable_id, $imageable_type)
    {
        if ($request->hasFile($inputname)) {

            // Check img
            if (!$request->file($inputname)->isValid()) {
            //    flash('Invalid Image!')->error()->important();
                return redirect()->back()->withInput();
            }

            $photo = $request->file($inputname);
            $name = Str::slug($request->input('name'));
            $file_name = $name . '.' . $photo->getClientOriginalExtension();

            // insert Image
            $Image = new Image();
            $Image->file_name = $file_name;
            $Image->imageable_id = $imageable_id;
            $Image->imageable_type = $imageable_type;
            $Image->save();
            return $request->file($inputname)->storeAs($foldername, $file_name, $disk);
        }
        return null;
    }

    public function verifyAndStoreImageForeach($varforeach , $foldername , $disk, $imageable_id, $imageable_type) {

        // insert Image
        $Image = new Image();
        $Image->file_name = $varforeach->getClientOriginalName();
        $Image->imageable_id = $imageable_id;
        $Image->imageable_type = $imageable_type;
        $Image->save();
        return $varforeach->storeAs($foldername, $varforeach->getClientOriginalName(), $disk);
    }


    public function Delete_Attachment($disk,$path,$id,$file_name){
        Storage::disk($disk)->delete($path);
        Image::where('imageable_id',$id)->delete();

    }
}
