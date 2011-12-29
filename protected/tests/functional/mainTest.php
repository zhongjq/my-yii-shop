<?php

class mainTest extends WebTestCase
{
	public $fixtures=array(
		'mains'=>'main',
	);

	public function testShow()
	{
		$this->open('?r=main/show&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=main/create');
	}

	public function testUpdate()
	{
		$this->open('?r=main/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=main/show&id=1');
	}

	public function testList()
	{
		$this->open('?r=main/list');
	}

	public function testAdmin()
	{
		$this->open('?r=main/admin');
	}
}
