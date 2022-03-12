<?php
if (!function_exists('showCategories')) {
    function showCategories($categories, $selected_id, $parent_id = 0, $char = 0)
    {
        foreach ($categories as $key => $category) {

            // Check child_category
            if ($category->parent_id == $parent_id) {

                if ($category->id == $selected_id) {
                    echo '<option selected value="' . $category->id . '">' . str_repeat('  |__', $char) . $category->name . '</option>';
                } else {
                    echo '<option value="' . $category->id . '">' . str_repeat('  |__', $char) . $category->name . '</option>';
                }

                // Unset this item
                unset($categories[$key]);

                showCategories($categories, $selected_id, $category->id, $char + 1);
            }
        }
    }
}
