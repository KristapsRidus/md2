<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Izpilditaji;

class IzpilditajuController extends Controller
{
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
		return redirect('/izpilditaji');
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

}
