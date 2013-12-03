<?php namespace Ortzinator\Classie\Repositories;

use Ortzinator\Classie\Models\Posting;
use Ortzinator\Classie\Models\Category;

class PostingRepositoryEloquent implements PostingRepository
{
	protected $postingModel;
	protected $categoryModel;

	function __construct(Posting $model, Category $category) {
		$this->postingModel = $model;
		$this->categoryModel = $category;
	}

	public function find($id)
	{
		$posting = $this->postingModel->with('questions')->findOrFail($id);
		if ($posting->hasExpired())
		{
			$posting->closed = true;
			$posting->save();
		}
		return $posting;
	}

	public function newInstance($data)
	{
		$posting = new Posting;
		$posting->title			= $data['title'];
		$posting->category_id	= $data['category'];
		$posting->area			= $data['area'];
		$posting->content		= $data['detail'];
		$posting->days			= $data['days'];
		$posting->closed		= $data['closed'];
		$posting->user_id		= $data['user_id'];

		return $posting;
	}

	public function search($query)
	{
		return $this->postingModel->leftJoin('throttle', 'postings.user_id', '=', 'throttle.user_id')
			->whereNull('throttle.banned')
			->open()
			->where('title', 'LIKE', "%$query%")
			->orWhere('content', 'LIKE', "%$query%")
			->orderBy('created_at', 'desc')
			->paginate(50, ['postings.id', 'title', 'category_id', 'area', 'closed', 'expires_at']);
	}

	public function postsByUser($id, $limit = 50)
	{
		return $this->postingModel->where('user_id', $id)->get();
	}

	public function paginate($category = null, $include_closed = false, $include_banned = false)
	{
		$return = $this->postingModel->leftJoin('throttle', 'postings.user_id', '=', 'throttle.user_id');

		if (!!$category) {
			$categories = $this->categoryModel->where('parent_id', $category)->lists('id');
			$categories[] = $category;
			$return = $return->whereIn('category_id', $categories);
			
		}

		if ($include_closed) {
			$return = $return->closed();
		}
		else {
			$return = $return->open();
		}

		if ($include_banned) {
			$return = $return->whereNull('throttle.banned');
		}

		$return = $return->orderBy('created_at', 'desc');
		return $return->paginate(50, ['postings.id', 'title', 'category_id', 'area', 'closed', 'expires_at']);
	}

	public function all($category = null)
	{
		return $this->paginate($category);
	}

	public function allWithBanned($category = null)
	{
		return $this->paginate($category, false, true);
	}
}