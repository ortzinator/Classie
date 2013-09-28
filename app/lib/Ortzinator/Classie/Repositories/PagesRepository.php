<?php namespace Ortzinator\Classie\Repositories;

interface PagesRepository
{
	public function find($id);

	public function all(array $columns = ['*']);
}
