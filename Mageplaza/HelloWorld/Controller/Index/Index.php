<?php

namespace Mageplaza\HelloWorld\Controller\Index;

use Magento\Framework\Controller\ResultFactory;

class Index extends \Magento\Framework\App\Action\Action
{
    public function execute()
    {
        $post = (array) $this->getRequest()->getPost();

        if (!empty($post)) {
            // Retrieve your form data
            
            $postModel = $this->_objectManager->create('Mageplaza\HelloWorld\Model\Post');
            $postModel->setFirstName($post['first_name']);
            $postModel->setLastName($post['last_name']);
            $postModel->setEmail($post["email"]);
            $postModel->setPhoneNumber($post["phone_number"]);
            $postModel->setMessage($post["message"]);
            $postModel->save();

            // Doing-something with...

            // Display the succes form validation message
            $this->messageManager->addSuccessMessage('Submit done, you will be contact soon !');

            // Redirect to your form page (or anywhere you want...)
            $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
            $resultRedirect->setUrl('helloworld');

            return $resultRedirect;
        }
        $this->_view->loadLayout();
        $this->_view->renderLayout();
    }
}