<?php

namespace Galoa\ExerciciosPhp2022\War\GamePlay;

use Galoa\ExerciciosPhp2022\War\GamePlay\Country\CountryInterface;

/**
 * A manager that will roll the dice and compute the winners of a battle.
 */
class Battlefield implements BattlefieldInterface {

    public function rollDice(CountryInterface $country, bool $isAtacking): array{

        $dice_times = $country->getNumberOfTroops();

        // This will generate an array with $dice_times random numbers from 1 to 6:
        $player_dices = array_map(function () {
            return rand(1, 6);
        }, array_fill(0, $dice_times, null));

        // Sorte from the biggest to the smallest one
        rsort($player_dices);

        return $player_dices;
    }
    
    public function computeBattle(CountryInterface $attackingCountry, array $attackingDice, CountryInterface $defendingCountry, array $defendingDice): void{
        
    }
}
