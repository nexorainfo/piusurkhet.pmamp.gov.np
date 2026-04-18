<?php

namespace App\Helpers;

use App\Models\Menu;

class Helpers
{
    public static function getFrontUrl(Menu $menu, ?string $language = 'ne'): string
    {
        // Check if the menu has submenus, return "#"
        if ($menu->menus_count > 0) {
            return "#";
        }

        // If the menu contains a direct URL, return it
        if (!empty($menu->url)) {
            return $menu->url;
        }

        // Check if the model and slug exist, and return route based on type
        if (!empty($menu->model) && !empty($menu->model->slug)) {
            return match ($menu->type) {
                'category' => route('documentCategory', [$menu->model->slug, 'language' => $language]),
                'subDivision' => route('subDivision', [$menu->model->slug, 'language' => $language]),
                default => route('officeDetail', [$menu->model->slug, 'language' => $language]),
            };
        }

        // Handle subordinate type with a fallback URL
        if ($menu->type == 'subordinate') {
            return $menu->model?->url ?? '#'; // Provide a default URL or appropriate fallback string
        }

        // Handle static page routes or fallback to default slug
        $slug = !empty($menu->slug) ? $menu->slug : 'default-slug';
        return route('static', [$slug, 'language' => $language]);
    }

    // Helper function to repeat characters
    public function repeatCharacter($times, $character = "-")
    {
        return str_repeat($character, $times);
    }
}
