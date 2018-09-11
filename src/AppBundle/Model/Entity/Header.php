<?php
/**
 * Created by PhpStorm.
 * User: SLU
 * Date: 9/8/2018
 * Time: 2:26 PM
 */

namespace AppBundle\Model\Entity;

/**
 * Class Header
 * @package AppBundle\Model\Entity
 */
class Header
{

    /**
     * @var int
     */
    private $headerID;

    /**
     * @var string
     */
    private $optionName;

    /**
     * @var string
     */
    private $className;

    /**
     * @var boolean
     */
    private $crossProduct;

    /**
     * @var int
     */
    private $lineCount;

    /**
     * @var Set
     */
    private $set;

    /**
     * @var Rule[]
     */
    private $rules;

    /**
     * @return int
     */
    public function getHeaderID()
    {
        return $this->headerID;
    }

    /**
     * @return string
     */
    public function getOptionName()
    {
        return $this->optionName;
    }

    /**
     * @param string $optionName
     * @return Header
     */
    public function setOptionName($optionName)
    {
        $this->optionName = $optionName;
        return $this;
    }

    /**
     * @return string
     */
    public function getClassName()
    {
        return $this->className;
    }

    /**
     * @param string $className
     * @return Header
     */
    public function setClassName($className)
    {
        $this->className = $className;
        return $this;
    }

    /**
     * @return bool
     */
    public function isCrossProduct()
    {
        return $this->crossProduct;
    }

    /**
     * @param bool $crossProduct
     * @return Header
     */
    public function setCrossProduct($crossProduct)
    {
        $this->crossProduct = $crossProduct;
        return $this;
    }

    /**
     * @return int
     */
    public function getLineCount()
    {
        return $this->lineCount;
    }

    /**
     * @param int $lineCount
     * @return Header
     */
    public function setLineCount($lineCount)
    {
        $this->lineCount = $lineCount;
        return $this;
    }

    /**
     * @return Set
     */
    public function getSet()
    {
        return $this->set;
    }

    /**
     * @param Set $set
     * @return Header
     */
    public function setSet($set)
    {
        $this->set = $set;
        return $this;
    }

    /**
     * @return Rule[]
     */
    public function getRules()
    {
        return $this->rules;
    }

    /**
     * @param Rule $rule
     * @return Header
     */
    public function addRule($rule)
    {
        $this->rules[] = $rule;
        return $this;
    }


}