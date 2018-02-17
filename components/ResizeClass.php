<?php

class ResizeClass
{

    private $imageSource;
    private $type;

    private $width;
    private $height;

    private $imageResult;

    ///////const///////

    const WIDTH = 150;
    const HEIGHT = 100;

    const IMAGE_TYPE_DEFAULT = '.jpg';
    //const DIR_SAVE = 'images/';

    ///////const///////


    /**
     * ResizeClass constructor.
     * @param $pathToImage
     * @throws Exception
     */

    public function __construct($pathToImage)
    {
        if (!file_exists($pathToImage)){
            throw new Exception('File not found.');
        }

//        $type = strrchr($pathToImage, '.');
//        $finfo = new finfo(FILEINFO_MIME_TYPE);
//        echo $finfo->file($pathToImage);

        $this->type = $this->getType($pathToImage);

        switch ($this->type){

            case IMAGETYPE_JPEG:
                $img = imagecreatefromjpeg($pathToImage);
                break;

            case IMAGETYPE_GIF:
                $img = imagecreatefromgif($pathToImage);
                break;

            case IMAGETYPE_PNG:
                $img = imagecreatefrompng($pathToImage);
                break;

            case IMAGETYPE_BMP:
                $img = imagecreatefromwbmp($pathToImage);
                break;

            default:
                $img = false;
        }


        $this->imageSource = $img;

        if (!$this->imageSource){
            throw new Exception('Сan\'t create descriptor of file');
        }



        $this->width = imagesx($this->imageSource);
        $this->height = imagesy($this->imageSource);
    }


    /**
     * @param int $newWidth
     * @param int $newHeight
     * @param string $option
     */

    public function resize($newWidth = self::WIDTH, $newHeight = self::HEIGHT, $option = 'width'){

        $arr = $this->getSizes($newWidth, $newHeight, $option);

        $this->imageResult = imagecreatetruecolor(round($arr['width']), round($arr['height']));

        imagecopyresampled($this->imageResult, $this->imageSource, 0, 0, 0, 0,
            round($arr['width']), round($arr['height']), $this->width, $this->height);

        if ($option == 'crop'){

            $w = round($arr['width']);
            $h = round($arr['height']);

            $sx = ($w/2) - ($newWidth/2);
            $sy = ($h/2) - ($newHeight/2);

            $img = imagecreatetruecolor($newWidth, $newHeight);
            imagecopyresampled($img, $this->imageResult, 0, 0, $sx, $sy,
                $newWidth, $newHeight, $newWidth, $newHeight);

            $this->imageResult = $img;
        }

    }


    /**
     * @param bool $pathImage
     * @param int $quality
     */

    public function save($pathImage = false, $quality = 100){

        if (!$pathImage){
            $str = md5(microtime());
            $name = substr($str, 0, 10);
            $ext = self::IMAGE_TYPE_DEFAULT;
            $pathImage = $name . $ext;

        } else {
            $ext = strtolower(strrchr($pathImage, '.'));
        }

        switch ($ext){

            case '.jpg':
                imagejpeg($this->imageResult, $pathImage, $quality);
                break;

            case '.png':
                $quality = round(($quality * 9) / 100);
                $quality = 9 - $quality;
                imagepng($this->imageResult,  $pathImage, $quality);
                break;

            case '.gif':
                imagegif($this->imageResult,  $pathImage);
                break;

            case '.bmp':
                imagewbmp($this->imageResult, $pathImage);
                break;

            imagedestroy($this->imageSource);
            imagedestroy($this->imageResult);

        }


    }



    /**
     * @param $pathToImage
     * @return int
     * @throws Exception
     */

    private function getType($pathToImage){
        if (!function_exists('exif_imagetype')){
            throw new Exception('exif doesn\'t include');
        }
        return exif_imagetype($pathToImage);
    }



    /**
     * @param $newWidth
     * @param $newHeight
     * @param $option
     * @return array
     */

    private function getSizes($newWidth, $newHeight, $option){

        switch ($option){

            case 'width':
                $width = $newWidth;
                $height = $this->getHeight($newWidth);
                break;

            case 'height':
                $width = $this->getWidth($newHeight);
                $height = $newHeight;
                break;

            case 'auto':
                $arr = $this->getAuto($newWidth, $newHeight);
                $width = $arr['w'];
                $height = $arr['h'];
                break;

            case 'crop':
                $arr = $this->getCrop($newWidth, $newHeight);
                $width = $arr['w'];
                $height = $arr['h'];
                break;

            case 'exact':
                $width = $newWidth;
                $height = $newHeight;
                break;
        }

        return array('width' => $width, 'height' => $height);

    }

    /**
     * @param $newWidth
     * @return float|int
     */
    private function getHeight($newWidth){
        $k = $this->height / $this->width;
        return $newWidth * $k;
    }

    /**
     * @param $newHeight
     * @return float|int
     */
    private function getWidth($newHeight){
        $k = $this->width / $this->height;
        return $newHeight * $k;
    }

    /**
     * @param $newWidth
     * @param $newHeight
     * @return array
     */
    private function getAuto($newWidth, $newHeight){

        if ($this->width > $this->height){
            $resWidth = $newWidth;
            $resHeight = $this->getHeight($newWidth);

        } elseif ($this->width < $this->height){
            $resWidth = $this->getWidth($newHeight);
            $resHeight = $newHeight;

        } else {
            $resWidth = $newWidth;
            $resHeight = $newHeight;
        }

        return ['w' => $resWidth, 'h' => $resHeight];

    }

    /**
     * @param $newWidth
     * @param $newHeight
     * @return array
     */

    private function getCrop($newWidth, $newHeight){

        $kw = $this->width / $newWidth;
        $kh = $this->height / $newHeight;

        if ($kw < $kh){
            $res_k = $kw;

        } else {
            $res_k = $kh;
        }

        return ['w' => ($this->width / $res_k), 'h' => ($this->height / $res_k)];
    }










}