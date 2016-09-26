<?php
class AlbumManager
{
	private $_db;


	public function __construct($db)
	{
		$this->setDb($db);
	}

	public function add(Album $album)
	{
		$q = $this->_db->prepare('INSERT INTO albums(id, artiste, titre, image, rang) VALUES (:id, :artiste, :titre, :image, :rang)');

		$q->bindValue(':id', $album->id());
		$q->bindValue(':artiste', $album->artiste(), PDO::PARAM_INT);
		$q->bindValue(':titre', $album->titre(), PDO::PARAM_INT);
		$q->bindValue(':image', $album->image(), PDO::PARAM_INT);
		$q->bindValue(':rang', $album->rang(), PDO::PARAM_INT);

		$q->execute();
	}

	public function delete(Album $album)
	{
    	$this->_db->exec('DELETE FROM albums WHERE id = '.$album->id());
	}

	public function get($id)
	{
		$id = (int) $id;

		$q = $this->_db->query('SELECT id, artiste, titre, image, rang FROM albums WHERE id = '.$id);
		$donnees = $q->fetch(PDO::FETCH_ASSOC);

		return new Album($donnees);
	}

	public function getList()
	{
		$albums = [];

		$q = $this->_db->query('SELECT id, artiste, titre, image, rang FROM albums ORDER BY rang');

		while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
		{
			$albums[] = new Album($donnees);
		}

		return $albums;
	}

  	public function update(Album $album)
	{
		$q = $this->_db->prepare('UPDATE albums SET artiste = :artiste, titre = :titre, image = :image, rang = :rang WHERE id = :id');

		$q->bindValue(':artiste', $album->artiste(), PDO::PARAM_INT);
		$q->bindValue(':titre', $album->titre(), PDO::PARAM_INT);
		$q->bindValue(':image', $album->image(), PDO::PARAM_INT);
		$q->bindValue(':rang', $album->rang(), PDO::PARAM_INT);
		$q->bindValue(':id', $album->id(), PDO::PARAM_INT);

		$q->execute();
	}


	public function setDb(PDO $db)
	{
		$this->_db = $db;
	}

}