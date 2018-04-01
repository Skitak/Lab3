<?php
namespace Produit;

use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\Mvc\MvcEvent;
use Zend\Session\SessionManager;

class Module implements ConfigProviderInterface
{
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    public function getServiceConfig()
    {
        return [
            'factories' => [
                Model\ProduitTable::class => function($container) {
                    $tableGateway = $container->get(Model\ProduitTableGateway::class);
                    return new Model\ProduitTable($tableGateway);
                },
                Model\ProduitTableGateway::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Produit());
                    return new TableGateway('Product', $dbAdapter, null, $resultSetPrototype);
                },
            ],
        ];
    }

    public function getControllerConfig()
    {
        return [
            'factories' => [
                Controller\ProduitController::class => function($container) {
                    return new Controller\ProduitController(
                        $container->get(Model\ProduitTable::class),
                        $container->get(SessionManager::class)
                    );
                },
            ],
        ];
    }

    /**
     * This method is called once the MVC bootstrapping is complete. 
     */
    public function onBootstrap(MvcEvent $event)
    {
        $application = $event->getApplication();
        $serviceManager = $application->getServiceManager();
        
        // The following line instantiates the SessionManager and automatically
        // makes the SessionManager the 'default' one to avoid passing the 
        // session manager as a dependency to other models.
        $sessionManager = $serviceManager->get(SessionManager::class);
    }


}