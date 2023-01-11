<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;

class AuthorController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}
	
    public function list()
	{
		$items = Author::orderBy('name', 'asc')->get();
		return view(
			'author.list',
			[
				'title' => 'Autori',
				'items' => $items
			]
		);
	}
	
	public function create()
	{
		return view(
			'author.form',
			[
				'title' => 'Pievienot autoru',
				'author' => new Author()
			]
		);
	}
	
	public function put(Request $request)
	{
		$validatedData = $request->validate([
			'name' => 'required',
		]);
		$author = new Author();
		$author->name = $validatedData['name'];
		$author->save();
		return redirect('/authors');
	}
	
	public function update(Author $author)
	{
		return view(
			'author.form',
			[
				'title' => 'Rediģēt autoru',
				'author' => $author
			]
		);
	}

	public function patch(Author $author, Request $request)
	{
		$validatedData = $request->validate([
			'name' => 'required',
		]);
		$author->name = $validatedData['name'];
		$author->save();
		return redirect('/authors');
	}
	
	public function delete(Author $author)
	{
		$author->delete();
		return redirect('/authors');
	}

}
