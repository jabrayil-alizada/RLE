<?php


/**
 * Class Rle
 */
class Rle
{
    /**
     * @var string
     */
    protected $_inputStr;

    /**
     * @var string
     */
    protected $_compressedStr;

    /**
     * Rle constructor.
     * @param string|null $inputStr
     */
    public function __construct(string $inputStr = null)
    {
        $this->_inputStr = $inputStr;
        if($inputStr)
        {
            $this->_compressedStr = $this->compress($inputStr);
        }
    }

    /**
     * @param string $inputStr
     * @return string
     */
    public function compress(string $inputStr)
    {
        $strLen = strlen($inputStr);
        $repeatCounter = 1;
        $compressedStr = '';

        for ($i = 1; $i <= $strLen; $i++)
        {
            if($inputStr[$i] == $inputStr[$i-1])
            {
                $repeatCounter++;
            }
            else
            {
                $compressedStr .= $repeatCounter . $inputStr[$i-1];
                $repeatCounter = 1;
            }
        }

        return $compressedStr;
    }

    /**
     * @return string|null
     */
    public function getCompressedStr() : ?string
    {
        return $this->_compressedStr;
    }


    /**
     * @return string|null
     */
    public function getInputStr(): ?string
    {
        return $this->_inputStr;
    }

    /**
     * @param string $inputStr
     * @return Rle
     */
    public function setInputStr(string $inputStr) : Rle
    {
        $clone = clone $this;

        $clone->_inputStr = $inputStr;
        $clone->_compressedStr = $this->compress($inputStr);

        return $clone;
    }

    public function calcCompressionRatio()
    {
        if($this->_inputStr)
        {
            return round(strlen($this->_compressedStr) / strlen($this->_inputStr), 3);
        }
    }
}

$objRle = new Rle();
$objRle = $objRle->setInputStr('AAAAAAAAAAAAAAAABCBABBB');

echo 'RLE' . '<pre>' . print_r([
    'inputStr' => $objRle->getInputStr(),
    'compressedStr' => $objRle->getCompressedStr(),
    'compressionRatio' => $objRle->calcCompressionRatio()
], 1) . '</pre>';
