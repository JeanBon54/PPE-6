<?php
/**
 * Created by PhpStorm.
 * User: Gab
 * Date: 02/06/14
 * Time: 15:32
 */

class Test extends PHPUnit_Framework_TestCase {

    public function testAjoutBug(){

        require("../bootstrap.php");
        require("../src/Bug.php");
        require("../src/Product.php");

        $bug = new Bug();
        $product= new Product();

        $product->setName("test");

        $this->assertEquals($bug->getProducts()->count(),0);
        $bug->assignToProduct($product);
        $this->assertEquals($bug->getProducts()->count(),1);




    }

}
 