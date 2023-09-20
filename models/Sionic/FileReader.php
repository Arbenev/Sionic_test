<?php

namespace app\models\Sionic;

use XMLReader;

/**
 * Description of FileReader
 *
 * @author acround
 */
class FileReader
{

    public $fileName;
    public $city;

    /**
     * @var \XMLReader
     */
    public $xmlReader;

    public function read()
    {
        while ($this->xmlReader->read()) {
            if (($this->xmlReader->nodeType == XMLReader::ELEMENT) && $this->isNodeProduct()) {
                $productInfo = $this->readProduct();
                Product::saveProduct($productInfo);
                unset($productInfo);
            }
        }
    }

    public function getNodeType()
    {
        return $this->xmlReader->nodeType;
    }

    public function getDepth()
    {
        return $this->xmlReader->depth;
    }

    public function getName()
    {
        return $this->xmlReader->name;
    }

    private function isNodeProduct()
    {
        return in_array($this->xmlReader->name, ['Товар', 'Предложение']) && ($this->xmlReader->depth == 3);
    }

    private function readProduct()
    {
        $info = [];
        while ($this->xmlReader->read() && ($this->xmlReader->depth > 3)) {
            if (($this->xmlReader->nodeType == XMLReader::ELEMENT) && ($this->xmlReader->depth == 4)) {
                switch ($this->xmlReader->name) {
                    case 'Наименование':
                        $info['name'] = $this->readValue();
                        break;
                    case 'Вес':
                        $info['weight'] = $this->readValue();
                        break;
                    case 'Код':
                        $info['code'] = $this->readValue();
                        break;
                    case 'Количество':
                        $info['quantity_' . $this->city['suffix']] = $this->readValue();
                        break;
                    case 'Взаимозаменяемости':
                        $info['usage'] = $this->readUsage();
                        break;
                    case 'Цены':
                        $info['price_' . $this->city['suffix']] = $this->readPrice();
                        break;
                }
            }
        }
        return $info;
    }

    private function readValue()
    {
        $this->xmlReader->read();
        return $this->xmlReader->value;
    }

    private function readUsage()
    {
        $retValue = [];
        $usage = [];
        while ($this->xmlReader->read() && ($this->xmlReader->depth > 4)) {
            if (($this->xmlReader->nodeType == XMLReader::ELEMENT) && ($this->xmlReader->depth == 5)) {
                if ($usage) {
                    $retValue[] = implode('-', $usage);
                    $usage = [];
                }
            }
            if (($this->xmlReader->nodeType == XMLReader::ELEMENT) && ($this->xmlReader->depth == 6)) {
                $usage[] = $this->readValue();
            }
        }
        return implode('|', $retValue);
    }

    private function readPrice()
    {
        $retValue = null;
        while ($this->xmlReader->read() && ($this->xmlReader->depth > 4)) {
            if (($this->xmlReader->nodeType == XMLReader::ELEMENT) && ($this->xmlReader->depth == 6) && ($this->xmlReader->name == 'ЦенаЗаЕдиницу')) {
                $retValue = $retValue ? $retValue : $this->readValue();
            }
        }
        return $retValue;
    }
}
