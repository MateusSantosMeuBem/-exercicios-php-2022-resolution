<?php

namespace Galoa\ExerciciosPhp2022\War\GamePlay\Country;


/**
 * Defines a country that is managed by a human player.
 */
class HumanPlayerCountry extends BaseCountry implements HumanPlayerCountryInterface {
    /**
   * Sets the neighbors options to the history that human player
   * can attack.
   *
   */
  public function setNeighborsHistoryOptions(): void{
    readline_clear_history();
    foreach($this->neighbors as $neighbor){
        if(!$neighbor->isConquered()){
            readline_add_history($neighbor->getName());
        }
    }
  }
}
