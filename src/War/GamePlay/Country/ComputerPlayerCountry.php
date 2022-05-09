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
    $countryChosen = NULL;

    // It decides if the country will attack or not
    // 0 do not attack
    // 1 do attack
    if(rand(0, 1)){
      $right_country = false;
      while(!$right_country){
        $countryPositionChoise = rand(0, count($countriesListNames) - 1);

        $countryChosen = $countriesList[$countriesListNames[$countryPositionChoise]];
        $right_country = $countryChosen->isConquered() ? false : true;
      }
    }else{
      print "Esse país escolheu não atacar.\n\n";
    }

    return $countryChosen;
  }

}
