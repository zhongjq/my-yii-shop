<?php

class productTest extends WebTestCase
{
	public $fixtures=array(
		'products'=>'product',
	);

	public function testShow()
	{
		$this->open('?r=product/show&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=product/create');
	}

	public function testUpdate()
	{
		$this->open('?r=product/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=product/show&id=1');
	}

	public function testList()
	{
		$this->open('?r=product/list');
	}

	public function testAdmin()
	{
		$this->open('?r=product/admin');
	}
}
