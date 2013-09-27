<?php namespace Ortzinator\Classie\Repositories;

use Ortzinator\Classie\Models\Page;

class PagesRepositoryEloquent implements PagesRepository
{
	protected $pagesModel;

	function __construct(Page $model) {
		$this->pagesModel = $model;
	}

	public function find($id)
	{
		return $this->pagesModel->findOrFail($id);
	}

	public function findByName($name)
	{
		return $this->pagesModel->where('name', $name)->first();
	}

	public function all(array $columns = ['*'])
	{
		return $this->pagesModel->orderBy('order')->remember(100)->get($columns);
	}
}