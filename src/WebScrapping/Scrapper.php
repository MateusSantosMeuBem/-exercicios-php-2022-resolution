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
   * 
   * @return mixed
   * @var array $headerKeys
   * All the keys for the xlsx docuement.
   * @var array $data
   * An array with the document rows.
   * 
   */
  public function scrap(\DOMDocument $dom): mixed {
    
    $xpath = new DOMXPath($dom);
    /**
     * Element with all the aancors elements.
     */
    $elements = $xpath->query('//*[@class="col-sm-12 col-md-8 col-lg-8 col-md-pull-4 col-lg-pull-4"]/a');

    /**
     * Array with non-repeted header keys.
     */
    $tableKeys = [
      'ID',
      'Title',
      'Type'
    ];

    /**
     * @var array
     *  Array to catch all the datas for the current row.
     */
    $rowArray = array();
    /**
     * @var array
     *  Array with all the body rows.
     */
    $rows = array();
    /**
     * @var int
     *  Variable to store the largest number of authors in a ancor item.
     */
    $largestNumberOfAuthors = 0;

    foreach($elements as $ancor){
      
      /**
       * @var mixed
       *  Object storing all the children from the current ancor item.
       */
      $ancorChildren = $ancor->childNodes;
      /**
       * @var string
       *  Current ancor item title.
       */
      $title = $ancorChildren[0]->textContent;
      /**
       * @var mixed
       * Object storing all the authores and some empty texts of the
       * current ancor item.
       */
      $dirtyAuthors = $ancorChildren[1];
      /**
       * Object storing children nodes with type and id of the
       * current ancor item.
       */
      $footer = $ancorChildren[2];
      /**
       * @var string
       *  Current ancor item type.
       */
      $type = $footer->childNodes[0]->textContent;
      /**
       * @var string
       *  Current ancor item footer.
       */
      $id = $footer->childNodes[1]->childNodes[1]->textContent;


      $rowArray[] = $id;
      $rowArray[] = $title;
      $rowArray[] = $type;

      /**
       * Iterates into each author, checks if it's a valid author,
       * so, then, stores them in @var $rowArray[]
       * 
       */
      /**
       * @var int
       *  Current number of authors of this ancor item.
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

          /**
           * @var string
           *  Current author institution.
           */
          $authorInstitution = $author->attributes->getNamedItem('title')->nodeValue;

          $rowArray[] = $authorName;
          $rowArray[] = $authorInstitution;

          $counter++;
        }
        if($counter > $largestNumberOfAuthors){
          $largestNumberOfAuthors = $counter;
        }
      }

      /**
       * @var WriterEntityFactory
       *  Current row object.
       */
      $row = WriterEntityFactory::createRowFromArray($rowArray);
      /**
       * @var mixed
       * Stores all the body row objects.
       */
      $rows[] = $row;
      /**
       * Gets it empty.
       */
      $rowArray = array();
    }
    /**
     * Finishes to create the array with all the header keys.
     */
    for($authorNumber = 1; $authorNumber <= $largestNumberOfAuthors; $authorNumber++){
      $tableKeys[] = "Author $authorNumber";
      $tableKeys[] = "Author $authorNumber Institution";
    }
    return [$tableKeys, $rows];
  }

}
