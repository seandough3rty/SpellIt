<?php
/**
 * Created by PhpStorm.
 * User: SLU
 * Date: 9/8/2018
 * Time: 2:24 PM
 */

namespace AppBundle\Model\Entity;

/**
 * Class Rule
 * @package AppBundle\Model\Entity
 */
class Rule
{
    /**
     * @var int
     */
    private $ruleID;

    /**
     * @var string
     */
    private $strippingChars;

    /**
     * @var string
     */
    private $affix;

    /**
     * @var string
     */
    private $conditional;

    /**
     * @var Header
     */
    private $header;

    /**
     * @return int
     */
    public function getRuleID()
    {
        return $this->ruleID;
    }

    /**
     * @return string
     */
    public function getStrippingChars()
    {
        return $this->strippingChars;
    }

    /**
     * @param string $strippingChars
     * @return Rule
     */
    public function setStrippingChars($strippingChars)
    {
        $this->strippingChars = $strippingChars;
        return $this;
    }

    /**
     * @return string
     */
    public function getAffix()
    {
        return $this->affix;
    }

    /**
     * @param string $affix
     * @return Rule
     */
    public function setAffix($affix)
    {
        $this->affix = $affix;
        return $this;
    }

    /**
     * @return string
     */
    public function getConditional()
    {
        return $this->conditional;
    }

    /**
     * @param string $conditional
     * @return Rule
     */
    public function setConditional($conditional)
    {
        $this->conditional = $conditional;
        return $this;
    }

    /**
     * @return Header
     */
    public function getHeader()
    {
        return $this->header;
    }

    /**
     * @param Header $header
     * @return Rule
     */
    public function setHeader($header)
    {
        $this->header = $header;
        return $this;
    }
}