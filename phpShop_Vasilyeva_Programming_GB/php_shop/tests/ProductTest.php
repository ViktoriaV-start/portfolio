<?php

use \PHPUnit\Framework\TestCase;
use app\model\entities\Product;

class ProductTest extends TestCase
{
    public function testProduct() {
        $name = "T-shirt";
        $category_id = 2;
        $price = 85;
        $product = new Product($name, $category_id, $price);
        $this->assertEquals($name, $product->name);
        $this->assertEquals($category_id, $product->category_id);
        $this->assertEquals($price, $product->price);
    }

    public function testNamespace() {
        $app = "app";
        $dir = "model";
        $subdir = "entities";
        $className = "Product";
        $class = explode("\\",Product::class);
        $this->assertEquals($app, $class[0]);
        $this->assertEquals($dir, $class[1]);
        $this->assertEquals($subdir, $class[2]);
        $this->assertEquals($className, $class[3]);
    }
}
