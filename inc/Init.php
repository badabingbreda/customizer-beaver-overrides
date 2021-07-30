<?php
namespace BeaverOverrides;
use BeaverOverrides\Controls;
use BeaverOverrides\Customize;

class Init {

    public function __construct() {

        new Controls();
        new Customize();

    }

}