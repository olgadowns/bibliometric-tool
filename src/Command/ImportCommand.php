<?php
declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     3.0.0
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Command;

use Cake\Console\Arguments;
use Cake\Console\Command;
use Cake\Console\ConsoleIo;
use Cake\Console\ConsoleOptionParser;
use Cake\Log\Log;

use App\Model\Entity\Query;
use App\Model\Entity\Paper;
use App\Model\Entity\Keyword;
use Cake\ORM\TableRegistry;




/**
 * Import File.
 */
class ImportCommand extends Command
{
    /**
     * Start the Command and interactive console.
     *
     * @param \Cake\Console\Arguments $args The command arguments.
     * @param \Cake\Console\ConsoleIo $io The console io
     * @return int|null|void The exit code or null for success
     */
    public function execute(Arguments $args, ConsoleIo $io)
    {

      $io->out("You can exit with <info>`CTRL-C`</info> or <info>`exit`</info>");
      $io->out('');

      $directory = $args->getArgumentAt(0);

      $files = array_diff(scandir($directory), array('..', '.'));

      //$files = ['2016-3-5.json'];

      foreach ($files as $filename)
      {
        if (pathinfo($filename, PATHINFO_EXTENSION) == "json")
        {
          echo ("Processing: $filename\r\n" );

          $contents = file_get_contents($args->getArgumentAt(0) . "/" . $filename);

          if ($contents == "")
          {
            continue;
          }

          $data = json_decode($contents);

          if ($data != NULL && !property_exists($data, "query"))
            {
              debug ("Skipping bad file");
              continue;
            }

          if ($data->query != NULL && !property_exists($data->query, "original_query"))
            {
              debug ("Skipping bad file, no query");
              continue;
            }


          $query_text = $data->query->original_query; //['original_query'];
          $query_db = "JCU";

          //Get the query
          $queriesTable = TableRegistry::getTableLocator()->get('Queries');

          $query = $queriesTable->find()->where(['query' => $query_text])->first();

          //debug ($query);

          if ($query == null)
          {
            $new_query = $queriesTable->newEntity([
              'query' => $query_text,
              'from_database' => "JCU",
              'date_from' => '2015-01-01',
              'date_to' => '2020-12-01',
              'number_of_results' => 1
            ]);
            $query = $queriesTable->save($new_query);
          }


          //debug ($query->id);

          $papers = $data->documents;

          $papersTable = TableRegistry::getTableLocator()->get('Papers');
          $authorsTable = TableRegistry::getTableLocator()->get('Authors');
          $keywordTable = TableRegistry::getTableLocator()->get('Keywords');
          $papersKeyWordsTable = TableRegistry::getTableLocator()->get('PapersKeywords');
          $papersAuthorsTable = TableRegistry::getTableLocator()->get('AuthorsPapers');
          $papersQuerysTable = TableRegistry::getTableLocator()->get('PapersQueries');
          $contentTypeTable = TableRegistry::getTableLocator()->get('ContentTypes');

          foreach ($papers as $paper) {
            //Does the paper exits?

            if (sizeof($paper->abstracts) > 0)
            {

              //debug ($paper->abstracts[0]->abstract);

              $db_paper = $papersTable->find()
                ->where(['title' => $paper->title, 'abstract' => $paper->abstracts[0]->abstract])->first();

              echo ".";

              if ($db_paper == null)
              {

                  //Get the content type
                  $ct = $contentTypeTable->find()->where(['content_type' => $paper->content_type])->first();

                  if ($ct == null)
                  {
                    //Add dthe key word
                    $newCT = $contentTypeTable->newEntity([
                      'content_type' => $paper->content_type
                    ]);

                    $contentTypeTable->save($newCT);
                    $ct = $newCT;
                  }



                  if ($data == null)
                  {
                    $date = "2015-01-01";
                  }
                  else {
                    $date = $paper->publication_date;
                    //debug ($date);

                    if (strpos($paper->publication_date, "/") !== false) {
                      //debug ("Has a /");
                      $date = explode ("/", $paper->publication_date)[1] . "-" . explode ("/", $paper->publication_date)[0] . "-01";
                    }
                    else {
                      $date = $paper->publication_date . "-01-01";
                    }
                  }
                    //Paper doesnt exist
                    $new_paper = $papersTable->newEntity([
                      'title' => $paper->title,
                      'title' => $paper->title,
                      'abstract' => $paper->abstracts[0]->abstract,
                      'url' => $paper->fulltext_link,

                      'publication_date' => $date,
                      'publication' => $paper->publication_title,
                      'content_type_id' => $ct->id,
                      'language' => $paper->languages[0],
                      'include' => 3,
                      'rating' => -1
                    ]);

                    if ($paper->has_fulltext)
                    {
                      $new_paper->has_fulltext = 1;
                    }
                    else {
                      $new_paper->has_fulltext = 0;
                    }

                    if ($paper->is_peer_reviewed)
                    {
                      $new_paper->is_peer_reviewed = 1;
                    }
                    else {
                      $new_paper->is_peer_reviewed = 0;
                    }

                    if (property_exists($paper, "pqids"))
                    {
                      $new_paper->pqid = $paper->pqids[0];
                    }
                    else {
                      $new_paper->pqid = "";
                    }

                    if (property_exists($paper, "dois"))
                    {
                      $new_paper->doi = $paper->dois[0];
                    }
                    else {
                      $new_paper->doi = "";
                    }

                    if (property_exists($paper, "eissns"))
                    {
                      $new_paper->eissn = $paper->eissns[0];
                    }
                    else {
                      $new_paper->eissn = "";
                    }

                    if (property_exists($paper, "ssid"))
                    {
                      $new_paper->ssid = $paper->ssids[0];
                    }
                    else {
                      $new_paper->ssid = "";
                    }

                    if (property_exists($paper, "issns"))
                    {
                      $new_paper->issn = $paper->issns[0];
                    }
                    else {
                      $new_paper->issn = "";
                    }



                    $result = $papersTable->save($new_paper);
                    //debug ($new_paper);

                    //Add the PapersQuery
                    $pq = $papersQuerysTable->newEntity([
                      'paper_id' => $new_paper->id,
                      'query_id' => $query->id
                    ]);
                    $papersQuerysTable->save($pq);


                    if (property_exists($paper, "subject_terms"))
                      {
                      foreach ($paper->subject_terms as $word) {

                        $keyWord = $keywordTable->find()->where(['word' => $word])->first();
                        //debug ($keyWord);
                        if ($keyWord == null)
                        {
                          //Add dthe key word
                          $keyWord = $keywordTable->newEntity([
                            'word' => trim(strtolower($word))
                          ]);
                          $keyWord = $keywordTable->save($keyWord);
                        }

                        //Map the key word to the Paper
                        $pkw = $papersKeyWordsTable->newEntity([
                          'paper_id' => $new_paper->id,
                          'keyword_id' => $keyWord->id
                        ]);

                        $kwr = $papersKeyWordsTable->save($pkw);
                        //debug ($pkw);
                      }
                    }

                    foreach ($paper->authors as $author) {
                      //debug ($author);

                      $a = $authorsTable->find()->where(['name' => $author->fullname])->first();

                      //debug ($a);

                      if ($a == null)
                      {
                        //Add dthe key word
                        $newAuthor = $authorsTable->newEntity([
                          'name' => $author->fullname
                        ]);

                        $a = $authorsTable->save($newAuthor);
                        //debug ($newAuthor);
                        $a = $newAuthor;
                      }

                      //debug ($a);

                      //Map the key word to the Paper
                      $apw = $papersAuthorsTable->newEntity([
                        'paper_id' => $new_paper->id,
                        'author_id' => $a->id
                      ]);

                      $apw = $papersAuthorsTable->save($apw);
                      //debug ($pkw);
                    }

                    //debug ($result);
              }
            }

          }

          echo "\r\n\r\nProcessed " . sizeof($papers) . " papers\r\n";

            /*if (!class_exists('Psy\Shell')) {
                $io->err('<error>Unable to load Psy\Shell.</error>');
                $io->err('');
                $io->err('Make sure you have installed psysh as a dependency,');
                $io->err('and that Psy\Shell is registered in your autoloader.');
                $io->err('');
                $io->err('If you are using composer run');
                $io->err('');
                $io->err('<info>$ php composer.phar require --dev psy/psysh</info>');
                $io->err('');

                return static::CODE_ERROR;
            }*/
          }
        }

        Log::drop('debug');
        Log::drop('error');
        $io->setLoggers(false);
        restore_error_handler();
        restore_exception_handler();


    }

    /**
     * Display help for this console.
     *
     * @param \Cake\Console\ConsoleOptionParser $parser The parser to update
     * @return \Cake\Console\ConsoleOptionParser
     */
    public function buildOptionParser(ConsoleOptionParser $parser): ConsoleOptionParser
    {
        $parser->setDescription(
            'This shell provides a REPL that you can use to interact with ' .
            'your application in a command line designed to run PHP code. ' .
            'You can use it to run adhoc queries with your models, or ' .
            'explore the features of CakePHP and your application.' .
            "\n\n" .
            'You will need to have psysh installed for this Shell to work.'
        );

        return $parser;
    }
}
