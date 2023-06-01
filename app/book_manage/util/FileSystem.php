<?php
namespace app\book_manage\util;

class FileSystem
{
    public function upload($file){
        $savename = \think\facade\Filesystem::disk('public')->putFile( 'topic', $file);
        return $savename;
    }
}