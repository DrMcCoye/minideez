<?php
class PlaylistManager
{
	private $_db;


	public function __construct($db)
	{
		$this->setDb($db);
	}

	public function add(Playlist $playlist)
	{
		$q = $this->_db->prepare('INSERT INTO playlists(id, titre, image, rang) VALUES (:id, :titre, :image, :rang)');

		$q->bindValue(':id', $playlist->id());
		$q->bindValue(':titre', $playlist->titre(), PDO::PARAM_INT);
		$q->bindValue(':image', $playlist->image(), PDO::PARAM_INT);
		$q->bindValue(':rang', $playlist->rang(), PDO::PARAM_INT);

		$q->execute();
	}

	public function delete(Playlist $playlist)
	{
    	$this->_db->exec('DELETE FROM playlists WHERE id = '.$playlist->id());
	}

	public function get($id)
	{
		$id = (int) $id;

		$q = $this->_db->query('SELECT id, titre, image, rang FROM playlists WHERE id = '.$id);
		$donnees = $q->fetch(PDO::FETCH_ASSOC);

		return new Playlist($donnees);
	}

	public function getList()
	{
		$playlists = [];

		$q = $this->_db->query('SELECT id,  titre, image, rang FROM playlists ORDER BY rang');

		while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
		{
			$playlists[] = new Playlist($donnees);
		}

		return $playlists;
	}

  	public function update(Playlist $playlist)
	{
		$q = $this->_db->prepare('UPDATE playlists SET titre = :titre, image = :image, rang = :rang WHERE id = :id');

		$q->bindValue(':titre', $playlist->titre(), PDO::PARAM_INT);
		$q->bindValue(':image', $playlist->image(), PDO::PARAM_INT);
		$q->bindValue(':rang', $playlist->rang(), PDO::PARAM_INT);
		$q->bindValue(':id', $playlist->id(), PDO::PARAM_INT);

		$q->execute();
	}


	public function setDb(PDO $db)
	{
		$this->_db = $db;
	}

}