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

    // print_r($elements);
    foreach($elements as $ancors){
      
      $ancorsChildren = $ancors->childNodes;

      $title = $ancorsChildren[0]->textContent;
      $dirtyAuthors = $ancorsChildren[1];
      $footer = $ancorsChildren[2];
      $type = $footer->childNodes[0]->textContent;
      $id = $footer->childNodes[1]->childNodes[1]->textContent;

      $authors = array();

      /**
       * Iterates into each author, checks if it's a valid author,
       * so, then, stores them in @var $authors[]
       * 
       */
      foreach($dirtyAuthors->childNodes as $author){
        if($author->nodeName == 'span'){
          /**
           * If the last character of the name is ;, then remove it
           * 
           */
          if($author->textContent[strlen($author->textContent) - 1] == ';'){
            $authorName = substr($author->textContent, 0, strlen($author->textContent) - 1);
          }else{
            $authorName = $author->textContent;
          }

          $authorInstitution = $author->attributes->getNamedItem('title')->nodeValue;

          $authors[$authorName] = $authorInstitution;
        }
      }
    }
  }

}
