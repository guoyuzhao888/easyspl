<?php
/**
 * User: 郭玉朝
 * CreateTime: 2018/3/10 下午11:09
 * Description:
 */
namespace EasySpl\EasyTrait;
use EasySpl\BaseClass\BaseFilterIterator;
trait FileIteratorTrait
{
    protected $myFilesystemIterator;
    protected $myRecursiveDirectoryIterator;
    protected $myBaseFilterIterator;
    protected static $dirPath;

    public function __construct(string $path)
    {
        self::$dirPath = $path;
        $this->myFilesystemIterator = new \FilesystemIterator($path);
        $this->myRecursiveDirectoryIterator = new \RecursiveDirectoryIterator($path);
        $this->myBaseFilterIterator = new BaseFilterIterator(new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path)));
    }
}