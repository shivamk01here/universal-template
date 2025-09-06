<?php

if (!function_exists('getBackgroundStyle')) {
    /**
     * Generates a background style string from a content object.
     *
     * @param object|null 
     * @return string 
     */
    function getBackgroundStyle(?object $content): string
    {
        if (!$content) {
            return 'background-color: #ffffff;';
        }

        $style = '';
        if (!empty($content->bg_image_url)) {
            $style .= 'background-image: url(\'' . e($content->bg_image_url) . '\'); background-size: cover; background-position: center;';
        } else {
            $style .= 'background-color: ' . e($content->bg_color ?? '#ffffff') . ';';
        }
        return $style;
    }
}