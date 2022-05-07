<?php

namespace Galoa\ExerciciosPhp2022\War\GameManager;

/**
 * ..........................
 */
class Main {

  /**
   * Main runner of the game UI.
   */
  public static function run(): void {
    print "#########################################\n";
    print "###      It's raining in the War      ###\n";
    print "#########################################\n";

    $game = Game::create();
    $game->play();
    $game->results();

    print "\n";
  }

}
