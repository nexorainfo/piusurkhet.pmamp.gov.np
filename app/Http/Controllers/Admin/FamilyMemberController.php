<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FamilyMember\StoreFamilyMemberRequest;
use App\Http\Requests\FamilyMember\UpdateFamilyMemberRequest;
use App\Models\FamilyMember;
use App\Models\Pedigree;
use Illuminate\Http\Request;

class FamilyMemberController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        //
    }

    public function create(Pedigree $pedigree)
    {
        return view('admin.pedigree.familyMember.create', compact('pedigree'));
    }

    public function store(StoreFamilyMemberRequest $request, Pedigree $pedigree)
    {
        $pedigree->load('familyMembers');

        $familyMember = FamilyMember::updateOrCreate([
            'pedigree_id' => $pedigree->id,
            'member' => $request->input('member')
        ], $request->validated());

        toast('Family Member Added Successfully', 'success');
        return redirect()->route('admin.pedigree.show', ['pedigree' => $pedigree->id]);
    }


    public function show(FamilyMember $familyMember)
    {
        //
    }

    public function edit(Pedigree $pedigree,FamilyMember $familyMember)
    {
        return view('admin.pedigree.familyMember.edit', compact('familyMember','pedigree'));
    }


    public function update(UpdateFamilyMemberRequest $request, Pedigree $pedigree,FamilyMember $familyMember)
    {
        $familyMember->update($request->validated());
        toast('Family Member Updated Successfully', 'success');

        return redirect()->route('admin.pedigree.show', ['pedigree' => $pedigree->id]);
    }




    public function destroy(FamilyMember $familyMember)
    {


    }
}
