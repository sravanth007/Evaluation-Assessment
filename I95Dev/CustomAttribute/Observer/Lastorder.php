<?php
namespace I95Dev\CustomAttribute\Observer;
use Magento\Framework\Event\ObserverInterface;


class Lastorder implements ObserverInterface
{
   protected $customerRepository;

    public function __construct(
        \Magento\Customer\Api\CustomerRepositoryInterfaceFactory $customerRepositoryFactory  //Here we get the customer data for save the customer Attribute
    ) {        
        $this->customerRepository = $customerRepositoryFactory->create();//We will be defining the customer
    }

    

    public function execute(\Magento\Framework\Event\Observer $observer)
    {   
       
      $order = $observer->getEvent()->getOrder();//Through Observer we are getting the event and the order
      $customerId = $order->getData('customer_id');//Getting Customer ID
      $customer = $this->customerRepository->getById($customerId);//Find Customer Data From the ID
      
      $customer->setCustomAttribute('last_order_date', $order->getCreatedAt());//Setting the CustomAttribute
    $this->customerRepository->save($customer);//Through this method we are saving the method

    
    }
}

