<?php
/**
 * Created by PhpStorm.
 * User: badi
 * Date: 9/24/16
 * Time: 8:29 AM
 */

if (! function_exists('site')) {
    /**
     * Get the current Site for the application.
     * @param null $id
     * @return
     */
    function site($id = null)
    {
        if($id) {
            return \Site::get($id);
        }
        return \Site::current();
    }
}

if (! function_exists('increment_version')) {
    /**
     * Get incremented version number.
     * @param $version
     * @param $inc
     * @return string
     */
    function increment_version($version, $inc = '0.0.1')
    {
        $a = explode('.', $version);
        $b = explode('.', $inc);

        for($i = 0; $i < count($a); $i++) {
            if($a[$i] == 9 || $a[$i] > 9) {
                $d = ($i - 1);
                $a[$d] += 1;
                $a[$i] = 0;
            } else {
                $a[$i] += $b[$i];
            }
        }
        return implode($a, '.');
    }
}

if (! function_exists('get_human_file_size')) {
    /**
     * Get incremented version number.
     * @param $bytes
     * @return string
     */
    function get_human_file_size($bytes)
    {
        if ($bytes >= 1073741824)
        {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        }
        elseif ($bytes >= 1048576)
        {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        }
        elseif ($bytes >= 1024)
        {
            $bytes = number_format($bytes / 1024, 2) . ' kB';
        }
        elseif ($bytes > 1)
        {
            $bytes = $bytes . ' bytes';
        }
        elseif ($bytes == 1)
        {
            $bytes = $bytes . ' byte';
        }
        else
        {
            $bytes = '0 bytes';
        }

        return $bytes;
    }
}