<?php
namespace User\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Authentication\Result;
use Zend\View\Model\JsonModel;
use Zend\View\Model\ViewModel;
use User\Services\UserManager;
use User\Services\AuthManager;
use User\Form\LoginForm;
use Zend\Uri\Uri;

class AuthController extends AbstractActionController
{
    private $_userManager;
    private $_authManager;

    public function __construct(UserManager $userManager, AuthManager $authManager)
    {
        $this->_userManager = $userManager;
        $this->_authManager = $authManager;
    }

    public function loginAction() {
        $redirectUrl = (string)$this->params()->fromQuery('redirectUrl', '');
        if (strlen($redirectUrl)>2048) {
            throw new \Exception("Too long redirectUrl argument passed");
        }

        $form = new LoginForm();
        $form->get('redirect_url')->setValue($redirectUrl);

        $isLoginError = false;

        if ($this->getRequest()->isPost()) {
            $data = $this->params()->fromPost();
            $form->setData($data);
            $info = $form->getMessages();
            // if($form->isValid()) {
                // $data = $form->getData();
                $result = $this->_authManager->login($data['username'], $data['password']);
                $infos = "looked at login";

                if ($result->getCode() == Result::SUCCESS) {
                    $redirectUrl = $this->params()->fromPost('redirect_url', '');

                    if (!empty($redirectUrl)) {
                        $uri = new Uri($redirectUrl);
                        if (!$uri->isValid() || $uri->getHost()!=null)
                            throw new \Exception('Incorrect redirect URL: ' . $redirectUrl);
                    }

                    if(empty($redirectUrl)) {
                        return $this->redirect()->toRoute('produit', ['action' => "admin"]);
                    } else {
                        $this->redirect()->toUrl($redirectUrl);
                    }
                } else {
                    $isLoginError = true;
                }
            // } else {
            //     $isLoginError = true;
            // }
        }

        return new ViewModel([
            'form' => $form,
            'isLoginError' => $isLoginError,
            'redirectUrl' => $redirectUrl,
            'infos' => $infos
        ]);
    }

    public function logoutAction() {
        $this->_authManager->logout();

        return $this->redirect()->toRoute('login');
    }
}

?>