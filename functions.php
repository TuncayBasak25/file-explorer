<?php

function removeLastDir($path, $level)
{
    if (is_int($level) && $level > 0) {
        $path = preg_replace('#\/[^/]*$#', '', $path);

        return removeLastDir($path, (int)$level - 1);
    }

    return $path;
}
