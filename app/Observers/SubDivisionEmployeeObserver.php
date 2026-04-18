<?php

namespace App\Observers;

use App\Models\SubDivision\SubDivisionEmployee;

class SubDivisionEmployeeObserver
{

    public function creating(SubDivisionEmployee $employee)
    {
        if ($employee->is_chief == 1) {
            $this->checkChief($employee);
        }

        if (is_null($employee->position)) {
            $employee->position = SubDivisionEmployee::where('sub_division_id', auth()->user()->sub_division_id)->max('position') + 1;
            return;
        }

        $lowerPriorityEmployees = SubDivisionEmployee::where('sub_division_id', auth()->user()->sub_division_id)
            ->where('position', '>=', $employee->position)
            ->get();

        foreach ($lowerPriorityEmployees as $lowerPriorityEmployee) {
            $lowerPriorityEmployee->position++;
            $lowerPriorityEmployee->saveQuietly();
        }
    }

    public function updating(SubDivisionEmployee $employee)
    {
        if ($employee->is_chief == 1) {
            $this->checkChief($employee);
        }

        if (is_null($employee->position)) {
            $employee->position = SubDivisionEmployee::where('sub_division_id', auth()->user()->sub_division_id)->max('position');
        }

        if ($employee->getOriginal('position') > $employee->position) {
            $positionRange = [
                $employee->position, $employee->getOriginal('position')
            ];
        } else {
            $positionRange = [
                $employee->getOriginal('position'), $employee->position
            ];
        }

        $lowerPriorityEmployees = SubDivisionEmployee::where('sub_division_id', auth()->user()->sub_division_id)
            ->whereBetween('position', $positionRange)
            ->where('id', '!=', $employee->id)
            ->get();

        foreach ($lowerPriorityEmployees as $lowerPriorityEmployee) {
            if ($employee->getOriginal('position') < $employee->position) {
                $lowerPriorityEmployee->position--;
            } else {
                $lowerPriorityEmployee->position++;
            }
            $lowerPriorityEmployee->saveQuietly();
        }

    }

    public function deleting(SubDivisionEmployee $employee)
    {
        $lowerPriorityEmployees = SubDivisionEmployee::where('sub_division_id', auth()->user()->sub_division_id)->where('position', '>', $employee->position)
            ->get();

        foreach ($lowerPriorityEmployees as $lowerPriorityEmployee) {
            $lowerPriorityEmployee->position--;
            $lowerPriorityEmployee->saveQuietly();
        }
    }

    protected function checkChief(SubDivisionEmployee $employee): void
    {
        $emp = SubDivisionEmployee::where('sub_division_id', auth()->user()->sub_division_id)
            ->where('id', '!=', $employee->id)
            ->where('is_chief', 1);
        if ($emp->count() > 0) {
            foreach ($emp->get() as $changeEmp) {
                $changeEmp->is_chief = 0;
                $changeEmp->saveQuietly();
            }

        }
    }
}
