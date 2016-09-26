<?php
class Album extends Playlist
{
	protected $artiste;

	// Liste des getters

	public function artiste()
	{
		return this->artiste;
	}

	// Liste des setters

	public function setArtiste($artiste)
	{
		// On vérifie qu'il s'agit bien d'une chaîne de caractères.
		if (is_string($artiste))
		{
			$this->artiste = $artiste;
		}
 	}

}