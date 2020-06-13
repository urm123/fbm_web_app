<?php

namespace App\Http\Controllers\Admin;

use App\Checklist;
use App\Http\Controllers\Controller;
use App\Repositories\CategoryRepository;
use App\Repositories\ChecklistRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

/**
 * Class ChecklistController
 * @package App\Http\Controllers\Admin
 */
class ChecklistController extends Controller
{

    protected $checklist;

    protected $category;

    /**
     * ChecklistController constructor.
     * @param ChecklistRepository $checklist_repository
     * @param CategoryRepository $category_repository
     */
    public function __construct(ChecklistRepository $checklist_repository, CategoryRepository $category_repository)
    {
        $this->checklist = $checklist_repository;
        $this->category = $category_repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $checklists = $this->checklist->getChecklists();

        foreach ($checklists as $checklist) {
            $checklist->category = $checklist->category()->first();
        }

        return view('page.admin.checklist.index', ['checklists' => $checklists]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->category->getCategories();
        return view('page.admin.checklist.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            'category.required' => 'The class is required',
            'title.required' => 'The checklist title is required'
        ];
        $this->validate($request, [
            'category' => 'required',
            'title' => 'required'
        ], $messages);

        $category = $request->category;

        $titles = $request->title;

        $items = $request->checklist_item;

        foreach ($titles as $key => $title) {
            $checklist = $this->checklist->createChecklist($category, $title, $key);

            foreach ($items[$key] as $item_key => $item) {
                $checklist_item = $this->checklist->createChecklistItem($checklist->id, $item, $item_key);
            }
        }

        if ($checklist && $checklist_item) {
            return redirect(route('admin.checklist.index'))->with(['success' => 'Saved successfully']);
        } else {
            return redirect(route('admin.checklist.create'))->withErrors(['Save Failed']);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Checklist $checklist
     * @return \Illuminate\Http\Response
     */
    public function show(Checklist $checklist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Checklist $checklist
     * @return \Illuminate\Http\Response
     */
    public function edit(Checklist $checklist)
    {
        $checklist->category = $checklist->category()->first();
        $checklist->items = $checklist->checklistItems()->get();
        $categories = $this->category->getCategories();
        return view('page.admin.checklist.edit', ['checklist' => $checklist, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Checklist $checklist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Checklist $checklist)
    {
        $messages = [
            'category.required' => 'The class is required',
            'title.required' => 'The checklist title is required'
        ];
        $this->validate($request, [
            'category' => 'required',
            'title' => 'required',
        ], $messages);

        $checklist_update = $checklist->update([
            'category_id' => $request->category,
            'title' => $request->title
        ]);

        $checklist_items = $request->checklist_item;

        $old_checklist_items = $checklist->checklistItems()->get();

        foreach ($old_checklist_items as $old_checklist_item) {
            $old_checklist_item->deleted_at = Carbon::now()->toDateTimeString();
        }

        foreach ($checklist_items as $key => $checklist_item) {
            foreach ($old_checklist_items as $old_checklist_item) {
                if ($key == $old_checklist_item->id) {
                    $old_checklist_item->deleted_at = null;
                    if ($checklist_item != null) {
                        $old_checklist_item->update([
                            'name' => $checklist_item
                        ]);
                    }
                }
            }
            if (strpos($key, 'new_') > -1) {
                $checklist->checklistItems()->create([
                    'checklist_id' => $checklist->id,
                    'name' => $checklist_item,
                ]);
            }
        }

        foreach ($old_checklist_items as $old_checklist_item) {
            if ($old_checklist_item->deleted_at) {
                $old_checklist_item->delete();
            }
        }

        if ($checklist_update) {
            return redirect(route('admin.checklist.index'))->with(['success' => 'Updated successfully']);
        } else {
            return redirect(route('admin.checklist.create'))->withErrors(['Update Failed']);
        }
    }

    /**
     * @param Checklist $checklist
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Checklist $checklist)
    {
        $delete = $checklist->delete();
        if ($delete) {
            return response()->json(['success' => 'Deleted Successfully']);
        } else {
            return response()->json(['failed' => 'Delete Failed']);
        }
    }
}
