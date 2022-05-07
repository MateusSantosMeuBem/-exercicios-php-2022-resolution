<?php

namespace Galoa\ExerciciosPhp2022\War\GamePlay\Country;

/**
 * Defines a country that is managed by the Computer.
 */
class ComputerPlayerCountry extends BaseCountry {

  /**
   * Choose one country to attack, or none.
   *
   * The computer may choose to attack or not. If it chooses not to attack,
   * return NULL. If it chooses to attack, return a neighbor to attack.
   *
   * It must NOT be a conquered country.
   *
   * @return \Galoa\ExerciciosPhp2022\War\GamePlay\Country\CountryInterface|null
   *   The country that will be attacked, NULL if none will be.
   */

  // use \Galoa\ExerciciosPhp2022\War\GamePlay\Country\CountryInterface[];

  public function chooseToAttack($countriesList): ?CountryInterface {

    $this->countriesListNames = array_keys($countriesList);

    $countryPositionChoise = rand(1, count($this->countriesListNames) - 1);
    
    return count($this->countriesListNames) > 0 ? $countriesList[$this->countriesListNames[$countryPositionChoise]] : null;
  }

}
