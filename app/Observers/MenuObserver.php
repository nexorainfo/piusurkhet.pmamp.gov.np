<?php

namespace App\Observers;

use App\Models\Menu;

class MenuObserver
{

    public function creating(Menu $menu)
    {
        if (is_null($menu->position)) {
            if (is_null($menu->menu_id)) {
                $menu->position = Menu::whereNull('menu_id')->max('position') + 1;
            } else {
                $menu->position = Menu::where('menu_id', $menu->menu_id)->max('position') + 1;
            }
            return;
        }

        if (is_null($menu->menu_id)) {
            $lowerPriorityMenus = Menu::whereNull('menu_id')
                ->where('position', '>=', $menu->position)
                ->get();
        } else {
            $lowerPriorityMenus = Menu::where('menu_id', $menu->menu_id)
                ->where('position', '>=', $menu->position)
                ->get();
        };

        foreach ($lowerPriorityMenus as $lowerPriorityMenu) {
            $lowerPriorityMenu->position++;
            $lowerPriorityMenu->saveQuietly();
        }
    }

    public function updating(Menu $menu)
    {
        if ($menu->isClean('position')) {
            return;
        }

        if (is_null($menu->position)) {
            if (is_null($menu->menu_id)) {
                $menu->position = Menu::whereNull('menu_id')->max('position');
            } else {
                $menu->position = Menu::where('menu_id', $menu->menu_id)->max('position');
            }
        }

        if ($menu->getOriginal('position') > $menu->position) {
            $positionRange = [
                $menu->position, $menu->getOriginal('position')
            ];
        } else {
            $positionRange = [
                $menu->getOriginal('position'), $menu->position
            ];
        }

        if (is_null($menu->menu_id)) {
            $lowerPriorityMenus = Menu::whereNull('menu_id')
                ->whereBetween('position', $positionRange)
                ->where('id', '!=', $menu->id)
                ->get();
        } else {
            $lowerPriorityMenus = Menu::where('menu_id', $menu->menu_id)
                ->whereBetween('position', $positionRange)
                ->where('id', '!=', $menu->id)
                ->get();
        }


        foreach ($lowerPriorityMenus as $lowerPriorityMenu) {
            if ($menu->getOriginal('position') < $menu->position) {
                $lowerPriorityMenu->position--;
            } else {
                $lowerPriorityMenu->position++;
            }
            $lowerPriorityMenu->saveQuietly();
        }
    }

    public function deleting(Menu $menu)
    {
        if (is_null($menu->menu_id)) {
            $lowerPriorityMenus = Menu::whereNull('menu_id')
                ->where('position', '>', $menu->position)
                ->get();
        } else {
            $lowerPriorityMenus = Menu::where('menu_id', $menu->menu_id)
                ->where('position', '>', $menu->position)
                ->get();
        }

        foreach ($lowerPriorityMenus as $lowerPriorityMenu) {
            $lowerPriorityMenu->position--;
            $lowerPriorityMenu->saveQuietly();
        }
    }
}
