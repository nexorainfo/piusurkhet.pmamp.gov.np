<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Menu\StoreMenuRequest;
use App\Http\Requests\Menu\UpdateMenuRequest;
use App\Models\DocumentCategory;
use App\Models\Menu;
use App\Http\Controllers\Controller;
use App\Models\OfficeDetail;
use App\Models\PedigreeCaste;
use App\Models\PedigreeCategory;
use App\Models\SubDivision\SubDivision;
use App\Models\Subordinate;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class MenuController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        abort_if(
            Gate::denies('menu_access'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

         $menus = Menu::with('model', 'menus.model')->withCount('menus')->whereNull('menu_id')->orderBy('position')->get();

        return view('admin.menu.index', compact('menus'));
    }

    public function create()
    {
        abort_if(
            Gate::denies('menu_create'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        $mainMenus = Menu::with('menus')->whereNull('menu_id')->get();

        return view('admin.menu.create', compact('mainMenus'));
    }

    public function store(StoreMenuRequest $request)
    {
        abort_if(
            Gate::denies('menu_create'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        Menu::create($request->validated() + $this->checkMenuType($request));

        toast('Menu Added Successfully', 'success');

        return back();
    }

    public function show(Menu $menu)
    {
        abort_if(
            Gate::denies('menu_show'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );
    }

    public function edit(Menu $menu)
    {
        abort_if(
            Gate::denies('menu_edit'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        $mainMenus = Menu::with('menus')->whereNull('menu_id')->get();

        return view('admin.menu.edit', compact('mainMenus', 'menu'));
    }

    public function update(UpdateMenuRequest $request, Menu $menu)
    {
        abort_if(
            Gate::denies('menu_edit'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        $menu->update($request->validated() + $this->checkMenuType($request));

        toast('Menu Updated Successfully', 'success');

        return redirect(route('admin.menu.index'));
    }

    public function destroy(Menu $menu): RedirectResponse
    {
        abort_if(
            Gate::denies('menu_delete'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        $menu->menus()->delete();
        $menu->delete();

        toast('Menu Deleted Successfully', 'success');

        return back();
    }

    public function updateStatus(Menu $menu): RedirectResponse
    {
        abort_if(
            Gate::denies('menu_edit'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        $menu->update([
            'status' => !$menu->status
        ]);

        toast('Status Updated Successfully', 'success');

        return back();
    }

    public function checkMenuType($request): array
    {
        $menuType = null;
        if ($request->input('menu_type') == "officeDetail") {
            $menuType = OfficeDetail::class;
        } elseif ($request->input('menu_type') == "category") {
            $menuType = DocumentCategory::class;
        } elseif ($request->input('menu_type') == "subDivision") {
            $menuType = SubDivision::class;
        } elseif ($request->input('menu_type') == "subordinate") {
            $menuType = Subordinate::class;

        }

        return [
            'model_type' => $menuType,
            'model_id' => $request->input('model_id') ?? null,
            'type' => $request->input('menu_type') ?? null
        ];
    }
}
