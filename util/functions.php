<?php

function html_output($text)
{
    echo htmlentities($text);
}

function getRandomFileName($ext = null)
{
    $timestamp = intval(microtime(true) * 1000);
    $rand = str_pad(rand(0, 1000), 4, 0, STR_PAD_LEFT);
    $result = $timestamp . $rand;
    if (!is_null($ext)) {
        $result .= '.' . $ext;
    }
    return $result;
}

function getImagesDir()
{
    return dirname(__FILE__) . "/../images";
}

function getImageUrl($fileName)
{
    return '/images/' . $fileName;
}

/**
 * @param $url
 * @return bool
 */
function removeBagImage($url)
{
    $dir = getImagesDir();
    $fileName = basename($url);
    $file = $dir . "/" . $fileName;
    return file_exists($file) && unlink($file);
}

