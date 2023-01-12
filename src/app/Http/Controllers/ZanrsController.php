<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Zanrs;

class ZanrsController extends Controller
{
    public function list()
	{
		$items = Zanrs::orderBy('name', 'asc')->get();
		return view(
			'zanrs.list',
			[
				'title' => 'Zanri',
				'items' => $items
			]
		);
	}

	public function create()
	{
		return view(
			'zanrs.form',
			[
				'title' => 'Pievienot zanru',
				'zanrs' => new Zanrs()
			]
		);
	}

	public function put(Request $request)
	{
		$validatedData = $request->validate([
			'name' => 'required',
		]);
		$zanrs = new Author();
		$zanrs->name = $validatedData['name'];
		$zanrs->save();
		return redirect('/zanri');
	}

	public function update(Zanrs $zanrs)
	{
		return view(
			'zanrs.form',
			[
				'title' => 'Rediģēt žanru',
				'zanrs' => $zanrs
			]
		);
	}
	
	public function patch(Zanrs $zanrs, Request $request)
	{
		$validatedData = $request->validate([
			'name' => 'required',
		]);
		$zanrs->name = $validatedData['name'];
		$zanrs->save();
		return redirect('/zanri');
	}
	
	public function delete(Zanrs $zanrs)
	{
		$zanrs->delete();
		return redirect('/zanri');
	}
}
