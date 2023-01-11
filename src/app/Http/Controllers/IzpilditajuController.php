<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Izpilditaji;

class IzpilditajuController extends Controller
{
    public function list()
	{
		$items = Izpilditaji::orderBy('name', 'asc')->get();
		return view(
			'izpilditaji.list',
			[
				'title' => 'Izpilditaji',
				'items' => $items
			]
		);
	}

}
