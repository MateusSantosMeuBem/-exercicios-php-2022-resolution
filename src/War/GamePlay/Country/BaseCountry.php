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
  protected $neighbors = array();
  protected $troops = 3;
  protected $isConquered = false;
  protected $conquestTurn = 0;
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
    foreach($neighbors as $neighbor){
      array_push($this->neighbors, $neighbor);
    }
  }

  public function getNeighbors(): array{
    return $this->neighbors;
  }
  
  public function getNeighborsNames(): array{

    $neighborsNames = array();

    foreach($this->getNeighbors() as $neighbor){
      array_push($neighborsNames, $neighbor->getName());
    }

    return $neighborsNames;
  }
  public function getNumberOfTroops(): int{
    return $this->troops;
  }

  public function isConquered(): bool{
    if($this->troops == 0){
      $this->isConquered = true;
    }
    return $this->isConquered;
  }

  public function conquer(CountryInterface $conqueredCountry): void{
    $this->setConquestTurn(1);

    $conqueredCountryNeighbors = $conqueredCountry->getNeighbors();

    foreach($conqueredCountryNeighbors as $neighbor){
      // Verify if the conquer country is already neighbor from this country
      $hasNeighbor = in_array($neighbor, $this->getNeighbors());
      // If it is not, it's now. hehe
      if(!$hasNeighbor) {
        $this->setNeighbors(array($neighbor));
        $neighbor->setNeighbors(array($this));
      }    
    }
  }

  public function killTroops(int $killedTroops): void{
    $this->troops -= $killedTroops;
  }

  public function receiveTroops(int $receivedTroops): void{
    $this->troops += $receivedTroops;
  }

  public function getConquestTurn(): int{
    return $this->conquestTurn;
  }

  public function setConquestTurn(int $conquestNumber): void{
    $this->conquestTurn += $conquestNumber;
  }
  
  public function resetConquestTurn(): void{
    $this->conquestTurn = 0;
  }

}
