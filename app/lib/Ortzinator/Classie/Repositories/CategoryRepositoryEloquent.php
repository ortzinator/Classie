<?php namespace Ortzinator\Classie\Repositories;

use Ortzinator\Classie\Models\Category;

class CategoryRepositoryEloquent implements CategoryRepository
{
	protected $categoryModel;

	function __construct(Category $model) {
		$this->categoryModel = $model;
	}

	public function find($id)
	{
		return $this->categoryModel->findOrFail($id);
	}

	public function findByName($name)
	{
		return $this->categoryModel->where('name', $name)->first();
	}

	public function all()
	{
		return $this->categoryModel->orderBy('order')->remember(100)->get();
	}

	public function allTopLevel()
	{
		return $this->categoryModel->where('parent_id', '=', 0)->orWhere('parent_id')->get();
	}

	public function lists($column, $key)
	{
		return $this->categoryModel->lists($column, $key);
	}
}