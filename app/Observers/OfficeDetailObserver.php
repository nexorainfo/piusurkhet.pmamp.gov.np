<?php

namespace App\Observers;

use App\Models\Menu;
use App\Models\OfficeDetail;

class OfficeDetailObserver
{

    public function creating(OfficeDetail $officeDetail)
    {
        if (is_null($officeDetail->position)) {
            $officeDetail->position = OfficeDetail::max('position') + 1;
            return;
        }

        $lowerPriorityOfficeDetails = OfficeDetail::where('position', '>=', $officeDetail->position)
            ->get();

        foreach ($lowerPriorityOfficeDetails as $lowerPriorityOfficeDetail) {
            $lowerPriorityOfficeDetail->position++;
            $lowerPriorityOfficeDetail->saveQuietly();
        }
    }

    public function updating(OfficeDetail $officeDetail)
    {
        if ($officeDetail->isClean('position')) {
            return;
        }

        if (is_null($officeDetail->position)) {
            $officeDetail->position = OfficeDetail::max('position');
        }

        if ($officeDetail->getOriginal('position') > $officeDetail->position) {
            $positionRange = [
                $officeDetail->position, $officeDetail->getOriginal('position')
            ];
        } else {
            $positionRange = [
                $officeDetail->getOriginal('position'), $officeDetail->position
            ];
        }

        $lowerPriorityOfficeDetails = OfficeDetail::whereBetween('position', $positionRange)
            ->where('id', '!=', $officeDetail->id)
            ->get();

        foreach ($lowerPriorityOfficeDetails as $lowerPriorityOfficeDetail) {
            if ($officeDetail->getOriginal('position') < $officeDetail->position) {
                $lowerPriorityOfficeDetail->position--;
            } else {
                $lowerPriorityOfficeDetail->position++;
            }
            $lowerPriorityOfficeDetail->saveQuietly();
        }
    }

    public function deleting(OfficeDetail $officeDetail)
    {
        $lowerPriorityOfficeDetails = OfficeDetail::where('position', '>', $officeDetail->position)
            ->get();

        foreach ($lowerPriorityOfficeDetails as $lowerPriorityOfficeDetail) {
            $lowerPriorityOfficeDetail->position--;
            $lowerPriorityOfficeDetail->saveQuietly();
        }
    }
}
