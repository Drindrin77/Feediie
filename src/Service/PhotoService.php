<?php
if(!defined('CONST_INCLUDE'))
	die('Acces direct interdit !'); 

class PhotoService{

    private static $valid_extensions = array("image/png"=>"png" , "image/jpg"=>"jpg" , "image/jpeg"=>"jpeg", "image/gif"=>"gif");
    private static $maxSize = 5 * 1024 * 1024; //5Mo
	
	public function __construct() {
    }	

    public static function validExtension($fileType){
        return array_key_exists($fileType, self::$valid_extensions);
    }

    public static function validSize($fileSize){
        return $fileSize <= self::$maxSize;
    }

    public static function getExtByFileType($fileType){
        return self::$valid_extensions[$fileType];
    }

    public static function deletePhoto($fileName){
    }

    public static function getFilenameWithoutExt($fileName){
        return pathinfo($fileName, PATHINFO_FILENAME);
    }

    public static function getExtension($fileName){
        return pathinfo($fileName, PATHINFO_EXTENSION);
    }

    public static function createFilename($directory,$ext){
        do{
            $file = '.'. $directory . uniqid(rand(), false) . '.' . $ext;
        } while(file_exists($file));
        return $file;
    }

    public static function base64ToFile($base64Img, $filename){
        $img = str_replace('data:image/'.self::getExtension($filename).';base64,', '', $base64Img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        return file_put_contents($filename, $data);
    }

    public static function createNewImgDish($tmpName,$fileName){
        $target_file = '.'. PATH_DISH_PHOTO.$fileName;
        return move_uploaded_file($tmpName, $target_file);
    }

}

?>
