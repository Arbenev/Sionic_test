<?php

namespace app\commands;

use yii\console\Controller;
use yii\console\ExitCode;
use app\models\Sionic;
use XMLReader;

/**
 * Description of ImportController
 *
 * @author acround
 */
class ImportController extends Controller
{

    const DATA_FOLDER = 'data';

    private $directoryName;

    public function actionIndex()
    {
//        ini_set('memory_limit', '16M');
        $fileNames = $this->readFileNames();
        foreach ($fileNames as $fileName) {
            $this->readFile($fileName);
        }
        return ExitCode::OK;
    }

    private function readFileNames()
    {
        $fileNames = [];
        $this->directoryName = ROOT . DIRECTORY_SEPARATOR . self::DATA_FOLDER . DIRECTORY_SEPARATOR;
        $dir = opendir($this->directoryName);
        if ($dir) {
            while (($fileName = readdir($dir)) !== false) {
                if (substr($fileName, 0, 1) == '.') {
                    continue;
                }
                $fileNames[] = $fileName;
            }
        }
        sort($fileNames);
        return $fileNames;
    }

    private function readFile($fileName)
    {
        echo $fileName."\n";
        $reader = $this->getReader($fileName);
        $reader->city = $this->getCity($fileName);
        $reader->read();
    }

    /**
     *
     * @param type $fileName
     * @return \app\models\Sionic\FileReader
     */
    private function getReader($fileName)
    {
        $reader = new Sionic\FileReader();
        $reader->fileName = $fileName;
        $reader->xmlReader = XMLReader::open($this->directoryName . DIRECTORY_SEPARATOR . $fileName);
        return $reader;
    }

    /**
     *
     * @param string $fileName
     * @return aaray|bool
     */
    private function getCity($fileName)
    {
        $pattern = '~[a-z]*(\d)_\d?~';
        $matches = [];
        if (preg_match($pattern, $fileName, $matches)) {
            $cityCode = $matches[1];
            $city = Sionic\City::findOne(['code' => $cityCode]);
            return $city->getAttributes();
        }
        return false;
    }
}
