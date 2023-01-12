<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\AlbumController;

class DataController extends Controller
{
    // Metode atgriež 3 publicētus Albumu ierakstus nejaušā secībā
	public function getTopAlbums()
	{
		$albums = Album::where('display', true)
			->inRandomOrder()
			->take(3)
			->get();
		return $albums;
	}
	
	// Metode atgriež izvēlēto Albumu ierakstu, ja tas ir publicēts
	public function getAlbum(Album $album)
	{
		$selectedAlbum = Album::where([
			'id' => $album->id,
			'display' => true,
		])
		->firstOrFail();
		return $selectedAlbum;
	}
	
	// Metode atgriež 3 publicētus Albumus ierakstus nejaušā secībā,
	// izņemot izvēlēto Book ierakstu
	public function getRelatedAlbums(Album $album)
	{
		$albums = Album::where('display', true)
			->where('id', '<>', $album->id)
			->inRandomOrder()
			->take(3)
			->get();
		return $albums;
	}

}
