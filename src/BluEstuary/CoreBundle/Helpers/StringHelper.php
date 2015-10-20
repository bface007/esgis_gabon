<?php
/**
 * Created by PhpStorm.
 * User: bface
 * Date: 05/08/2015
 * Time: 19:36
 */

namespace BluEstuary\CoreBundle\Helpers;


class StringHelper {

    /**
     * @var string
     */
    private $content;

    /**
     * @var string
     */
    private $originalContent;

    /**
     * @param null|string $content
     */
    public function __contruct($content = null){
        $this->content = $content;
        $this->originalContent = $content;
    }

    /**
     * @param null|string $content
     * @return self
     */
    public function setContent($content){
        if(null !== $content && false === is_string($content))
            trigger_error("class constructor expected Argument 1 to be a string", E_USER_ERROR);
        $this->originalContent = $content;
        $this->content = $content;

        return $this;
    }

    /**
     * @return string
     */
    public function getContent(){
        return $this->content;
    }

    /**
     * @param $str
     * @param int $startPos
     * @param int $maxLength
     * @param string $excerptText
     * @return string
     */
    private function makeExcerpt($str, $startPos = 0, $maxLength = 100, $excerptText = "..."){
        if(strlen($str) > $maxLength) {
            $excerpt   = substr($str, $startPos, $maxLength-3);
            $lastSpace = strrpos($excerpt, ' ');
            $excerpt   = substr($excerpt, 0, $lastSpace);
            $excerpt  .= $excerptText;
        } else {
            $excerpt = $str;
        }

        return $excerpt;
    }

    /**
     * @param int $startPos
     * @param int $maxLength
     * @param string $excerptText
     * @return self
     */
    public function excerptContent($startPos = 0, $maxLength = 100, $excerptText = "..."){
        $this->content = $this->makeExcerpt($this->content, $startPos, $maxLength, $excerptText);

        return $this->content;
    }

    /**
     * @return self
     */
    public function restore(){
        $this->content = $this->originalContent;

        return $this;
    }

    /**
     * @param int $startPos
     * @param int $maxLength
     * @param string $excerptText
     * @return string
     */
    public function getExcerpt($startPos = 0, $maxLength = 100, $excerptText = "..."){
        return $this->makeExcerpt($this->content, $startPos, $maxLength, $excerptText);
    }

} 