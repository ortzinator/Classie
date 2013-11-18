<?php namespace Ortzinator\Classie\Repositories;

interface PostingRepository
{
	public function find($id);

	public function newInstance($values);

	public function search($query);

	public function postsByUser($id, $limit = 50);

	public function paginate($category = 0);
}
