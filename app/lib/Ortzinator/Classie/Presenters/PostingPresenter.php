<?php namespace Ortzinator\Classie\Presenters;

use McCool\LaravelAutoPresenter\BasePresenter;

class PostingPresenter extends BasePresenter
{
	public function __construct(\Ortzinator\Classie\Models\Posting $post)
	{
		$this->resource = $post;
	}

	public function content()
	{
		return nl2br(htmlentities($this->resource->content));
	}

	public function created_at()
	{
		return $this->resource->created_at->format('m/d/y g:i A');
	}

	public function expires_at()
	{
		return $this->resource->expires_at->format('m/d/y g:i A');
	}
}