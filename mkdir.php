<?php

$oldmask = umask(0);
if (!(is_dir("dist/runtime"))) {
    mkdir("dist/runtime",0777,true);
}
if (!(is_dir("dist/web/assets"))) {
    mkdir("dist/web/assets",0777,true);
}
umask($oldmask);


