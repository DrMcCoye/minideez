<?php
class Playlist
{
	protected $id;
	protected $titre;
	protected $image;
	protected $rang;
    

	// Liste des getters

	public function id()
	{
        return this->id;
	}

	public function titre()
	{
		return this->titre;
	}

	public function image()
	{
		return this->image;
	}

	public function rang()
	{
		return this->rang;
	}

	// Liste des setters

	public function hydrate(array $donnees)
	{
		foreach ($donnees as $key => $value)
		{
			// On récupère le nom du setter correspondant à l'attribut.
			$method = 'set'.ucfirst($key);
        
			// Si le setter correspondant existe.
			if (method_exists($this, $method))
			{
				// On appelle le setter.
				$this->$method($value);
			}
		}
	}

	public function setId($id)
	{
		// On convertit l'argument en nombre entier.
		// Si c'en était déjà un, rien ne changera.
		// Sinon, la conversion donnera le nombre 0 (à quelques exceptions près, mais rien d'important ici).
		$id = (int) $id;
    
		// On vérifie ensuite si ce nombre est bien strictement positif.
		if ($id > 0)
		{
			// Si c'est le cas, c'est tout bon, on assigne la valeur à l'attribut correspondant.
			$this->id = $id;
		}
	}

	public function setTitre($titre)
	{
		// On vérifie qu'il s'agit bien d'une chaîne de caractères.
		if (is_string($titre))
		{
			$this->titre = $titre;
		}
 	}

	public function setImage($image)
	{
		// On vérifie qu'il s'agit bien d'une url valide.
		if (filter_var($image, FILTER_VALIDATE_URL))
		{
			$this->image = $image;
		}
 	}

	public function setRang($rang)
	{
		// On convertit l'argument en nombre entier.
		// Si c'en était déjà un, rien ne changera.
		// Sinon, la conversion donnera le nombre 0 (à quelques exceptions près, mais rien d'important ici).
		$rang = (int) $rang;
    
		// On vérifie ensuite si ce nombre est bien strictement positif.
		if ($rang > 0)
		{
			// Si c'est le cas, c'est tout bon, on assigne la valeur à l'attribut correspondant.
			$this->rang = $rang;
		}
	}


}