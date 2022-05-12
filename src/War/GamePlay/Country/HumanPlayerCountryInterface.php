<?php

namespace Galoa\ExerciciosPhp2022\War\GamePlay\Country;

interface HumanPlayerCountryInterface {
     /**
   * Sets the neighbors options to the history that human player
   * can attack.
   *
   */
  public function setNeighborsHistoryOptions(): void;

}