<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Album;
use App\Http\Request\AlbumRequest;
use App\Models\Author;

class AlbumController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}
	
    public function list()
	{
		$items = Album::orderBy('name', 'asc')->get();
		return view(
			'album.list',
			[
				'title' => 'Albumi',
				'items' => $items
			]
		);
	}
	
	public function create()
	{
		$author = Author::orderBy('name', 'asc')->get();
		return view(
			'album.form',
			[
				'title' => 'Pievienot Albumu',
				'album' => new Album(),
				'authors' => $author,
			]
		);
	}
	
	public function update(Album $album)
	{
		$authors = Author::orderBy('name', 'asc')->get();
		return view(
			'album.form',
			[
				'title' => 'Rediģēt Albumu',
				'albums' => $album,
				'authors' => $authors,
			]
		);
	}
	
	private function saveAlbumData(Album $album, AlbumRequest $request)
	{
		$validatedData = $request->validated();
		$album->fill($validatedData);
		$album->display = (bool) ($validatedData['display'] ?? false);
		
		if ($request->hasFile('image')) {
			$uploadedFile = $request->file('image');
			$extension = $uploadedFile->clientExtension();
			$name = uniqid();
			$album->image = $uploadedFile->storePubliclyAs(
				'/',
				$name . '.' . $extension,
				'uploads'
			);
		}
		$album->save();
	}
	
	public function put(AlbumRequest $request)
	{
		$album = new Album();
		$this->saveAlbumData($album, $request);
		return redirect('/albums');
	}
	
	public function patch(Album $album, AlbumRequest $request)
	{
		$this->saveAlbumData($album, $request);
		return redirect('/albums/update/' . $album->id);
	}

	
	public function delete(Albums $album)
	{
		$album->delete();
		return redirect('/albums');
	}
}
