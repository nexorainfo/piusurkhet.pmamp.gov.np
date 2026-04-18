<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Smugglig\StoreSmugglingRequest;
use App\Http\Requests\Smugglig\UpdateSmugglingRequest;
use App\Models\Smuggling;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class SmugglingController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        abort_if(
            Gate::denies('smuggling_access'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        if (auth()->user()->sub_division_id) {
            $smugglings = Smuggling::with('files')->where('sub_division_id', auth()->user()->sub_division_id)->latest()->get();
        } else {
            $smugglings = Smuggling::with('files')->whereNull('sub_division_id')->latest()->get();
        }

        return view('admin.smuggling.index', compact('smugglings'));
    }

    public function create()
    {
        abort_if(
            Gate::denies('smuggling_create'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        return view('admin.smuggling.create');
    }

    public function store(StoreSmugglingRequest $request)
    {
        abort_if(
            Gate::denies('smuggling_access'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        DB::transaction(function () use ($request) {
            $smuggling = Smuggling::create($request->validated() + [
                    'sub_division_id' => auth()->user()->sub_division_id
                ]);

            $this->uploadFiles($request, $smuggling);
        });

        toast('Smuggling Added Successfully', 'success');

        return back();
    }

    public function show(Smuggling $smuggling)
    {
        abort_if(
            Gate::denies('smuggling_show'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        $smuggling->load('files');

        return view('admin.smuggling.show', compact('smuggling'));
    }

    public function edit(Smuggling $smuggling)
    {
        abort_if(
            Gate::denies('smuggling_edit'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        return view('admin.smuggling.edit', compact('smuggling'));
    }

    public function update(UpdateSmugglingRequest $request, Smuggling $smuggling)
    {
        abort_if(
            Gate::denies('smuggling_edit'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        DB::transaction(function () use ($request, $smuggling) {
            $smuggling->update($request->validated());

            $this->uploadFiles($request, $smuggling);
        });

        toast('Smuggling Updated Successfully', 'success');

        return redirect(route('admin.smuggling.index'));
    }

    public function destroy(Smuggling $smuggling)
    {
        abort_if(
            Gate::denies('smuggling_delete'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        foreach ($smuggling->files as $file) {
            if ($file->url) {
                $this->deleteFile($file->url);
            }
        }
        $smuggling->delete();

        toast('Smuggling Deleted Successfully', 'success');

        return back();
    }

    public function uploadFiles($request, $smuggling)
    {
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $file_name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
                $smuggling->files()->create([
                    'original_name' => $file_name,
                    'extension' => $extension,
                    'url' => $file->store(
                        Str::slug($smuggling->title, "_")
                        , 'public'
                    ),
                ]);
            }
        }
    }
}
