<?php 
use App\Model\Setting;
use Illuminate\Http\Request;

  if(! function_exists('SiteSetting'))
  {
    function SiteSetting($key = null, $default = null)
    {
        if ($key === null) {
        return app(Setting::class);
    }

        return app(Setting::class)->get($key, $default);
    }
  }

  if(! function_exists('storeImage'))
  {
    function storeImage(Request $request, $fieldname , $directory , $id , $tableName = null)
    {

        if( $request->hasFile($fieldname) ) {

            if ($request->file($fieldname)->isValid()) {

                if (!file_exists($directory)) {
  
                    mkdir($directory, 755, true);
                }
        
                $img = $request->file($fieldname);

                $imageSaveAsName = time() . $id . "-".$tableName."." . $img->getClientOriginalExtension();

                $img = Image::make($img->getRealPath())->resize(300, 300);              

                $image_url = $directory . $imageSaveAsName;  
                 
                // $success = $img->move($directory, $imageSaveAsName); 

                $img->save(public_path($directory .$imageSaveAsName));
            }
            return $image_url;
        }

    }
  }
