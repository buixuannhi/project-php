<?php
// Class status
if (!function_exists('statusClass')) {
    function statusClass($status)
    {
        switch ($status) {
            case 0:
                return 'form-control bg-secondary';
                break;
            case 1:
                return 'form-control bg-success';
                break;
            case 2:
                return 'form-control bg-danger';
                break;
        }
    }
}

// Alert insert success
if (!function_exists('alertInsert')) {
    function alertInsert($result, $route)
    {
        if ($result) {
            $message = 'Insert record successfully !';
            return redirect()->route($route)->with('success', $message);
        } else {
            $message = 'Insert record failed !';
            return redirect()->back()->with('error', $message);
        }
    }
}

// Alert update success
if (!function_exists('alertUpdate')) {
    function alertUpdate($result, $route)
    {
        if ($result) {
            $message = 'Update record successfully !';
            return redirect()->route($route)->with('success', $message);
        } else {
            $message = 'Update record failed !';
            return redirect()->back()->with('error', $message);
        }
    }
}

// Alert delete success
if (!function_exists('alertDelete')) {
    function alertDelete($result, $route)
    {
        if ($result) {
            $message = 'Delete record successfully !';
            return redirect()->route($route)->with('success', $message);
        } else {
            $message = 'Delete record failed !';
            return redirect()->back()->with('error', $message);
        }
    }
}

// Alert move to trash success
if (!function_exists('alertTrash')) {
    function alertTrash($result, $route)
    {
        if ($result) {
            $message = 'The record has been moved to the trash successfully!';
            return redirect()->route($route)->with('success', $message);
        } else {
            $message = 'Can\'t move record to trash !';
            return redirect()->back()->with('error', $message);
        }
    }
}

// Money format
if (!function_exists('moneyFormat')) {
    function moneyFormat($money)
    {
        return number_format($money, 2, ',');
    }
}

// Count total item
if (!function_exists('countTotalItem')) {
    function countTotalItem($model)
    {
        $model::all()->count();
    }
}
