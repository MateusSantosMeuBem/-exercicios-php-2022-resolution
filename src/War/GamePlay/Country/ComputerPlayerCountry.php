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
  public function chooseToAttack($countriesList): ?CountryInterface {

    /**
     * A array list with all attacker neighbors.
     * 
     * @var array
     * 
     */
    $countriesListNames = array_keys($countriesList);
    /**
     * Which country to attack or null if the country will
     * not attack.
     * 
     * @var \Galoa\ExerciciosPhp2022\War\GamePlay\Country\CountryInterface|null
     * 
     */
    $chosenCountry = NULL;

    // 
    /**
     * Decides if the country will attack or not
     * 0 do not attack
     * 1 do attack
     * 
     */
    if(rand(0, 1)){
      $right_country = false;
      while(!$right_country){
        $countryPositionChoise = rand(0, count($countriesListNames) - 1);
        
        /**
         * Chosen country to be attacked
         * 
         * @var \Galoa\ExerciciosPhp2022\War\GamePlay\Country\CountryInterface
         * 
         */
        $chosenCountry = $countriesList[$countriesListNames[$countryPositionChoise]];
        $right_country = $chosenCountry->isConquered() ? false : true;
      }
    }else{
      print "Esse país escolheu não atacar.\n\n";
    }

    return $chosenCountry;
  }

}
