<?php

use Ortzinator\Classie\Repositories\PostingRepository;
use Ortzinator\Classie\Repositories\CategoryRepository;

class CategoriesController extends BaseController {

	protected $posting;
	protected $category;

	function __construct(CategoryRepository $category, PostingRepository $posting)
	{
		$this->posting = $posting;
		$this->category = $category;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$query = $this->category->allTopLevel();
		return View::make('categories')->with('categories', 
			$query);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	// public function create()
	// {
	// 	//
	// }

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	// public function store()
	// {
	// 	//
	// }

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$data = array(
			'category' => $this->category->find($id),
			'postings' => $this->posting->paginate($id)
			);
		return View::make('category')->with($data);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	// public function edit($id)
	// {
	// 	//
	// }

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	// public function update($id)
	// {
	// 	//
	// }

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	// public function destroy($id)
	// {
	// 	//
	// }

}
