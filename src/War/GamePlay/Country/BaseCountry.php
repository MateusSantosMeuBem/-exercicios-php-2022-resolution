<?php

namespace Galoa\ExerciciosPhp2022\War\GamePlay\Country;

/**
 * Defines a country, that is also a player.
 */
class BaseCountry implements CountryInterface {

  /**
   * The name of the country.
   *
   * @var string
   */
  protected $name;
  protected $neighbors = array(0 => "arroz");
  protected $test = 'a';
  protected $troops = 0;
  protected $isConquered = false;
  /**
   * Builder.
   *
   * @param string $name
   *   The name of the country.
   */
  
  public function __construct(string $name) {
    $this->name = $name;
  }
  
  public function getName(): string{
    return $this->name;
  }
  
  public function setNeighbors(array $neighbors): void{
    $this->neighbors = array(0 => "batata");
  }

  public function getNeighbors(): array{
    return $this->neighbors;
  }

  public function getNumberOfTroops(): int{
    return $this->troops;
  }

  public function isConquered(): bool{
    return $this->isConquered;
  }

  public function conquer(CountryInterface $conqueredCountry): void{

  }

  public function killTroops(int $killedTroops): void{
    
  }

}
