<?php

$oldmask = umask(0);
if (!(is_dir("dist/runtime"))) {
    mkdir("dist/runtime");
}
if (!(is_dir("dist/web/assets"))) {
    mkdir("dist/web/assets");
}
umask($oldmask);


