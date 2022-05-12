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
  /**
   * The neighbors of the country.
   *
   * @var array
   */
  protected $neighbors = array();
  /**
   * The number of troops of the country.
   *
   * @var int
   */
  protected $troops = 3;
  /**
   * Flag informing if this country is already conquered.
   *
   * @var bool
   */
  protected $isConquered = false;
  /**
   * The number of conquest of the country by round.
   *
   * @var bool
   * In the end of each round, this varaiable is setted to 0.
   */
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
  /**
   * @return string
   * The country's name.
   *
   */                                                                                                                                                                      
  
  public function getName(): string{
    return $this->name;
  } 
  /**
   * Sets the country's neighbors.
   *
   * @param CountryInterface[] $neighbors
   *   Array with neighbors for the country.
   */
  
  public function setNeighbors(array $neighbors): void{
    foreach($neighbors as $neighbor){
      array_push($this->neighbors, $neighbor);
    }
  }
  /**
   * @return CountryInterface[]
   *  The country's neighbors.
   *
   */
  
  public function getNeighbors(): array{
    return $this->neighbors;
  }
  /**
   * @return array
   *  The country's neighbors names.
   *
   */
  
  public function getNeighborsNames(): array{
    
    $neighborsNames = array();
    
    foreach($this->getNeighbors() as $neighbor){
      array_push($neighborsNames, $neighbor->getName());
    }
    
    return $neighborsNames;
  }
  /**
   * @return int
   *  The troops number of the country.
   *
   */
  
  public function getNumberOfTroops(): int{
    return $this->troops;
  }
  /**
   * @return bool
   *  If the country is already conquered.
   *
   */
  
  public function isConquered(): bool{
    if($this->troops == 0){
      $this->isConquered = true;
    }
    return $this->isConquered;
  }
  /**
   * Conquers a country. It makes that all the conquered country neighbors that are
   * not this country's neightbors, turn it up.
   *
   * @param CountryInterface $conqueredCountry
   *   The conquered country.
   */

  public function conquer(CountryInterface $conqueredCountry): void{
    $this->setConquestTurn(1);

    /**
     * @var CountryInterface[]
     *  All the neighbors of the conquered country.
     * 
     */
    $conqueredCountryNeighbors = $conqueredCountry->getNeighbors();

    foreach($conqueredCountryNeighbors as $neighbor){
      $isSelfCountry = $neighbor == $this;
      /**
       * Verify if the conquer country is already neighbor from this country.
       * 
       */
      $hasNeighbor = in_array($neighbor, $this->getNeighbors()) || $isSelfCountry;
      if(!$hasNeighbor) {
        $this->setNeighbors(array($neighbor));
      }
      /**
       * Verify if the neighbor country is already neighbor from conquer country.
       * 
       */
      $hasNeighbor = in_array($this, $neighbor->getNeighbors()) || $isSelfCountry;
      if(!$hasNeighbor) {
        $neighbor->setNeighbors(array($this));
      }    
    }
  }
  /**
   * Decreases the number of troops in this country by a given number.
   *
   * @param int $killedTroops
   *   The number of troops killed in battle.
   */

  public function killTroops(int $killedTroops): void{
    $this->troops -= $killedTroops;
  }

  /**
   * Increases the number of troops in this country by a given number.
   *
   * @param int $receivedTroops
   *   The number of troops received in round's end.
   */
  public function receiveTroops(int $receivedTroops): void{
    $this->troops += $receivedTroops;
  }

  /**
   * 
   * Returns how many countries this country conquested in
   * this round.
   * 
   * @return int
   *   
   */
  public function getConquestTurn(): int{
    return $this->conquestTurn;
  }

  /**
   * Set how many countries this country conquested in
   * this round.
   *
   * @param int $conquestNumber
   *   
   */
  public function setConquestTurn(int $conquestNumber): void{
    $this->conquestTurn += $conquestNumber;
  }
  
  /**
   * Resets this country conquested number countries in
   * this round.
   *
   *   
   */
  public function resetConquestTurn(): void{
    $this->conquestTurn = 0;
  }

}
