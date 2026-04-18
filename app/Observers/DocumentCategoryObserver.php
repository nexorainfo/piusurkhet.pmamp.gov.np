<?php

namespace App\Observers;

use App\Models\DocumentCategory;

class DocumentCategoryObserver
{

    public function creating(DocumentCategory $documentCategory)
    {
        if (is_null($documentCategory->position)) {
            if (is_null($documentCategory->document_category_id)) {
                $documentCategory->position = DocumentCategory::whereNull('document_category_id')->max('position') + 1;
            } else {
                $documentCategory->position = DocumentCategory::where('document_category_id', $documentCategory->document_category_id)->max('position') + 1;
            }
            return;
        }

        if (is_null($documentCategory->document_category_id)) {
            $lowerPriorityCategories = DocumentCategory::whereNull('document_category_id')->where('position', '>=', $documentCategory->position)
                ->get();
        } else {
            $lowerPriorityCategories = DocumentCategory::where('document_category_id', $documentCategory->document_category_id)->where('position', '>=', $documentCategory->position)
                ->get();
        }


        foreach ($lowerPriorityCategories as $lowerPriorityCategory) {
            $lowerPriorityCategory->position++;
            $lowerPriorityCategory->saveQuietly();
        }
    }

    public function updating(DocumentCategory $documentCategory)
    {
        if ($documentCategory->isClean('position')) {
            return;
        }

        if (is_null($documentCategory->position)) {
            if (is_null($documentCategory->document_category_id)) {
                $documentCategory->position = DocumentCategory::whereNull('document_category_id')->max('position');
            } else {
                $documentCategory->position = DocumentCategory::where('document_category_id', $documentCategory->document_category_id)
                    ->max('position');
            }
        }

        if ($documentCategory->getOriginal('position') > $documentCategory->position) {
            $positionRange = [
                $documentCategory->position, $documentCategory->getOriginal('position')
            ];
        } else {
            $positionRange = [
                $documentCategory->getOriginal('position'), $documentCategory->position
            ];
        }

        if (is_null($documentCategory->document_category_id)) {
            $lowerPriorityCategories = DocumentCategory::whereNull('document_category_id')->whereBetween('position', $positionRange)
                ->where('id', '!=', $documentCategory->id)
                ->get();
        } else {
            $lowerPriorityCategories = DocumentCategory::where('document_category_id', $documentCategory->document_category_id)
                ->whereBetween('position', $positionRange)
                ->where('id', '!=', $documentCategory->id)
                ->get();
        }


        foreach ($lowerPriorityCategories as $lowerPriorityCategory) {
            if ($documentCategory->getOriginal('position') < $documentCategory->position) {
                $lowerPriorityCategory->position--;
            } else {
                $lowerPriorityCategory->position++;
            }
            $lowerPriorityCategory->saveQuietly();
        }
    }

    public function deleting(DocumentCategory $documentCategory)
    {
        if (is_null($documentCategory->document_category_id)) {
            $lowerPriorityCategories = DocumentCategory::whereNull('document_category_id')
                ->where('position', '>', $documentCategory->position)
                ->get();
        } else {
            $lowerPriorityCategories = DocumentCategory::where('document_category_id', $documentCategory->document_category_id)
                ->where('position', '>', $documentCategory->position)
                ->get();
        }

        foreach ($lowerPriorityCategories as $lowerPriorityCategory) {
            $lowerPriorityCategory->position--;
            $lowerPriorityCategory->saveQuietly();
        }
    }
}
