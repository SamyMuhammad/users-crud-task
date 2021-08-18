<?php

if(!function_exists('setOpenClass')){
    /**
     * Set open class for sidebar list items.
     */
    function setOpenClass($route)
    {
        if (is_array($route)) {
            $routeName = $route[0];
            $routeArg = $route[1];

            return request()->url() === route($routeName, $routeArg) ? 'menu-is-opening menu-open' : '';
        }
        return request()->routeIs($route) ? 'menu-is-opening menu-open' : '';
    }
}

if(!function_exists('setActiveClass')){
    /**
     * Set active class for sidebar list items.
     */
    function setActiveClass($route)
    {
        if (is_array($route)) {
            $routeName = $route[0];
            $routeArg = $route[1];

            return request()->url() === route($routeName, $routeArg) ? 'active' : '';
        }
        return request()->routeIs($route) ? 'active' : '';
    }
}

if(!function_exists('getInputValue')){
    /**
     * Get the value for the input field.
     */
    function getInputValue($inputName, $item)
    {
        if (!empty(old($inputName))) {
            return old($inputName);
        } elseif (!empty($item)){
            return $item->$inputName;
        }else{
            return '';
        }
    }
}

/**
 * Get the id to be used in validation rules.
 * @param \Illuminate\Foundation\Http\FormRequest $formRequest
 * @param string $modelName
 */
if (! function_exists('getRouteId')){
    function getRouteId($formRequest, $modelName)
    {
        $id = '';
        if ($formRequest->isMethod('PUT') || $formRequest->isMethod('PATCH')){
            $id = $formRequest->route($modelName)->id;
        }
        return $id;
    }
}