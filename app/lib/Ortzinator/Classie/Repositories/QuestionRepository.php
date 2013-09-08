<?php namespace Ortzinator\Classie\Repositories;

interface QuestionRepository
{
	public function find($id);

	public function newInstance($values);

	public function findByPosting($postingId);
}
