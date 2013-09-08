<?php namespace Ortzinator\Classie\Repositories;

use Ortzinator\Classie\Models\Question;

class QuestionRepositoryEloquent implements QuestionRepository
{
	protected $questionModel;

	function __construct(Question $model) {
		$this->questionModel = $model;
	}

	public function find($id)
	{
		return $this->questionModel->findOrFail($id);
	}

	public function newInstance($data)
	{
		$question = new Question;
		$question->content		= $data['content'];
		$question->posting_id	= $data['posting'];
		$question->user_id		= $data['user_id'];
		$question->parent_id	= $data['parent_id'];

		return $question;
	}

	public function findByPosting($postingId)
	{
		return $this->questionModel->where('posting_id', '=', $postingId)
			->where('parent_id', '=', 0)->orWhere('parent_id')->get();
	}
}