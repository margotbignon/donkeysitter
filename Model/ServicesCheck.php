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
                    echo "
                    <div class='mt-3'>
                        <p class='text-label-regular'>Prix pour ".$service->getServiceType()."</p>
                        <input type='number' name='price[".$service->getId()."]' placeholder = '0' class='form-control mt-3 pt3 pb3'>
                    </div>";
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