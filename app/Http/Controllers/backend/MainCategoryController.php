<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\backend\MainCategory;
use Illuminate\Http\Request;
use App\Models\backend\Page;
use Illuminate\Support\Str;
use App\Models\backend\Post;

class MainCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(isset($_GET['qty']) && $_GET['qty'] != ''){
            $qty = $_GET['qty'];
        }else{
            $qty = 10;
        }

        $m_c_list = MainCategory::select('*');
        if(isset($_GET['search']) && $_GET['search'] != ''){
            $m_c_list = $m_c_list->where('main_category_name_en', 'LIKE', '%'.$_GET['search'].'%');
        }

        if(isset($_GET['post_type']) && $_GET['post_type'] != ''){
            $m_c_list = $m_c_list->where('page_type', $_GET['post_type']);
        }

        $m_c_list = $m_c_list->orderBy('order_number', 'asc')->paginate($qty);
        return view('backend.main_category.index', compact('m_c_list'));
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
        $m_c_name_en = $request->main_category_name_en;
        $m_c_name_hi = $request->main_category_name_hi;
        $main_category_is_page = $request->main_category_is_page;
        $m_c_status = $request->main_category_status;
        $m_c_thumbnail = '';
        $m_c_short_description = $request->main_category_short_description;
        $meta_title_en = $request->meta_title_en;
        $meta_description_en = $request->meta_description_en;
        $meta_title_hi = $request->meta_title_hi;
        $meta_description_hi = $request->meta_description_hi;
        $order_number = $request->order_number;
        $slug = Str::slug($request->slug);

        $find_m_cat_en = MainCategory::where('main_category_name_en', $m_c_name_en)->first();
        $find_m_cat_hi = MainCategory::where('main_category_name_hi', $m_c_name_hi)->first();
       
        if($find_m_cat_en && $find_m_cat_hi){
            return redirect(url()->current())->with('already_exist', 'Main Category already exist !');
        }else if($find_m_cat_hi){
            return redirect(url()->current())->with('hindi_exist', 'Main Category name in hindi already exist !');
        }else if($find_m_cat_en){
            return redirect(url()->current())->with('english_exist', 'Main Category name in english already exist !');
        }

        
        if($request->hasFile('main_category_thumbnail')){
            $thumbnailFile = $request->file('main_category_thumbnail');
            $originalThumbnailName = $thumbnailFile->getClientOriginalName();
            $thumbnail_name = time().'.'.$thumbnailFile->extension();
            $thumbnailFile->move(public_path('build/assets/upload/main_cat_thumbnail'), $thumbnail_name);
            $m_c_thumbnail = $thumbnail_name;
        }
        $m_category = MainCategory::create([
            'main_category_name_en' => $m_c_name_en,
            'main_category_name_hi' => $m_c_name_hi,
            'page_type' => $main_category_is_page,
            'main_category_status' => $m_c_status,
            'main_category_short_description' => $m_c_short_description,
            'meta_title_en' => $meta_title_en,
            'meta_description_en' => $meta_description_en,
            'meta_title_hi' => $meta_title_hi,
            'meta_description_hi' => $meta_description_hi,
            'thumbnail' => $m_c_thumbnail,
            'order_number' => $order_number,
            'slug' => $slug
        ]);

        if($main_category_is_page == 2){
             Page::create(['page_name' => $m_c_name_hi, 'page_language' => 'hi', 'slug' => $slug, 'main_category_id' => $m_category->id]);
             Page::create(['page_name' => $m_c_name_en, 'page_language' => 'en', 'slug' => $slug, 'main_category_id' => $m_category->id]);
        }

        if($m_category){
            return redirect(url()->current())->with('success', 'Category has been added successfully !');
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
        $data = MainCategory::find($id);
        return response()->json([
            "status" => 200,
            "main_cat_detail" => $data
        ]);
        
    } 
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $m_c_id = $request->main_category_id;
        $m_c_name_en = $request->edit_main_category_name_en; 
        $m_c_name_hi = $request->edit_main_category_name_hi;  
        $meta_title_en = $request->edit_meta_title_en; 
        $meta_description_en = $request->edit_meta_description_en;  
        $meta_title_hi = $request->edit_meta_title_hi; 
        $meta_description_hi = $request->edit_meta_description_hi;  
        $m_c_status = $request->edit_main_category_status; 
        $page_type = $request->edit_main_category_page_type;
        $m_c_short_desc = $request->edit_main_category_short_description;
        $order_number = $request->edit_order_number;
        $slug = Str::slug($request->edit_slug);

       

        $m_cat_detail = MainCategory::where('id', $m_c_id)->first();
        if($m_cat_detail->main_category_name_en != $m_c_name_en && $m_cat_detail->main_category_name_hi != $m_c_name_hi){
            $find_m_cat_en = MainCategory::where('main_category_name_en', $m_c_name_en)->first();
            $find_m_cat_hi = MainCategory::where('main_category_name_hi', $m_c_name_hi)->first();
            if($find_m_cat_en && $find_m_cat_hi){
                return redirect()->back()->with('already_exist', 'Main Category already exist !');
            }
        }else if($m_cat_detail->main_category_name_en != $m_c_name_en){
            $find_m_cat_en = MainCategory::where('main_category_name_en', $m_c_name_en)->first();
            if($find_m_cat_en){
                return redirect()->back()->with('english_exist', 'Main Category name in english already exist !');
            }
        }else if($m_cat_detail->main_category_name_hi != $m_c_name_hi){
            $find_m_cat_hi = MainCategory::where('main_category_name_hi', $m_c_name_hi)->first();
            if($find_m_cat_hi){
                return redirect()->back()->with('hindi_exist', 'Main Category name in hindi already exist !');
            }
        }
        $updated_m_category = MainCategory::where('id', $m_c_id)->update([
            'main_category_name_en' => $m_c_name_en,
            'main_category_name_hi' => $m_c_name_hi,
            // 'page_type' => $page_type,
            'main_category_status' => $m_c_status,
            'main_category_short_description' => $m_c_short_desc,
            'meta_title_hi' => $meta_title_hi,
            'meta_description_hi' => $meta_description_hi,
            'meta_title_en' => $meta_title_en,
            'meta_description_en' => $meta_description_en,
            'order_number' => $order_number,
            'slug' => $slug
        ]);
        if($request->hasFile('edit_main_category_thumbnail')){
            $thumbnailImage = $request->file('edit_main_category_thumbnail');
            $thumbnailOriginalName = $thumbnailImage->getClientOriginalName();
            $thumbnailImageName = time().'.'.$thumbnailImage->extension();
            $thumbnailImage->move(public_path('build/assets/upload/main_cat_thumbnail'), $thumbnailImageName);
            MainCategory::where('id', $m_c_id)->update(['thumbnail' => $thumbnailImageName]);
        }
         $main_cat = MainCategory::where('id', $m_c_id)->first();
        if($main_cat->page_type == 2){ 
            Page::where('main_category_id', $m_c_id)->update([
               'slug' =>  $slug
            ]);
        } 
        if($updated_m_category){
            return redirect()->back()->with('update_success', 'Category has been update successfully !');
        }else{
            return redirect()->back()->with('update_failed', 'Something went wrong please try again !');
        } 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $main_cat = MainCategory::where('id', $id)->first();
        $check_post = Post::whereJsonContains('main_category_id', $main_cat->id)->get();
      
        if($check_post->count() !== 0){
            return response()->json([
                'status'=> 400,
                'message'=> 'used_in_post'
            ]);
         }else{

        if($main_cat->page_type == 2){
            try{
                $m_category = MainCategory::findOrFail($id);
                $m_c_delete = $m_category->delete();
                 Page::where('main_category_id', $id)->delete();

                }catch(\Exception $e){  
                    return response()->json([
                        'status'=> 400,
                        'message'=> $e->getMessage()
                    ]);
                }
        }
        else{

        try{
        $m_category = MainCategory::findOrFail($id);
        $m_c_delete = $m_category->delete();
        }catch(\Exception $e){  
            return response()->json([
                'status'=> 400,
                'message'=> $e->getMessage()
            ]);
        }
    }

        if($m_c_delete){
            return response()->json([
                'status'=> 200,
                'message'=> 'Category has been deleted successfully !'
            ]);
            // return redirect()->back()->with('delete_success', 'Main Category has been delete successfully !');
        }else{
            // return redirect()->back()->with('delete_failed', 'Main Something went wrong please try again !');
        } 
    }
    }

    public function updateStatus(Request $request){
        $m_c_status = $request->m_c_status;
        $m_c_id = $request->m_c_id; 
        $m_c_status_update = MainCategory::where('id', $m_c_id)->update(['main_category_status' => $m_c_status]);
        return response()->json([
            'status' => 200,
            'message' => 'status_updated'
        ]);
    }

    public function checkEditSlug(Request $request){
        $id = $request->id;
        $slug = Str::slug($request->slug);
        $page_type = $request->page_type;
        if($page_type == 2){
            $page_ids = Page::where('main_category_id', $id)->pluck('id')->toArray();
            $check_slug = Page::where('slug', $slug)->whereNotIn('id', $page_ids)->get();
            if(count($check_slug) != 0){
                return response()->json([
                    'status' => 400,
                    'message' => 'slug_exist',
                    'table'=> 'page'
                ]);
            }else{
                return response()->json([
                    'status' => 200,
                    'message' => 'slug_not_exist',
                    'table'=> 'page' 
                ]);
            }
        }else{
            $check_slug = MainCategory::where('id', '!=', $id)->where('slug', $slug)->first();
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

    public function checkCreateSlug(Request $request){
        $slug = Str::slug($request->slug);   
            $check_slug = MainCategory::where('slug', $slug)->first();
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
