<?php
namespace Produit\Model;

use RuntimeException;
use Zend\Db\TableGateway\TableGatewayInterface;

class ProduitTable
{
    private $tableGateway;

    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll()
    {
        return $this->tableGateway->select();
    }

    public function fetchAllFromBasket($panierIds)
    {
        $panier = [];
        foreach($panierIds as $id){
            $panier[] = $this->tableGateway->select(['id' => $id])->current();
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
        $this->tableGateway->delete(['id' => (int) $id]);
    }
}