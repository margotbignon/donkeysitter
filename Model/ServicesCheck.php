<?php
Class ServicesCheck {
    public function __construct(private array $servicesCheck) {

    }


    public function getServicesCheck()
    {
        return $this->servicesCheck;
    }

    public function setServicesCheck($servicesCheck)
    {
        $this->servicesCheck = $servicesCheck;

        return $this;
    }

    public function viewPricesServicesCheck(array $services, Services $service) {
        foreach ($this->servicesCheck as $serviceCheck) {
            foreach ($services as $service) {
                if ($serviceCheck == $service->getId()) {
                    echo "<input type='text' name='price[".$service->getId()."]' placeholder = 'Prix pour ".$service->getServiceType()."' class='mt-3 rounded border-0 p-2 w-75'>";
                }
            }
        }
    }

    public function checkBoxServices(Services $service) {
        foreach ($this->servicesCheck as $serviceCheck) {
            if ($service->getId() == $serviceCheck) {
                echo "checked";
            }
        }
    }


}