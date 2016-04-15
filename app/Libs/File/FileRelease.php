<?php
/**
 * Created by PhpStorm.
 * User: JR Tech
 * Date: 4/13/2016
 * Time: 2:32 PM
 */

namespace App\Libs\File;


use App\DB\Providers\SQL\Models\ReleasedFile;
use App\Libs\Helpers\Helper;
use App\Repositories\Repositories\Sql\ReleasedFilesRepository;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\File\File;

class FileRelease
{
    private $filePath = null;
    private $file = null;
    private $log = true;
    private $releasedFiles = null;
    public function __construct($filePath)
    {
        $this->setFilePath($filePath);
        $this->setFile(new File($this->getCompleteFilePath()));
        $this->releasedFiles = new ReleasedFilesRepository();
    }

    public function getCompleteFilePath()
    {
        return storage_path('app/').$this->getFilePath();
    }

    public function release($minutes = null)
    {
        /* releasing file */
        $secureName = $this->secureName();
        $releasePath = $this->getReleasedFilesPath().$secureName;
        $this->copyTo($releasePath);

        /* log it in db */
        $deadline = ($minutes != null)?Carbon::createFromFormat('Y-m-d h:i:s', date('Y-m-d h:i:s'))->addHours(5)->addMinutes($minutes):null;
        $deadline = ($deadline != null)?$deadline:$this->defaultDeadline();
        $releasedFile = $this->map([
            'path' => $secureName,
            'deadline' =>$deadline,
            'updatedAt' => date('Y-m-d h:i:s'),
        ]);

        return ($this->log)?$this->logInDb($releasedFile):$releasedFile;
    }

    public function multiRelease($paths, $minutes = null)
    {
        $releasedFiles = [];
        foreach($paths as $path)
        {
            $releasedFiles[] = (new FileRelease($path))->doNotLog()->release($minutes);
        }
        return $this->multiLogInDb($releasedFiles);
    }

    private function defaultDeadline()
    {
        return Carbon::createFromFormat('Y-m-d h:i:s', date('Y-m-d h:i:s'))->addHours(24);
    }
    public function multiLogInDb(array $files)
    {
        $this->releasedFiles->storeMultiple($files);
        return $this->releasedFiles->getByPaths(Helper::propertyToArray($files, 'path'));
    }

    public function logInDb(ReleasedFile $releasedFile)
    {
        $id = $this->releasedFiles->store($releasedFile);
        $releasedFile->id = $id;
        return $releasedFile;
    }

    public function copyTo($newLocation)
    {
        return copy($this->getCompleteFilePath(), $newLocation);
    }

    public function getReleasedFilesPath()
    {
        return public_path('temp/');
    }

    public function secureName()
    {
        return urlencode(bcrypt($this->getFilePath())).'.'.$this->getFile()->getExtension();
    }

    /**
     * @return null
     */
    public function getFilePath()
    {
        return $this->filePath;
    }

    /**
     * @param $file
     * @return $this
     */
    public function setFilePath($file)
    {
        $this->filePath = $file;
        return $this;
    }


    public function setFile($file)
    {
        $this->file = $file;
        return $this;
    }

    /**
     * @return \Symfony\Component\HttpFoundation\File\File::class $file
     **/
    public function getFile()
    {
        return $this->file;
    }

    public function doNotLog()
    {
        $this->log = false;
        return $this;
    }

    public function mapCollection(array $collection)
    {
        return array_map([$this, 'map'], $collection);
    }


    /**
     * @param array $record
     * @return ReleasedFile
     */
    public function map(array $record)
    {
        $file = new ReleasedFile();
        $file->path = $record['path'];
        $file->deadline = $record['deadline'];
        $file->updatedAt = $record['updatedAt'];
        return $file;
    }

}