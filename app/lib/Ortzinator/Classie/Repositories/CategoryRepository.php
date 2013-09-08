<?php namespace Ortzinator\Classie\Repositories;

interface CategoryRepository
{
	public function find($id);

	public function all();

	public function allTopLevel();

	public function lists($column, $key);
}
