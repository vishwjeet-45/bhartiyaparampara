<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\backend\SubCategory;
use App\Models\backend\MainCategory;
use App\Models\backend\Category;
use Illuminate\Http\Request;
use App\Models\backend\Post;
use Illuminate\Support\Str;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $m_c_list = MainCategory::where('main_category_status', 1)->orderBy('id', 'desc')->get();
        $c_list = Category::where('category_status', 1)->orderBy('id', 'desc')->get();

        if(isset($_GET['qty']) && $_GET['qty'] != ''){
            $qty = $_GET['qty'];
        }else{
            $qty = 10;
        }

        $s_c_list = SubCategory::select('*');
        if(isset($_GET['search']) && $_GET['search'] != ''){
            $s_c_list = $s_c_list->where('sub_category_name_en', 'LIKE', '%'.$_GET['search'].'%');
        }
        $s_c_list = $s_c_list->with('Category')->with('mainCategory')->orderBy('id', 'desc')->paginate($qty);   
        return view('backend.sub_category.index', compact('c_list', 'm_c_list', 's_c_list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $s_c_name_en = $request->sub_category_name_en;
        $s_c_name_hi = $request->sub_category_name_hi;
        $m_c_id = $request->main_category_id;
        $c_id = $request->category_id;
        $s_c_status = $request->sub_category_status;
        $s_c_thumbnail = '';
        $s_c_short_desc_en = $request->sub_category_short_description_en;
        $s_c_short_desc_hi = $request->sub_category_short_description_hi;

        $meta_title_en = $request->meta_title_en;
        $meta_description_en = $request->meta_description_en;

        $meta_title_hi = $request->meta_title_hi;
        $meta_description_hi = $request->meta_description_hi;
        $slug = Str::slug($request->create_slug);


        $find_s_cat_en = SubCategory::where('sub_category_name_en', $s_c_name_en)->first();
        $find_s_cat_hi = SubCategory::where('sub_category_name_hi', $s_c_name_hi)->first();
       
        if($find_s_cat_en && $find_s_cat_hi){
            return redirect(url()->current())->with('already_exist', 'Sub Category already exist !');
        }else if($find_s_cat_hi){
            return redirect(url()->current())->with('hindi_exist', 'Sub Category name in hindi already exist !');
        }else if($find_s_cat_en){
            return redirect(url()->current())->with('english_exist', 'Sub Category name in english already exist !');
        }


        if($request->hasFile('sub_category_thumbnail')){
            $thumbnailFile = $request->file('sub_category_thumbnail');
            $originalThumbnailName = $thumbnailFile->getClientOriginalName();
            $thumbnail_name = time().'.'.$thumbnailFile->extension();
            $thumbnailFile->move(public_path('build/assets/upload/sub_cat_thumbnail'), $thumbnail_name);
            $s_c_thumbnail = $thumbnail_name;
        } 

        
        try{
            $s_category = SubCategory::create([
                'main_category_id' => $m_c_id,
                'category_id' => $c_id,
                'sub_category_name_en' => $s_c_name_en,
                'sub_category_name_hi' => $s_c_name_hi,
                'sub_category_short_description_en' => $s_c_short_desc_en,
                'sub_category_short_description_hi' => $s_c_short_desc_hi,
                'sub_category_thumbnail' => $s_c_thumbnail, 
                'meta_title_en' => $meta_title_en,
                'meta_description_en' => $meta_description_en,
                'meta_title_hi' => $meta_title_hi,
                'meta_description_hi' => $meta_description_hi,
                'sub_category_status' => $s_c_status,
                'slug' => $slug
            ]);
 
    }catch(\Exception $e){ 
        return redirect(url()->current())->with('error', 'Something went wrong please try again !');
    }
        if($s_category){
            return redirect(url()->current())->with('success', 'Sub Category has been added successfully !');
        }else{
            return redirect(url()->current())->with('failed', 'Something went wrong please try again !');
        } 
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = SubCategory::with('Category')->with('mainCategory')->find($id);
        $cat_list = Category::where('main_category_id', $data->main_category_id)->get();
        return response()->json([
            "status" => 200,
            "sub_cat_detail" => $data,
            "cat_list" => $cat_list
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $s_c_id = $request->sub_category_id; 
        $s_c_name_en = $request->edit_sub_category_name_en;
        $s_c_name_hi = $request->edit_sub_category_name_hi;
        $m_c_id = $request->edit_main_category_id;
        $c_id = $request->edit_category_id;
        $s_c_status = $request->edit_sub_category_status;
        $s_c_short_desc_en = $request->edit_sub_category_short_description_en;
        $s_c_short_desc_hi = $request->edit_sub_category_short_description_hi;

        $meta_title_hi = $request->edit_meta_title_hi;
        $meta_description_hi = $request->edit_meta_description_hi;

        $meta_title_en = $request->edit_meta_title_en;
        $meta_description_en = $request->edit_meta_description_en;
        $slug = Str::slug($request->edit_slug);

        $s_cat_detail = SubCategory::where('id', $s_c_id)->first();

        if($s_cat_detail->sub_category_name_en != $s_c_name_en && $s_cat_detail->sub_category_name_hi != $s_c_name_hi){
            $find_s_cat_en = SubCategory::where('sub_category_name_en', $s_c_name_en)->first();
            $find_s_cat_hi = SubCategory::where('sub_category_name_hi', $s_c_name_hi)->first();
            if($find_s_cat_en && $find_s_cat_hi){
                return redirect()->back()->with('already_exist', 'Sub Category already exist !');
            }
        }else if($s_cat_detail->sub_category_name_en != $s_c_name_en){
            $find_s_cat_en = SubCategory::where('sub_category_name_en', $s_c_name_en)->first();
            if($find_s_cat_en){
                return redirect()->back()->with('english_exist', 'Sub Category name in english already exist !');
            }
        }else if($s_cat_detail->sub_category_name_hi != $s_c_name_hi){
            $find_s_cat_hi = SubCategory::where('sub_category_name_hi', $s_c_name_hi)->first();
            if($find_s_cat_hi){
                return redirect()->back()->with('hindi_exist', 'Sub Category name in hindi already exist !');
            }
        }



        $updated_sub_category = SubCategory::where('id', $s_c_id)->update([
            'main_category_id' => $m_c_id,
            'category_id' => $c_id,
            'sub_category_name_en' => $s_c_name_en,
            'sub_category_name_hi' => $s_c_name_hi,
            'sub_category_short_description_en' => $s_c_short_desc_en,
            'sub_category_short_description_hi' => $s_c_short_desc_hi, 
            'meta_title_hi' => $meta_title_hi,
            'meta_description_hi' => $meta_description_hi, 
            'meta_title_en' => $meta_title_en,
            'meta_description_en' => $meta_description_en, 
            'sub_category_status' => $s_c_status,
            'slug' => $slug
        ]);

        if($request->hasFile('edit_sub_category_thumbnail')){
            $thumbnailImage = $request->file('edit_sub_category_thumbnail');
            $thumbnailOriginalName = $thumbnailImage->getClientOriginalName();
            $thumbnailImageName = time().'.'.$thumbnailImage->extension();
            $thumbnailImage->move(public_path('build/assets/upload/sub_cat_thumbnail'), $thumbnailImageName);
            SubCategory::where('id', $s_c_id)->update(['sub_category_thumbnail' => $thumbnailImageName]);
        }
        

        if($updated_sub_category){
            return redirect()->back()->with('update_success', 'Sub Category has been update successfully !');
        }else{
            return redirect()->back()->with('update_failed', 'Something went wrong please try again !');
        } 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $sub_category = SubCategory::findOrFail($id);
        $check_post = Post::whereJsonContains('sub_category_id', $sub_category->id)->get();

        
       if($check_post->count() !== 0){
           return response()->json([
               'status' => 400,
               'message' => 'delete_failed',
               'error' => 'Sub Category is used in post !'
           ]);
        } else{

        $s_c_delete = $sub_category->delete();

        if($s_c_delete){
            return redirect()->back()->with('delete_success', 'Sub Category has been delete successfully !');
        }else{
            return redirect()->back()->with('delete_failed', 'Something went wrong please try again !');
        } 
    }
    }

    
    public function updateStatus(Request $request){
        $s_c_status = $request->s_c_status;
        $s_c_id = $request->s_c_id; 
        $c_status_update = SubCategory::where('id', $s_c_id)->update(['sub_category_status' => $s_c_status]);
        return response()->json([
            'status' => 200,
            'message' => 'c_status_update'
        ]);
    }

    public function getCategoryList(Request $request){
        $m_c_id = $request->main_cat_id;
        $c_list = Category::where('main_category_id', $m_c_id)->get();

        return response()->json([
            'status' => 200,
            'message' => 'success',
            'data' => $c_list
        ]);
    }
    
    public function checkEditSlug(Request $request){
        $id = $request->id;
        $slug = Str::slug($request->slug); 
        
            $check_slug = SubCategory::where('id', '!=', $id)->where('slug', $slug)->first();
            if($check_slug){
                return response()->json([
                    'status' => 400,
                    'message' => 'slug_exist',
                    'table'=> 'main_category'
                ]);
            }else{
                return response()->json([
                    'status' => 200,
                    'message' => 'slug_not_exist',
                    'table'=> 'main_category'
                ]);
            } 
    }


    public function checkCreateSlug(Request $request){
        $slug = Str::slug($request->slug);   
            $check_slug = SubCategory::where('slug', $slug)->first();
            if($check_slug){
                return response()->json([
                    'status' => 400,
                    'message' => 'slug_exist',
                    'table'=> 'main_category'
                ]);
            }else{
                return response()->json([
                    'status' => 200,
                    'message' => 'slug_not_exist',
                    'table'=> 'main_category'
                ]);
            }   
    }
}
