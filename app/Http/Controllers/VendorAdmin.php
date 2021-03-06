<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\catagory;
use App\Models\vendors;
use App\Models\packages;
use App\Models\vendor_image;
use App\Models\vendor_features;
use View;
use File;

class VendorAdmin extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $datas = vendors::with('packages')->get();
      //dd($datas);
      return view('admin.vendors',compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $catagories = catagory::where('is_service',1)->where('status',1)->get();
        return view('admin.add-vendor',compact('catagories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //dd($request->venue_area);

        $add = new vendors;
        $add->catagory_id = $request->vendor_catagory;
        $add->title = $request->vendor_title;
        $add->about_us = $request->about_us;
        $add->contact = $request->vendor_contact;
        $add->startingat_1_title = $request->startingat_1_title;
        $add->startingat_1_price = $request->startingat_1_price;
        $add->startingat_2_title = $request->startingat_2_title;;
        $add->startingat_2_price = $request->startingat_2_price;
        $add->startingat_3_title = $request->startingat_3_title;;
        $add->startingat_3_price = $request->startingat_3_price;
        $add->save();

        $catagorydata =  catagory::find($request->vendor_catagory);
        $model = '\App\Models\\'.$catagorydata->feature_table;


        $datas = new $model;
        $datas->vendor_id = $add->id;
        $datas->feature_1 = $request->feature1;
        $datas->feature_2 = $request->feature2;
        $datas->feature_3 = $request->feature3;
        $datas->feature_4 = $request->feature4;

        /*Edit for kazi & Mehdi*/
        if(isset($request->feature5)){
            $datas->feature_5 = $request->feature5;
        }
        if(isset($request->feature6)){
            $datas->feature_6 = $request->feature6;
        }
        if(isset($request->feature7)){
            $datas->feature_7 = $request->feature7;
        }
        if(isset($request->feature8)){
            $datas->feature_8 = $request->feature8;
        }
        if(isset($request->lowest_price)){
            $datas->low_price = $request->lowest_price;
        }

        /*End of Edit for kazi & Mehdi*/




        if(isset($request->venue_area)){
          $datas->area = $request->venue_area;
        }
        if(isset($request->kazi_area)){
          $datas->area = $request->kazi_area;
        }
        if(isset($request->menu_type)){
          $menu = implode(',',$request->menu_type);
          $datas->menu_type = $menu;
        }
        if(isset($request->event_type)){
          $event = implode(',',$request->event_type);
          $datas->event_type = $event;
        }
        if(isset($request->speciality)){
          $special = implode(',',$request->speciality);
          $datas->speciality_type = $special;
        }
        if(isset($request->bakery_speciality)){
          $special = implode(',',$request->bakery_speciality);
          //dd($special);
          $datas->speciality_type = $special;
        }
        $datas->save();


        /** Update Profile Image **/
        if($request->hasFile('profile_image')){
        /** Activate For live server **/
        // $path = public_path();
        // $path = str_replace("ayojok_base/public", "public_html", $path);
        // $destinationPath = $path.'img/vendor-profile/';
        /** End of Activate For live server **/
        $image = $request->file('profile_image');
        $input['imagename'] = $add->id.'.'.$image->getClientOriginalExtension();
        /** Deactivate on live server **/
        $destinationPath = public_path('img/vendor-profile/');
        /** End of Deactivate on live server **/
        if($image->move($destinationPath, $input['imagename'])){
          $fileurl = 'img\vendor-profile\\'.$input['imagename'];
          vendors::where('id',$add->id)->update(['profile_img' => $fileurl]) ;
        }else{
          echo "Error";
        }
      }

        /** Update logo **/
        if($request->hasFile('logo_image')){
          /**  Activate For live server **/
          // $path = public_path();
          // $path = str_replace("ayojok_base/public", "public_html", $path);
          // $destinationPath = $path.'img/vendor-logo/';
          /** End of Activate For live server **/
        $image = $request->file('logo_image');
        $input['imagename'] = $add->id.'.'.$image->getClientOriginalExtension();
        /** Deactivate on live server **/
        $destinationPath = public_path('img/vendor-logo/');
        /** End of Deactivate on live server **/
        if($image->move($destinationPath, $input['imagename'])){
          $fileurl = 'img\vendor-logo\\'.$input['imagename'];
          vendors::where('id',$add->id)->update(['logo' => $fileurl]) ;
        }else{
          echo "Error";
        }
      }

        /** featuer Image Upload **/
        if($request->hasFile('feature_image')){
          $i = 0;
          /** Activate For live server **/
          // $path = public_path();
          // $path = str_replace("ayojok_base/public", "public_html", $path);
          // $destinationPath = $path.'img/feature-image/';
          /** End of Activate For live server **/
          foreach ($request->feature_image as $feature) {
            $i++;
            $input['imagename'] = $add->id.'_f'.$i.'.'.$feature->getClientOriginalExtension();
            $column = 'feature_image_'.$i;
            /** Deactivate on live server **/
            $destinationPath = public_path('img/feature-image/');
            /** End of Deactivate on live server **/
            $feature->move($destinationPath, $input['imagename']);

            $fileurl = 'img\feature-image\\'.$input['imagename'];
            vendors::where('id',$add->id)->update([$column => $fileurl]) ;
          }
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $r)
    {
      //dd($r->all(),$id);
      $table = catagory::find($r->catagoryid);
      $ftable =  $table->feature_table;
      $model = '\App\Models\\'.$ftable;
      //dd($model);
      $datas = new $model;
      $datas = $datas->where('vendor_id',$id)->firstOrFail();
      $vendors = vendors::where('id',$id)->with('catagory')->with('packages')->with('images')->get();
      $features = vendor_features::where('catagory_id',$r->catagoryid)->firstOrFail();
      //dd($datas,$vendors,$features);
      return view('admin.vendors-single',compact('datas','vendors','features'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vendata = vendors::where('id',$id)->with('catagory')->firstOrFail();
        $ftable = $vendata->catagory->feature_table;
        //dd($ftable);
        $model = '\App\Models\\'.$ftable;
        $datas = new $model;
        $data = $datas->where('vendor_id',$id)->firstOrFail();
        //dd($datas,$vendata);
        return view('admin.edit-vendor',compact('vendata','data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id,Request $request)
    {
      //dd($request->all());
      $update = vendors::find($id);
      if($request->has('vendor_title')){
        $update->title = $request->vendor_title;
      }
      if ($request->has('about_us')) {
        $update->about_us = $request->about_us;
      }
      if ($request->has('vendor_contact')) {
        $update->contact = $request->vendor_contact;
      }
      if ($request->has('startingat_1_title')) {
        $update->startingat_1_title = $request->startingat_1_title;
      }
      if ($request->has('startingat_1_price')) {
        $update->startingat_1_price = $request->startingat_1_price;
      }
      if ($request->has('startingat_2_title')) {
        $update->startingat_2_title = $request->startingat_2_title;
      }
      if ($request->has('startingat_2_price')) {
        $update->startingat_2_price = $request->startingat_2_price;
      }
      if ($request->has('startingat_3_title')) {
        $update->startingat_3_title = $request->startingat_3_title;
      }
      if ($request->has('startingat_3_price')) {
        $update->startingat_3_price = $request->startingat_3_price;
      }

      $update->save();

      $catagorydata =  catagory::find($request->vendor_catagory);
      $model = '\App\Models\\'.$catagorydata->feature_table;


      $datas = $model::where('vendor_id',$id)->first();
      //dd($datas);
      //$datas->vendor_id = $update->id;
      if ($request->has('feature1')) {
        $datas->feature_1 = $request->feature1;
      }
      if ($request->has('feature2')) {
        $datas->feature_2 = $request->feature2;
      }
      if ($request->has('feature3')) {
        $datas->feature_3 = $request->feature3;
      }
      if ($request->has('feature4')) {
        $datas->feature_4 = $request->feature4;
      }
      if ($request->has('feature5')) {
        $datas->feature_5 = $request->feature5;
      }
      if ($request->has('feature6')) {
        $datas->feature_6 = $request->feature6;
      }
      if ($request->has('feature7')) {
        $datas->feature_7 = $request->feature7;
      }
      if ($request->has('feature8')) {
        $datas->feature_8 = $request->feature8;
      }
      if ($request->has('lowest_price')) {
        $datas->low_price = $request->lowest_price;
      }
      if($request->filled('venue_area')){
        //dd($request->venue_area);
        $datas->area = $request->venue_area;
      }
      elseif($request->filled('kazi_area')){
          $datas->area = $request->kazi_area;
        }
      if($request->has('menu_type')){
        $menu = implode(',',$request->menu_type);
        $datas->menu_type = $menu;
      }
      if($request->has('event_type')){
        $event = implode(',',$request->event_type);
        $datas->event_type = $event;
      }
      if($request->has('speciality')){
        $special = implode(',',$request->speciality);
        $datas->speciality_type = $special;
      }
      if($request->has('bakery_speciality')){
        $special = implode(',',$request->bakery_speciality);
        //dd($special);
        $datas->speciality_type = $special;
      }
      $datas->save();


      /** Update Profile Image **/
      if($request->hasFile('profile_image')){
      /** Activate For live server **/
      // $path = public_path();
      // $path = str_replace("ayojok_base/public", "public_html", $path);
      // $destinationPath = $path.'img/vendor-profile/';
      /** End of Activate For live server **/

      /** Deactivate this on live server **/
      File::delete($update->profile_img);
      /** End of Deactivate this on live server **/

      /** Activate on live server, Delete feature image from directory **/
      // $extrapath = $path.'\\'.$update->profile_img;
      // $extrapath = str_replace("\\",'/', $extrapath);
      //   if(File::exists($extrapath)){
      //       File::delete($extrapath);
      //   }
      /** End of active on live server **/

      $image = $request->file('profile_image');
      $input['imagename'] = $add->id.'.'.$image->getClientOriginalExtension();
      /** Deactivate on live server **/
      $destinationPath = public_path('img/vendor-profile/');
      /** End of Deactivate on live server **/
      if($image->move($destinationPath, $input['imagename'])){
        $fileurl = 'img\vendor-profile\\'.$input['imagename'];
        vendors::where('id',$add->id)->update(['profile_img' => $fileurl]) ;
      }else{
        echo "Error";
      }
    }

      /** Update logo **/
      if($request->hasFile('logo_image')){
        /**  Activate For live server **/
        // $path = public_path();
        // $path = str_replace("ayojok_base/public", "public_html", $path);
        // $destinationPath = $path.'img/vendor-logo/';
        /** End of Activate For live server **/

        /** Deactivate this on live server **/
        File::delete($update->logo);
        /** End of Deactivate this on live server **/

        /** Activate on live server, Delete feature image from directory **/
        // $extrapath = $path.'\\'.$update->logo;
        // $extrapath = str_replace("\\",'/', $extrapath);
        //   if(File::exists($extrapath)){
        //       File::delete($extrapath);
        //   }
        /** End of active on live server **/

      $image = $request->file('logo_image');
      $input['imagename'] = $add->id.'.'.$image->getClientOriginalExtension();
      /** Deactivate on live server **/
      $destinationPath = public_path('img/vendor-logo/');
      /** End of Deactivate on live server **/
      if($image->move($destinationPath, $input['imagename'])){
        $fileurl = 'img\vendor-logo\\'.$input['imagename'];
        vendors::where('id',$add->id)->update(['logo' => $fileurl]) ;
      }else{
        echo "Error";
      }
    }

      /** featuer Image Upload **/
      if($request->hasFile('feature_image')){

        /** Activate For live server **/
        // $path = public_path();
        // $path = str_replace("ayojok_base/public", "public_html", $path);
        // $destinationPath = $path.'img/feature-image/';
        /** End of Activate For live server **/


        for ($a=1; $a < 4; $a++) {
          $column = 'feature_image_'.$a;
          /** Deactivate this on live server **/
          File::delete($update->$column);
          /** End of Deactivate this on live server **/

          /** Activate on live server, Delete feature image from directory **/
          // $extrapath = $path.'\\'.$update->$column;
          // $extrapath = str_replace("\\",'/', $extrapath);
          //   if(File::exists($extrapath)){
          //       File::delete($extrapath);
          //   }
          /** End of active on live server **/
        }

        $i = 0;
        foreach ($request->feature_image as $feature) {
          $i++;
          $input['imagename'] = $add->id.'_f'.$i.'.'.$feature->getClientOriginalExtension();
          $column = 'feature_image_'.$i;
          /** Deactivate on live server **/
          $destinationPath = public_path('img/feature-image/');
          /** End of Deactivate on live server **/
          $feature->move($destinationPath, $input['imagename']);

          $fileurl = 'img\feature-image\\'.$input['imagename'];
          vendors::where('id',$add->id)->update([$column => $fileurl]) ;
        }
      }
      return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Request $r)
    {
      $table = catagory::find($r->catagoryid);
      $ftable =  $table->feature_table;
      $model = '\App\Models\\'.$ftable;
      $data = new $model;
      $data = $data->where('vendor_id',$id)->delete();

      $del = vendors::find($id);
      /** Activate on live server
      * When running in localhost this will not work, so in live share hosting server the following functuin will work.
      **/
      // $path = public_path();
      // $path = str_replace("ayojok_base/public", "public_html", $path);

      /**   Delete Logo from directory **/
      // $logopath = $path.'\\'.$del->logo;
      // $logopath = str_replace("\\",'/', $logopath);
      //   if(File::exists($logopath)){
      //       File::delete($logopath);
      //   }

      /** Delete profile from directory **/
      // $profilepath = $path.'\\'.$del->profile_img;
      // $profilepath = str_replace("\\",'/', $profilepath);
      //   if(File::exists($profilepath)){
      //       File::delete($profilepath);
      //   }

      /** Delete feaeture_image 1 from directory **/
      // $f1path = $path.'\\'.$del->feature_image_1;
      // $f1path = str_replace("\\",'/', $f1path);
      //   if(File::exists($f1path)){
      //       File::delete($f1path);
      //   }

      /**  Delete feature_image 2 from directory **/
      // $f2path = $path.'\\'.$del->feature_image_2;
      // $f2path = str_replace("\\",'/', $f2path);
      //   if(File::exists($f2path)){
      //       File::delete($f2path);
      //   }

      /** Delete feature_image 3 from directory **/
      // $f3path = $path.'\\'.$del->feature_image_3;
      // $f3path = str_replace("\\",'/', $f3path);
      //   if(File::exists($f3path)){
      //       File::delete($f3path);
      //   }

      /**
      * End of activate on live server
      **/

      File::delete($del->profile_img);
      File::delete($del->logo);
      File::delete($del->feature_image_1);
      File::delete($del->feature_image_2);
      File::delete($del->feature_image_3);
      $del->delete();

      $pack = packages::where('vendors_id',$id)->delete();

      $img = vendor_image::where('vendors_id',$id)->delete();
      // dd($pack,$img);

      return redirect()->route('vendors.index');
    }

    /**
    * For any reason the admin can deactivate a user, its is not time base, its a manual system where admin
    * can deactivate any vendor.
    **/
    public function suspend($id, Request $r)
    {
      //dd($r->all());
      $table = catagory::find($r->catagoryid);
      $ftable =  $table->feature_table;
      $model = '\App\Models\\'.$ftable;
      //dd($model);
      $data = new $model;
      $data = $data->where('vendor_id',$id)->update(['status'=>1]);

      $update = vendors::find($id);
      $update->status = 1;
      $update->save();

      return redirect()->route('vendors.index');
    }

    /**
    * If we want to active a deactivate vendor, we will use this functio.
    **/
    public function active($id, Request $r)
    {
      $table = catagory::find($r->catagoryid);
      $ftable =  $table->feature_table; //get the feature table name from the catagory table
      $model = '\App\Models\\'.$ftable;
      $data = new $model; //Assign the dynamic model
      $data = $data->where('vendor_id',$id)->update(['status'=>0]);

      $update = vendors::find($id); //find the vendor from vendor table
      $update->status = 0; //update the status of the vendor
      $update->save(); //save the vendor directly from the controller

      return redirect()->route('vendors.index');
    }

    /**
    * Show list of the vendor and the packages status, if any vendor has no package
    * then the list will show "Not Available" and if a single package is availabel
    * then it will show "Available"
    **/
    public function packages(){
      $datas = vendors::with('packages')->with('images')->get();
      return view('admin.vendors-packages',compact('datas'));
    }

    /**
    * Get all the packge from the package list inside a specific vendor
    **/
    public function getpackages($id){
      $datas = vendors::where('id',$id)->with('packages')->firstOrFail();
      return view('admin.vendors-addPack',compact('datas'));
    }

    /**
    * Add a new packge from the package list inside a specific vendor packagelists
    **/
    public function addPackage($id,Request $r){
      $find = vendors::find($id);
      $pack = packages::where('vendors_id',$id)->count();
      $pack++;
      $add = new packages;
      $add->catagory_id = $find->catagory_id;
      $add->vendors_id = $id;
      $add->title = $r->package_title;
      $add->price = $r->package_price;
      $add->description = $r->package_description;
      $add->save();


      /**  Activate For live server **/
      // $path = public_path();
      // $path = str_replace("ayojok_base/public", "public_html", $path);
      // $destinationPath = $path.'img/vendor-package/';
      /** End of Activate For live server **/
      $image = $r->file('package_image');
      $input['imagename'] = $id.'_'.$pack.'.'.$image->getClientOriginalExtension();
      /** Deactivate on live server **/
      $destinationPath = public_path('img/vendor-package/');
      /** End of deactivate on live server **/
      $image->move($destinationPath, $input['imagename']);

      $fileurl = 'img\vendor-package\\'.$input['imagename'];

      packages::where('id',$add->id)->update(['image' => $fileurl]) ;
      return redirect()->back();
    }

    /**
    * Delete packge from the package list inside a specific vendor packagelists
    **/
    public function delPackage($id){

        $del = packages::find($id);
        /** Activate on live server
        * When running in localhost this will not work, so in live share hosting server the following functuin will work.
        **/
        // $path = public_path();
        // $path = str_replace("ayojok_base/public", "public_html", $path);

        /**   Delete package image from directory **/
        // $packpath = $path.'\\'.$del->image;
        // $packpath = str_replace("\\",'/', $packpath);
        //   if(File::exists($packpath)){
        //       File::delete($packpath);
        //   }
        /** End of active on live server **/
        File::delete($del->image);
        $del->delete();
        return redirect()->back();
    }

}
