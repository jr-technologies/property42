<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 2/25/2016
 * Time: 3:28 PM
 */

namespace App\Traits\Property;

use App\Libs\File\FileRelease;
use App\Libs\Json\Prototypes\Prototypes\Property\PropertyDocumentJsonPrototype;
use App\Libs\Json\Prototypes\Prototypes\Property\PropertyJsonPrototype;
use App\Traits\AppTrait;

trait PropertyFilesReleaser
{
    use AppTrait;

    public function releasePropertiesJsonFiles(array $properties)
    {
        $releasedFiles = [];
        foreach($properties as $property /* @var $property PropertyJsonPrototype */)
        {
            foreach($property->documents as $document /* @var $document PropertyDocumentJsonPrototype */)
            {
                if(file_exists(storage_path($document->path)))
                {
                    $releasedFile = (new FileRelease($document->path))->doNotLog()->release();
                    $document->path = $releasedFile->path;
                    $releasedFiles[] = $releasedFile;
                }
            }
        }
        (new FileRelease())->multiLogInDb($releasedFiles);
        return $properties;
    }
}