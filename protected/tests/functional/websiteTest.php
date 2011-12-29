<?php

class websiteTest extends WebTestCase
{
	public $fixtures=array(
		'websites'=>'website',
	);

	public function testShow()
	{
		$this->open('?r=website/show&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=website/create');
	}

	public function testUpdate()
	{
		$this->open('?r=website/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=website/show&id=1');
	}

	public function testList()
	{
		$this->open('?r=website/list');
	}

	public function testAdmin()
	{
		$this->open('?r=website/admin');
	}
}
