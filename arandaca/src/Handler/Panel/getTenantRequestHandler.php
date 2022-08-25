<?php

namespace ArandaCa\Handler\Panel;

use ArandaCa\Aranda\Client;
use ArandaCa\Facade\ArandaCaFacade;
use ArandaCa\Contract\ArandaCaRequestHandleInterface;

class getTenantRequestHandler implements ArandaCaRequestHandleInterface {    
    
  protected $aranda;

  protected $args;

  protected $library;

  public function __construct(Client $aranda, ArandaCaFacade $library)
  {
      $this->aranda = $aranda;

      $this->args = $library->getArgs();
      
      $this->library = $library;
  }

  public function handle()
  {        
      return 0;                
  }

  public function formatData()
  {
      
  }

  public function formatResponse($data)
  {

  }
}