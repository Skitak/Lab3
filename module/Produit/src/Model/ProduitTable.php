<?php
namespace Produit\Model;

use RuntimeException;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Select;
use Zend\Db\TableGateway\TableGatewayInterface;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Paginator\Paginator;

class ProduitTable
{
    private $tableGateway;

    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll($paginated = false)
    {
        if($paginated)
            return $this->fetchPaginatedResults();
        return $this->tableGateway->select();
    }

    private function fetchPaginatedResults()
    {
        // Create a new Select object for the table:
        $select = new Select($this->tableGateway->getTable());

        // Create a new result set based on the Album entity:
        $resultSetPrototype = new ResultSet();
        $resultSetPrototype->setArrayObjectPrototype(new Produit());

        // Create a new pagination adapter object:
        $paginatorAdapter = new DbSelect(
            // our configured select object:
            $select,
            // the adapter to run it against:
            $this->tableGateway->getAdapter(),
            // the result set to hydrate:
            $resultSetPrototype
        );

        $paginator = new Paginator($paginatorAdapter);
        return $paginator;
    }

    public function fetchAllFromBasket($panierIds)
    {
        $panier = [];
        foreach($panierIds as $id){
            $row = $this->tableGateway->select(['id' => $id])->current();
            if ($row)
                $panier[] = $row;
        }
        return $panier;
    }

    public function getProduit($id)
    {
        $id = (int) $id;
        $rowset = $this->tableGateway->select(['id' => $id]);
        $row = $rowset->current();
        if (! $row) {
            throw new RuntimeException(sprintf(
                'Could not find row with identifier %d',
                $id
            ));
        }

        return $row;
    }

    public function saveProduit(Produit $produit)
    {
        $data = [
            'nom' => $produit->nom,
            'description'  => $produit->description,
            'prix'  => $produit->prix
        ];

        $id = (int) $produit->id;

        if ($id === 0) {
            $this->tableGateway->insert($data);
            return;
        }

        if (! $this->getProduit($id)) {
            throw new RuntimeException(sprintf(
                'Cannot update produit with identifier %d; does not exist',
                $id
            ));
        }

        $this->tableGateway->update($data, ['id' => $id]);
    }

    public function deleteProduit($id)
    {
        $this->tableGateway->delete(['id' => $id]);
    }

    // Utile pour ajouter de nombreux produits dans la base de données.
    //
    // public function addProducts(){
    //     for ($i = 0; $i < 100; $i++){
    //         $data = [
    //             'nom' => "Produit " . $i,
    //             'description'  => "Description produit " . $i,
    //             'prix'  => 1235
    //         ];
    //         $this->tableGateway->insert($data);
    //     }
    // }
}