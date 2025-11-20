<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\backend\MainCategory;
use Illuminate\Http\Request;
use App\Models\backend\Category;
use App\Models\backend\Post;
use App\Models\backend\SubCategory;
use Illuminate\Support\Str;

class CategoryController extends Controller
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

        $c_list = Category::select('*');
        if(isset($_GET['search']) && $_GET['search'] != ''){
            $c_list = $c_list->where('category_name_en', 'LIKE', '%'.$_GET['search'].'%');
        }
        $c_list = $c_list->with('mainCategory')->orderBy('id', 'desc')->paginate($qty);

        $m_c_list = MainCategory::where('main_category_status', 1)->orderBy('id', 'desc')->get();
        return view('backend.category.index', compact('c_list', 'm_c_list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function store(Request $request)
    { 
        $c_name_en = $request->category_name_en;
        $c_name_hi = $request->category_name_hi;
        $m_c_id = $request->main_category_id;
        $c_status = $request->category_status;
        $c_thumbnail = '';
        $c_short_description_en = $request->category_short_description_en;
        $c_short_description_hi = $request->category_short_description_hi;

        $meta_title_en = $request->meta_title_en;
        $meta_description_en = $request->meta_description_en;

        $meta_title_hi = $request->meta_title_hi;
        $meta_description_hi = $request->meta_description_hi;
        $slug = Str::slug($request->create_slug);
        
        $find_cat_en = Category::where('category_name_en', $c_name_en)->first();
        $find_cat_hi = Category::where('category_name_hi', $c_name_hi)->first();
       
        if($find_cat_en && $find_cat_hi){
            return redirect(url()->current())->with('already_exist', 'Category already exist !');
        }else if($find_cat_hi){
            return redirect(url()->current())->with('hindi_exist', 'Category name in hindi already exist !');
        }else if($find_cat_en){
            return redirect(url()->current())->with('english_exist', 'Category name in english already exist !');
        }

        if($request->hasFile('category_thumbnail')){
            $thumbnailFile = $request->file('category_thumbnail');
            $originalThumbnailName = $thumbnailFile->getClientOriginalName();
            $thumbnail_name = time().'.'.$thumbnailFile->extension();
            $thumbnailFile->move(public_path('build/assets/upload/category_thumbnail'), $thumbnail_name);
            $c_thumbnail = $thumbnail_name;
        } 

        try{
        $category = Category::create([
            'main_category_id' => $m_c_id,
            'category_name_en' => $c_name_en,
            'category_name_hi' => $c_name_hi,
            'category_short_description_en' => $c_short_description_en,
            'category_short_description_hi' => $c_short_description_hi,
            'category_thumbnail' => $c_thumbnail,
            'meta_title_en' => $meta_title_en,
            'meta_description_en' => $meta_description_en, 
            'meta_title_hi' => $meta_title_hi,
            'meta_description_hi' => $meta_description_hi,
            'category_status' => $c_status,
            'slug' => $slug

        ]);
    }catch(\Exception $e){
        return redirect(url()->current())->with('error', 'Something Went Wrong');
    }
        if($category){
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
        $data = Category::with('mainCategory')->find($id);
        return response()->json([
            "status" => 200,
            "cat_detail" => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $c_id = $request->category_id;
        $m_c_id = $request->edit_main_category_id;
        $c_name_en = $request->edit_category_name_en;
        $c_name_hi = $request->edit_category_name_hi;
        $c_status = $request->edit_category_status;
        $c_short_desc_en = $request->edit_category_short_description_en;
        $c_short_desc_hi = $request->edit_category_short_description_hi; 
        $meta_title_en = $request->edit_meta_title_en; 
        $meta_description_en = $request->edit_meta_description_en;  
        $meta_title_hi = $request->edit_meta_title_hi; 
        $meta_description_hi = $request->edit_meta_description_hi;  
        $slug = Str::slug($request->edit_slug);
        $cat_detail = Category::where('id', $c_id)->first();

        // commented for when we dont have slug option (start)
        // if($cat_detail->category_name_en != $c_name_en && $cat_detail->category_name_hi != $c_name_hi){
        //     $find_cat_en = Category::where('category_name_en', $c_name_en)->first();
        //     $find_cat_hi = Category::where('category_name_hi', $c_name_hi)->first();
        //     if($find_cat_en && $find_cat_hi){
        //         return redirect()->back()->with('already_exist', 'Category already exist !');
        //     }
        // }else if($cat_detail->category_name_en != $c_name_en){
        //     $find_cat_en = Category::where('category_name_en', $c_name_en)->first();
        //     if($find_cat_en){
        //         return redirect()->back()->with('english_exist', 'Category name in english already exist !');
        //     }
        // }else if($cat_detail->category_name_hi != $c_name_hi){
        //     $find_cat_hi = Category::where('category_name_hi', $c_name_hi)->first();
        //     if($find_cat_hi){
        //         return redirect()->back()->with('hindi_exist', 'Category name in hindi already exist !');
        //     }
        // }
        // commented for when we dont have slug option (end)



        $updated_category = Category::where('id', $c_id)->update([
            'category_name_en' => $c_name_en,
            'category_name_hi' => $c_name_hi,
            'main_category_id' => $m_c_id,
            'category_short_description_en' => $c_short_desc_en,
            'category_short_description_hi' => $c_short_desc_hi, 
            'meta_title_en' => $meta_title_en,
            'meta_description_en' => $meta_description_en, 
            'meta_title_hi' => $meta_title_hi,
            'meta_description_hi' => $meta_description_hi, 
            'category_status' => $c_status,
            'slug' => $slug
        ]);

        if($request->hasFile('edit_category_thumbnail')){
            $thumbnailImage = $request->file('edit_category_thumbnail');
            $thumbnailOriginalName = $thumbnailImage->getClientOriginalName();
            $thumbnailImageName = time().'.'.$thumbnailImage->extension();
            $thumbnailImage->move(public_path('build/assets/upload/category_thumbnail'), $thumbnailImageName);
            Category::where('id', $c_id)->update(['category_thumbnail' => $thumbnailImageName]);
        }
        
        if($updated_category){
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
        $category = Category::findOrFail($id);

        $check_post = Post::whereJsonContains('category_id', $category->id)->get();
        $check_m_cat = SubCategory::where('category_id', $id)->get();
        

        if($check_post->count() !== 0 && $check_m_cat->count() !== 0){
             return response()->json([
                'status' => 400,
                'message' => 'delete_failed',
                'error' => 'Category is used in post and sub category !'
            ]);
        }else if($check_post->count() !== 0){
            return response()->json([
                'status' => 400,
                'message' => 'delete_failed',
                'error' => 'Category is used in post !'
            ]);
         }else if($check_m_cat->count() !== 0){
            return response()->json([
                'status' => 400,
                'message' => 'delete_failed',
                'error' => 'Category is used in sub category !'
            ]);
         }else{
   
        $c_delete = $category->delete();

        if($c_delete){
            return redirect()->back()->with('delete_success', 'Category has been delete successfully !');
        }else{
            return redirect()->back()->with('delete_failed', 'Something went wrong please try again !');
        }
    }
    }

    public function updateStatus(Request $request){
        $c_status = $request->c_status;
        $c_id = $request->c_id; 
        $c_status_update = Category::where('id', $c_id)->update(['category_status' => $c_status]);
        return response()->json([
            'status' => 200,
            'message' => 'status_updated'
        ]);
    }


    public function checkEditSlug(Request $request){
        $id = $request->id;
        $slug = Str::slug($request->slug); 
        
            $check_slug = Category::where('id', '!=', $id)->where('slug', $slug)->first();
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
            $check_slug = Category::where('slug', $slug)->first();
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
