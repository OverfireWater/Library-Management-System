<?php


namespace app\book_manage\util;


class FileSystemService extends \think\Service
{
    public function register(): void
    {
        $this->app->bind('file_system',FileSystem::class);
    }
}