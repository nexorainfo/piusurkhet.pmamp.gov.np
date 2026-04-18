<?php

namespace App\Observers;

use App\Models\OfficeSettingHeader;

class OfficeSettingHeaderObserver
{
    public function creating(OfficeSettingHeader $officeSettingHeader)
    {
        if (is_null($officeSettingHeader->position)) {
            $officeSettingHeader->position = OfficeSettingHeader::max('position') + 1;
            return;
        }

        $lowerPriorityHeaders = OfficeSettingHeader::where('position', '>=', $officeSettingHeader->position)
            ->get();

        foreach ($lowerPriorityHeaders as $lowerPriorityHeader) {
            $lowerPriorityHeader->position++;
            $lowerPriorityHeader->saveQuietly();
        }
    }

    public function updating(OfficeSettingHeader $officeSettingHeader)
    {
        if ($officeSettingHeader->isClean('position')) {
            return;
        }

        if (is_null($officeSettingHeader->position)) {
            $officeSettingHeader->position = OfficeSettingHeader::max('position');
        }

        if ($officeSettingHeader->getOriginal('position') > $officeSettingHeader->position) {
            $positionRange = [
                $officeSettingHeader->position, $officeSettingHeader->getOriginal('position')
            ];
        } else {
            $positionRange = [
                $officeSettingHeader->getOriginal('position'), $officeSettingHeader->position
            ];
        }

        $lowerPriorityHeaders = OfficeSettingHeader::whereBetween('position', $positionRange)
            ->where('id', '!=', $officeSettingHeader->id)
            ->get();

        foreach ($lowerPriorityHeaders as $lowerPriorityHeader) {
            if ($officeSettingHeader->getOriginal('position') < $officeSettingHeader->position) {
                $lowerPriorityHeader->position--;
            } else {
                $lowerPriorityHeader->position++;
            }
            $lowerPriorityHeader->saveQuietly();
        }
    }

    public function deleting(OfficeSettingHeader $officeSettingHeader)
    {
        $lowerPriorityHeaders = OfficeSettingHeader::where('position', '>', $officeSettingHeader->position)
            ->get();

        foreach ($lowerPriorityHeaders as $lowerPriorityHeader) {
            $lowerPriorityHeader->position--;
            $lowerPriorityHeader->saveQuietly();
        }
    }

}
