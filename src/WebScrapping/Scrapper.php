<?php

namespace Galoa\ExerciciosPhp2022\WebScrapping;

use DOMXPath;

/**
 * Does the scrapping of a webpage.
 */
class Scrapper {

  /**
   * Loads paper information from the HTML and creates a XLSX file.
   */
  public function scrap(\DOMDocument $dom): void {
    // print $dom->saveHTML();
    
    $xpath = new DOMXPath($dom);
    $elements = $xpath->query('//*[@class="col-sm-12 col-md-8 col-lg-8 col-md-pull-4 col-lg-pull-4"]/a');

    print_r($elements);
    foreach($elements as $ancors){
      foreach($ancors->childNodes as $counter => $subAncors){
        print_r("$counter - " . $subAncors->nodeValue. "\n");
      }
      print "\n\n";
    }
  }

}
