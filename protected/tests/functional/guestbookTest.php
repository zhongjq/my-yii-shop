<?php

class guestbookTest extends WebTestCase
{
	public $fixtures=array(
		'guestbooks'=>'guestbook',
	);

	public function testShow()
	{
		$this->open('?r=guestbook/show&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=guestbook/create');
	}

	public function testUpdate()
	{
		$this->open('?r=guestbook/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=guestbook/show&id=1');
	}

	public function testList()
	{
		$this->open('?r=guestbook/list');
	}

	public function testAdmin()
	{
		$this->open('?r=guestbook/admin');
	}
}
