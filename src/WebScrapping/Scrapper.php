<?php

namespace Galoa\ExerciciosPhp2022\WebScrapping;

use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use DOMXPath;

/**
 * Does the scrapping of a webpage.
 */
class Scrapper implements ScrapperInterface{

  /**
   * Loads paper information from the HTML and creates a XLSX file.
   */
  public function scrap(\DOMDocument $dom): mixed {
    
    $xpath = new DOMXPath($dom);
    $elements = $xpath->query('//*[@class="col-sm-12 col-md-8 col-lg-8 col-md-pull-4 col-lg-pull-4"]/a');

    $tableKeys = [
      'ID',
      'Title',
      'Type'
    ];

    $rowArray = array();
    $rows = array();
    $largestNumberOfAuthors = 0;

    foreach($elements as $ancor){
      
      $ancorChildren = $ancor->childNodes;

      $title = $ancorChildren[0]->textContent;
      $dirtyAuthors = $ancorChildren[1];
      $footer = $ancorChildren[2];
      $type = $footer->childNodes[0]->textContent;
      $id = $footer->childNodes[1]->childNodes[1]->textContent;


      /**
       * Addint to rowArray
       * 
       */
      $rowArray[] = $id;
      $rowArray[] = $title;
      $rowArray[] = $type;

      $authors = array();

      /**
       * Iterates into each author, checks if it's a valid author,
       * so, then, stores them in @var $authors[]
       * 
       */
      $counter = 0;
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

          $rowArray[] = $authorName;
          $rowArray[] = $authorInstitution;

          $counter++;
        }
        if($counter > $largestNumberOfAuthors){
          $largestNumberOfAuthors = $counter;
        }
      }
      $row = WriterEntityFactory::createRowFromArray($rowArray);
      $rows[] = $row;
      $rowArray = array();
    }
    for($authorNumber = 1; $authorNumber <= $largestNumberOfAuthors; $authorNumber++){
      $tableKeys[] = "Author $authorNumber";
      $tableKeys[] = "Author $authorNumber Institution";
    }
    return [$tableKeys, $rows];
  }

}
