<?php
class facture
{
	private $pdo;
    
    public $Id;
    public $CIN;
    public $Nom;
    public $Tel;
    public $IdVillage;  

	public function __CONSTRUCT()
	{
		try
		{
			$this->pdo = Database::StartUp();     
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Lister()
	{
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM facture");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Obtenir($Id)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM facture WHERE Id = ?");
			          

			$stm->execute(array($Id));
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Supprimer($Id)
	{
		try 
		{
			$stm = $this->pdo
			            ->prepare("DELETE FROM facture WHERE Id = ?");			          

			$stm->execute(array($Id));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Modifier($data)
	{
		try 
		{
			$sql = "UPDATE facture SET 
						CIN        = ?, 
						Nom        = ?, 
						Tel        = ?,
                        IdVillage  = ?
						
				    WHERE Id = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				    array(
				    	$data->CIN, 
				    	$data->Nom, 
                        $data->Tel,                        
                        $data->IdVillage,
                        $data->Id
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Ajouter(facture $data)
	{
		try 
		{
		$sql = "INSERT INTO facture (CIN,Nom,Tel,IdVillage) 
		        VALUES (?, ?, ?, ?)";

		$this->pdo->prepare($sql)
		     ->execute(
				array(
					$data->CIN,
					$data->Nom, 
                    $data->Tel,
                    $data->IdVillage
                )
			);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}