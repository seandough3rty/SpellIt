<?php
namespace AppBundle\Model\Entity;

/**
 * Created by PhpStorm.
 * User: SLU
 * Date: 9/8/2018
 * Time: 2:22 PM
 */

/**
 * Class Set
 * @package AppBundle\Model\Entity
 */
class Set
{
    /**
     * @var int
     */
    private $setID;

    /**
     * @var string
     */
    private $languageName;

    /**
     * @var Header[]
     */
    private $headers;

    /**
     * @return int
     */
    public function getSetID()
    {
        return $this->setID;
    }

    /**
     * @return string
     */
    public function getLanguageName()
    {
        return $this->languageName;
    }

    /**
     * @param string $languageName
     * @return Set
     */
    public function setLanguageName($languageName)
    {
        $this->languageName = $languageName;
        return $this;
    }

    /**
     * @return Header[]
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * @param Header $header
     * @return Set
     */
    public function addHeader($header)
    {
        $this->headers[] = $header;
        return $this;
    }
}