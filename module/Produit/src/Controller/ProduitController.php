<?php
namespace Produit\Controller;

use Produit\Model\ProduitTable;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Produit\Form\ProduitForm;
use Produit\Model\Produit;
use Zend\Session\Container;
use Zend\Session\SessionManager;

class ProduitController extends AbstractActionController
{
    private $tableProduit;
    private $sessionManager;
    private $sessionContainer;

    public function __construct(ProduitTable $tableProduit, SessionManager $sessionManager)
    {

        $this->tableProduit = $tableProduit;
        $this->sessionManager = $sessionManager;
        // if (!isset($sessionContainer)){      //Ne fonctionnne pas pour le moment..
        //     $sessionContainer = new Container("panier");
        //     $sessionContainer->panier = [];
        // }
        if (!isset($_SESSION["panier"]))
            $_SESSION["panier"] = [];        
    }

    //Retourne tous les produits liées à la page demandée
    public function indexAction(){
        
        $paginator =  $this->tableProduit->fetchAll(true);
        $page = (int) $this->params()->fromQuery('page',1);
        $page = ($page < 1) ? 1: $page;
        $paginator->setCurrentPageNumber($page);
        $paginator->setItemCountPerPage(10);
        return new ViewModel([
            'paginator' => $paginator,
        ]);
    }

    //Retourne les produits du panier
    public function panierAction(){
        $panier = $_SESSION["panier"];
        return new ViewModel([
            'produits' => $this->tableProduit->fetchAllFromBasket($panier)
        ]);
    }
    
    //Ajoute un produit au panier et redirige au panier
    public function ajouterPanierAction(){
        $id = (int) $this->params()->fromRoute('id', 0);

        if (0 === $id) {
            return $this->redirect()->toRoute('produit');
        }
        
        $_SESSION["panier"][] = $id;
        return $this->redirect()->toRoute('produit', ["action" => "panier"]);

    }

    //Retire un produit du pannier et redirige au panier
    public function retirerPanierAction(){

        $id = (int) $this->params()->fromRoute('id', 0);

        if (0 === $id) {
            return $this->redirect()->toRoute('produit');
        }

        if (!in_array($id,$_SESSION["panier"]))
            $this->redirect()->toRoute('produit', ["action" => "panier"]);

        $indexProduit = array_search($id,$_SESSION["panier"]);
        if ($indexProduit !== null)
            array_splice($_SESSION["panier"], $indexProduit,1);
        return $this->redirect()->toRoute('produit', ["action" => "panier"]);

    }

    //Vide le panier et redirige
    public function viderPanierAction(){
        $_SESSION["panier"] = [];
        return $this->redirect()->toRoute('produit', ["action" => "panier"]);
    }

    //Paye et vide le panier
    public function payerAction(){
        $_SESSION["panier"] = [];

        $success = rand(0,1);

        //String 5 lettres + 10 chiffres random
        $noConfirm = substr(md5(microtime()),rand(0,26),5) . str_pad(rand(0, pow(10, 10)-1), 10, '0', STR_PAD_LEFT);
        echo $noConfirm;

        return new ViewModel([
            'noConfirm' => $noConfirm,
            'success' => $success
        ]);
    }

    //Retourne tous les produits d'une page pour l'administrateur
    public function adminAction(){
        $paginator =  $this->tableProduit->fetchAll(true);
        $page = (int) $this->params()->fromQuery('page',1);
        $page = ($page < 1) ? 1: $page;
        $paginator->setCurrentPageNumber($page);
        $paginator->setItemCountPerPage(10);
        return new ViewModel([
            'paginator' => $paginator,
        ]);
    }

    //Retourne la page de description d'un produit demandé
    public function descriptionAction(){
        $id = (int) $this->params()->fromRoute('id', 0);
        if (0 === $id) {
            return $this->redirect()->toRoute('produit');
        }

        $produit =  $this->tableProduit->getProduit($id);
        return new ViewModel([
            'produit' => $produit,
        ]);
    }

    //Ajoute un nouveau produit à la base de données
    public function addAction()
    {
        $form = new ProduitForm();
        $form->get('submit')->setValue('Ajouter');

        $request = $this->getRequest();

        if (! $request->isPost()) {
            return ['form' => $form];
        }

        $produit = new Produit();
        $form->setInputFilter($produit->getInputFilter());
        $form->setData($request->getPost());

        if (! $form->isValid()) {
            return ['form' => $form];
        }

        $produit->exchangeArray($form->getData());
        $this->tableProduit->saveProduit($produit);
        return $this->redirect()->toRoute('produit', ["action" => 'admin']);
    }

    //Modifie un produit de la base de données
    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);

        if (0 === $id) {
            return $this->redirect()->toRoute('produit', ['action' => 'add']);
        }

        // Retrieve the produit with the specified id. Doing so raises
        // an exception if the produit is not found, which should result
        // in redirecting to the landing page.
        try {
            $produit = $this->tableProduit->getProduit($id);
        } catch (\Exception $e) {
            return $this->redirect()->toRoute('produit', ['action' => 'index']);
        }

        $form = new ProduitForm();
        $form->bind($produit);
        $form->get('submit')->setAttribute('value', 'Modifier');

        $request = $this->getRequest();
        $viewData = ['id' => $id, 'form' => $form];

        if (! $request->isPost()) {
            return $viewData;
        }

        $form->setInputFilter($produit->getInputFilter());
        $form->setData($request->getPost());

        if (! $form->isValid()) {
            return $viewData;
        }

        $this->tableProduit->saveProduit($produit);

        // Redirect to produit list
        return $this->redirect()->toRoute('produit', ['action' => 'admin']);
    }

    //Supprime un produit de la base de données
    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('produit', ['action' => 'admin']);
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'Non');

            if ($del == 'Oui') {
                $id = (int) $request->getPost('id');
                $this->tableProduit->deleteProduit($id);
            }

            return $this->redirect()->toRoute('produit' , ['action' => 'admin']);
        }

        return [
            'id'    => $id,
            'produit' => $this->tableProduit->getProduit($id),
        ];
    }
}