<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\HotOffers;
use App\Models\catagory;
use App\Models\product_image;
use File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = products::with('catagory')->get();
        return view('admin.products',compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $catagories = catagory::where('is_service',0)->where('status',1)->get();
        return view('admin.add-service',compact('catagories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $add = new Products;
        $add->catagory_id = $request->service_catagory;
        $add->title = $request->service_title;
        $add->short_des = $request->short_description;
        $add->long_des = $request->long_description;
        $add->contact = $request->seller_contact;
        $add->price = $request->service_price;
        $add->suffix = $request->price_suffix;
        $add->save();

        $image = $request->file('feature_image');
        /**  Activate For live server **/
        // $path = public_path();
        // $path = str_replace("ayojok_base/public", "public_html", $path);
        // $destinationPath = $path.'img/ayojok-product/profile/';
        /** End of Activate For live server **/
        $input['imagename'] = $add->id.'.'.$image->getClientOriginalExtension();
        /** Deactivate on live server **/
        $destinationPath = public_path('img/ayojok-product/profile/');
        /** End of Deactivate on live server **/
        $image->move($destinationPath, $input['imagename']);

        $fileurl = 'img\ayojok-product\profile\\'.$input['imagename'];

        Products::where('id',$add->id)->update(['image' => $fileurl]) ;

        if($request->hasFile('extra_image')){
          $i = 0;
          /**  Activate For live server **/
          // $path = public_path();
          // $path = str_replace("ayojok_base/public", "public_html", $path);
          // $destinationPath = $path.'img/ayojok-product/';
          /** End of Activate For live server **/
          foreach ($request->extra_image as $extra_image) {
            $i++;
            $input['imagename'] = $add->id.'_img'.$i.'.'.$extra_image->getClientOriginalExtension();
            /** Deactivate on live server **/
            $destinationPath = public_path('img/ayojok-product/');
            /** End of Deactivate on live server **/
            $extra_image->move($destinationPath, $input['imagename']);

            $fileurl = 'img\ayojok-product\\'.$input['imagename'];

            $addimg = new product_image;
            $addimg->products_id = $add->id;
            $addimg->img_location = $fileurl;
            $addimg->save() ;
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
    public function show($id)
    {
      $datas = Products::where('id',$id)->with('catagory')->with('images')->get();
      //dd($datas);
      return view('admin.products-single',compact('datas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $datas = Products::where('id',$id)->with('catagory')->with('images')->get();
      $catagories = catagory::where('is_service',0)->where('status',1)->get();
      //dd($productimage);
      return view('admin.products-edit',compact('datas','catagories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //dd($request->all());
        $add = Products::find($id);
        $add->title = $request->service_title;
        $add->short_des = $request->short_description;
        $add->long_des = $request->long_description;
        $add->contact = $request->seller_contact;
        $add->price = $request->service_price;
        $add->suffix = $request->price_suffix;
        $add->save();

        if($request->hasFile('feature_image')){
        /** Activate on live server
          * When running in localhost this will not work, so in live share hosting server the following functuin will work.
          **/
          // $path = public_path();
          // $path = str_replace("ayojok_base/public", "public_html", $path);
          // $destinationPath = $path.'img/ayojok-product/profile/';

          /**   Delete feature image from directory **/
          // $featpath = $path.'\\'.$add->image;
          // $featpath = str_replace("\\",'/', $featpath);
          //   if(File::exists($featpath)){
          //       File::delete($featpath);
          //   }
          /** End of active on live server **/
          File::delete($add->image);

          /** Add the new image file **/
          $image = $request->file('feature_image');
          $input['imagename'] = $add->id.'.'.$image->getClientOriginalExtension();
          /** Deactivate on live server **/
          $destinationPath = public_path('img/ayojok-product/profile/');
          /** End of Deactivate on live server **/
          $image->move($destinationPath, $input['imagename']);

          $fileurl = 'img\ayojok-product\profile\\'.$input['imagename'];

          Products::where('id',$add->id)->update(['image' => $fileurl]) ;
        }



        if($request->hasFile('extra_image')){

          $dels = product_image::where('products_id',$id)->get();
          /** Activate on live server
            * When running in localhost this will not work, so in live share hosting server the following functuin will work.
            **/
            // $path = public_path();
            // $path = str_replace("ayojok_base/public", "public_html", $path);
            // $destinationPath = $path.'img/ayojok-product/';
            /** End of active on live server **/
          foreach ($dels as $del) {

              /** Activate on live server, Delete feature image from directory **/
              // $extrapath = $path.'\\'.$del->img_location;
              // $extrapath = str_replace("\\",'/', $extrapath);
              //   if(File::exists($extrapath)){
              //       File::delete($extrapath);
              //   }
              /** End of active on live server **/
              File::delete($del->img_location);
          }
          $delete = product_image::where('products_id',$id)->delete();

          $i = 0;
          foreach ($request->extra_image as $extra_image) {
            $i++;
            $input['imagename'] = $add->id.'_img'.$i.'.'.$extra_image->getClientOriginalExtension();
            /** Deactivate on live server **/
            $destinationPath = public_path('img/ayojok-product/');
            /** End of Deactivate on live server **/
            $extra_image->move($destinationPath, $input['imagename']);

            $fileurl = 'img\ayojok-product\\'.$input['imagename'];

            $addimg = new product_image;
            $addimg->products_id = $add->id;
            $addimg->img_location = $fileurl;
            $addimg->save() ;
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
    public function destroy($id)
    {
      $remove = Products::find($id);
      $remove->delete();

      return redirect()->route('service.index');
    }
     public function suspend($id)
     {
       $remove = Products::find($id);
       $remove->status = 1;
       $remove->save();

       return redirect()->route('service.index');
     }

     public function active($id)
     {
       $remove = Products::find($id);
       $remove->status = 0;
       $remove->save();

       return redirect()->route('service.index');
     }
}
