<?php

class jobsTest extends WebTestCase
{
	public $fixtures=array(
		'jobs'=>'jobs',
	);

	public function testShow()
	{
		$this->open('?r=jobs/show&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=jobs/create');
	}

	public function testUpdate()
	{
		$this->open('?r=jobs/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=jobs/show&id=1');
	}

	public function testList()
	{
		$this->open('?r=jobs/list');
	}

	public function testAdmin()
	{
		$this->open('?r=jobs/admin');
	}
}
