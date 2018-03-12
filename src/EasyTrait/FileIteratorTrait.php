<?php
/**
 * User: 郭玉朝
 * CreateTime: 2018/3/10 下午11:09
 * Description:
 */
namespace EasySpl\EasyTrait;
trait FileIteratorTrait
{
    protected $myFilesystemIterator;
    protected $myRecursiveDirectoryIterator;
    protected $dirPath;

    public function __construct(string $path)
    {
        $this->dirPath = $path;
        $this->myFilesystemIterator = new \FilesystemIterator($path);
        $this->myRecursiveDirectoryIterator = new \RecursiveDirectoryIterator($path);
    }

}