<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 2/25/2016
 * Time: 3:28 PM
 */

namespace App\Traits\Property;

use App\Libs\File\FileRelease;
use App\Libs\Json\Prototypes\Prototypes\Property\Owner\PropertyAgencyJsonPrototype;
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
                $releasedFile = (new FileRelease($document->path))->doNotLog()->release();
                $document->path = $releasedFile->path;
                $releasedFiles[] = $releasedFile;
            }
        }
        (new FileRelease())->multiLogInDb($releasedFiles);
        return $properties;
    }

    public function releasePropertiesOwnerAgencyLogo(array $properties)
    {
        $releasedFiles = [];
        foreach($properties as $property /* @var $property PropertyJsonPrototype */)
        {
            if($property->owner->agency != null)
            {
                if($property->owner->agency->logo != null)
                {
                    $releasedFile = (new FileRelease($property->owner->agency->logo))->doNotLog()->release();
                    $property->owner->agency->logo = $releasedFile->path;
                    $releasedFiles[] = $releasedFile;
                }
            }
        }
        (new FileRelease())->multiLogInDb($releasedFiles);

        return $properties;
    }
}