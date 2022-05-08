<?php

namespace Galoa\ExerciciosPhp2022\War\GamePlay;

use Galoa\ExerciciosPhp2022\War\GamePlay\Country\CountryInterface;

/**
 * A manager that will roll the dice and compute the winners of a battle.
 */
class Battlefield implements BattlefieldInterface {

    public function rollDice(CountryInterface $country, bool $isAtacking): array{

        $dice_times = $country->getNumberOfTroops();

        // This will generate an array with $dice_times if it's a defender, $dice_times - 1 if it's a attacker random numbers from 1 to 6:
        $player_dices = array_map(function () {
            return rand(1, 6);
        }, array_fill(0, !$isAtacking ? $dice_times : $dice_times - 1, null));

        // Sorte from the biggest to the smallest one
        rsort($player_dices);

        return $player_dices;
    }
    
    public function computeBattle(CountryInterface $attackingCountry, array $attackingDice, CountryInterface $defendingCountry, array $defendingDice): void{
        
        $attackingCountryNumber0fTroops = $attackingCountry->getNumberOfTroops();
        $defendingCountryNumber0fTroops = $defendingCountry->getNumberOfTroops();

        if($attackingCountryNumber0fTroops <= $defendingCountryNumber0fTroops){
            foreach($attackingDice as $index => $attackDice){
                $defendDice = $defendingDice[$index];
                // Kill loser troop
                $attackDice > $defendDice ? $defendingCountry->killTroops(1) : $attackingCountry->killTroops(1);
            }
        }else{
            foreach($defendingDice as $index => $defendDice){
                $attackDice = $attackingDice[$index];
                // Kill loser troop
                $attackDice > $defendDice ? $defendingCountry->killTroops(1) : $attackingCountry->killTroops(1);
            }
        }

    }
}
