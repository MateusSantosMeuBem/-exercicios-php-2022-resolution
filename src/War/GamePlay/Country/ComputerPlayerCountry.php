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

  // LEMBRAR QUE O COMPUTER TEM A OPÇÃO DE ESCOLHER NÃO ATACAR
  public function chooseToAttack($countriesList): ?CountryInterface {

    $countriesListNames = array_keys($countriesList);
    $try_times = array();

    print_r($countriesListNames);

    $right_country = false;
    while(!$right_country){
      $countryPositionChoise = rand(0, count($countriesListNames) - 1);

      if(!in_array($countryPositionChoise, $try_times)){
        array_push($try_times, $countryPositionChoise);
        $countryChosen = $countriesList[$countriesListNames[$countryPositionChoise]];
        print "Trying attack ". $countryChosen->getName() . "... \n";
        $right_country = $countryChosen->isConquered() ? false : true;
      }else{
        $right_country = count($try_times) == count($countriesListNames) ? true : false;
        $countryChosen = NULL;
        print "\nEsse país não possui vizinhos para a atacar.\n";
      }

    }
    
    return $countryChosen ? $countryChosen : NULL;
  }

}
