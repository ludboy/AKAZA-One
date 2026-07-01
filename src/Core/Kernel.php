<?php

namespace AKAZA\Core;
Logger::info("Sistema iniciado");



class Kernel
{

    protected array $services = [];



    public function boot()
    {

        $this->loadConfiguration();

        $this->loadServices();

        return $this;

    }



    protected function loadConfiguration()
{

    Config::load();

}



    protected function loadServices()
    {

        $this->services = [

            'router',
            'database',
            'logger',
            'security'

        ];

    }


}