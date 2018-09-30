<?php 
 
namespace App\Service;
 
use Vich\UploaderBundle\Naming\NamerInterface;
use Vich\UploaderBundle\Mapping\PropertyMapping;
use Symfony\Component\Security\Core\Security;
 
class FileNamer implements NamerInterface 
{

    private $security;

    public function __construct(Security $Security)
    {
        $this->security = $Security;
    }


    /**
     * Creates a name for the file being uploaded.
     *
     * @param object          $object  The object the upload is attached to
     * @param PropertyMapping $mapping The mapping to use to manipulate the given object
     *
     * @return string The file name formated userID.extension
     */
    public function name($object, PropertyMapping $mapping): string
    {

        // Get user
        $user = $this->security->getUser();

        // Get id of user
        $userId = $user->getId();

        // Get file being uploaded
        $file = $object->getImageFile();
        
        // Get extension of file being uploaded
        $extension = $file->guessExtension();

        // Get uniqid for change cache
        $uniqid = uniqid();
        
        // Find if previous avatar
        $previousPicture = glob('../public/images/user_avatar/'.$userId.'-*');

        // if true => remove previous avatar (.jpg .png .jpeg)
        if($previousPicture != null)
        {
            foreach ($previousPicture as $key => $value) {
                unlink( $value ) ;
            }
        
        }
        
        // Return new image name with user id , uniqid and extension
        return $userId.'-'.$uniqid.'.'.$extension;

    }

}
