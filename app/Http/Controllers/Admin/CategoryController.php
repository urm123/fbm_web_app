<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Repositories\CategoryRepository;
use App\Repositories\ChecklistRepository;
use Illuminate\Http\Request;
use Session;

/**
 * Class CategoryController
 * @package App\Http\Controllers\Admin
 */
class CategoryController extends Controller
{

    protected $category;

    protected $checklist;

    /**
     * CategoryController constructor.
     * @param CategoryRepository $category_repository
     * @param ChecklistRepository $checklsit_repository
     */
    public function __construct(CategoryRepository $category_repository, ChecklistRepository $checklsit_repository)
    {
        $this->category = $category_repository;
        $this->checklist = $checklsit_repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->category->getCategories();
        $breadcrumb = "<a href='/'>Home</a> / <a href='/admin/administrators'>Admin</a> / <a href='/admin/clients'>Clients</a> / <a href='/admin/category'>Classes</a>";  
        return view('page.admin.category.index', ['categories' => $categories, 'breadcrumb' => $breadcrumb]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $breadcrumb = "<a href='/'>Home</a> / <a href='/admin/administrators'>Admin</a> / <a href='/admin/clients'>Clients</a> / <a href='/admin/category'>Classes</a> / <a href='/admin/category/create'>Add Class</a>";  
        return view('page.admin.category.create', ['breadcrumb' => $breadcrumb]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required']); 
        $getCategory = $this->category->getCategory($request->name);
 
        if (is_null($getCategory)){
            $category = $this->category->createCategory($request->all()); 
            if ($category) {
                return redirect(route('admin.category.index'))->with(['success' => 'Saved successfully']);
            } else {
                return redirect(route('admin.category.create'))->withErrors(['Save Failed']);
            }
        }else{
            Session::flash('classExhist', 'Class Exists.'); 
            return redirect(route('admin.category.create'))->withErrors(['Class Exists.']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Category $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Category $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $category->checklists = $category->checklist()->get(); 
        foreach ($category->checklists as $checklist) {
            $checklist->items = $checklist->checklistItems()->get();
        }
        $breadcrumb = "<a href='/'>Home</a> / <a href='/admin/administrators'>Admin</a> / <a href='/admin/clients'>Clients</a> / <a href='/admin/category'>Classes</a> / <a href='/admin/category/".$category->id."/edit'>Edit Class</a>";  

        return view('page.admin.category.edit', ['category' => $category, 'breadcrumb' => $breadcrumb]);
    } 
    
    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Category $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $this->validate($request, ['name' => 'required', 'title' => 'required']);
        $update = $category->update(['name' => $request->name]);

        $titles = $request->title;

        $items = $request->checklist_item;
        $item_days = $request->checklist_item_days;

        foreach ($category->checklist as $checklist) {
            $checklist->checklistItems()->delete();
        }

        $category->checklist()->delete();

        foreach ($titles as $key => $title) {
            $checklist = $this->checklist->createChecklist($category->id, $title, $key);

            foreach ($items[$key] as $item_key => $item) {
                $checklist_item = $this->checklist->createChecklistItem($checklist->id, $item, $item_key);

                if (isset($item_days[$key][$item_key])) {
                    foreach ($item_days[$key][$item_key] as $item_day_key => $item_day) {
                        $checklist_item->update([
                            $item_day_key => true,
                        ]);
                    }
                }
            }
        }

        if ($update) {
            return redirect(route('admin.category.index'))->with(['success' => 'Saved successfully']);
        } else {
            return redirect(route('admin.category.edit'))->withErrors(['Save Failed']);
        }
    }

    /**
     *
     * Remove the specified resource from storage.
     * @param \App\Category $category
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Category $category)
    {
        $delete = $category->delete();
        if ($delete) {
            return response()->json(['success' => 'Deleted Successfully']);
        } else {
            return response()->json(['failed' => 'Delete Failed']);
        }
    }
}
