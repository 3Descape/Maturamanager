<?php

namespace App\Http\Traits;

trait SlugTrait{
    public function generateUniqueSlug($text, array $slugs, $seperator = "-")
    {
        if($text){
            $slug = str_slug($text, $seperator);

            if(! in_array($slug, $slugs)){
                return $slug;
            }else{
                while(in_array($slug, $slugs)){
                    $slug = $slug . $seperator . $this->generateRandomString();
                }
                return $slug;
            }
        }else{
            $random = $this->generateRandomString(15);
            while(in_array($random, $slugs)){
                $random = $this->generateRandomString(15);
            }

            return $random;
        }
        throw new Exception('Was not able to generate a unique slug.');
    }

    function generateRandomString($length = 5) {
        return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
    }
}
