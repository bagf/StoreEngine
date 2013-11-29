<?php
/**
 * This checks the system sanity by making sure everything is empty
 * 
 * @author bagf
*/
class SantiyCheckTest extends PHPUnit_Framework_TestCase {
   
    public function check($count) {
        $this->assertEquals($count, 0);
    }
    
    public function provider() {
        $fileModuleFactory = new \StoreEngine\FileModelFactory();
        return [
            [
                $fileModuleFactory->get()->count()
            ]
        ];
    }
}
