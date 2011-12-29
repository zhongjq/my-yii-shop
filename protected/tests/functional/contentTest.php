<?php

class contentTest extends WebTestCase
{
	public $fixtures=array(
		'contents'=>'content',
	);

	public function testShow()
	{
		$this->open('?r=content/show&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=content/create');
	}

	public function testUpdate()
	{
		$this->open('?r=content/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=content/show&id=1');
	}

	public function testList()
	{
		$this->open('?r=content/list');
	}

	public function testAdmin()
	{
		$this->open('?r=content/admin');
	}
}
