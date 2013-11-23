<?php namespace Ortzinator\Classie\Repositories;

use Ortzinator\Classie\Models\Posting;

class PostingRepositoryEloquent implements PostingRepository
{
	protected $postingModel;

	function __construct(Posting $model) {
		$this->postingModel = $model;
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
			->where('title', 'LIKE', "%$query%")
			->orWhere('content', 'LIKE', "%$query%")
			->orderBy('created_at', 'desc')
			->paginate(50, ['postings.id', 'title', 'category_id', 'area']);
	}

	public function postsByUser($id, $limit = 50)
	{
		return $this->postingModel->where('user_id', $id)->get();
	}

	public function paginate($category = 0)
	{
		$return = $this->postingModel->leftJoin('throttle', 'postings.user_id', '=', 'throttle.user_id')
			->whereNull('throttle.banned')
			->orderBy('created_at', 'desc');
		if ($category != 0) {
			$return = $return->where('category_id', $category);
		}
		return $return->paginate(50, ['postings.id', 'title', 'category_id', 'area', 'closed']);
	}
}