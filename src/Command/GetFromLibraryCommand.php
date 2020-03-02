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
class GetFromLibraryCommand extends Command
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

        $io->out('<info>Importing data from the JCU Library</info>');
        $io->out('Query: ' . $args->getArgumentAt(0));

        $query = $args->getArgumentAt(0);

        $start_year = "2015";
        $start_month = "1";

        $stop_year = date("Y");
        $stop_month = date("m");

        $content_type = 'Journal Article';

        $io->out('Date range: ' . $start_month . "-" . $start_year . " to " . $stop_month . "-" . $stop_year);

        for ($year = $start_year; $year <= $stop_year; $year++)
        {
            $io->out('<info>Getting data for ' . $year . '</info>');
            for ($month = $start_month; $month <= 12; $month++) {

                if ($year == date("Y") && $month > date("m")) {
                    break;
                }

                $io->out("    <info>Month: $month</info>");

                //Get the first result
                $data = $this->getJCUData($query, 1, $year, $month,1, $content_type);

                //Save this request
                file_put_contents("/Users/william/OneDrive - HM & W Harrington/PHD/Software/scraping-working-dir/$year-$month-01-1.json", $data);

                $decoded_data = json_decode($data);

                $total_pages = $decoded_data->page_count;

                if ($total_pages > 50)
                {
                    $io->out('<warning>Too many results, getting the first 50 pages</warning>');
                }

                for ($currnet_page = 2; $currnet_page <= $total_pages; $currnet_page++) {

                    $data = $this->getJCUData($query, $currnet_page, $year, $month, 1, $content_type);

                    $decoded_data = json_decode($data);

                    if (property_exists($decoded_data, 'error')) {
                        break;
                    }

                    file_put_contents("/Users/william/OneDrive - HM & W Harrington/PHD/Software/scraping-working-dir/$year-$month-01-$currnet_page.json", $data);
                    echo ".";
                }



                //debug ($data);
                //die();


            }
        }

        Log::drop('debug');
        Log::drop('error');
        $io->setLoggers(false);
        restore_error_handler();
        restore_exception_handler();


    }

    private function getJCUData($query, $page, $year, $month, $day, $content_type)
    {
        $month = str_pad(strval($month), 2, '0',  STR_PAD_LEFT);
        $day = str_pad(strval($day), 2, '0',  STR_PAD_LEFT);

        $url = "https://jcu.summon.serialssolutions.com/api/search?screen_res=W885H821&__refererURL=&pn=$page&ho=t&fvf%5B%5D=ContentType%2C$content_type%2Cf&rf=PublicationDate%2C$year-$month-01%3A$year-$month-31&l=en-AU&q=$query";

        $url = str_replace(" ", "%20" , $url);

        //debug ($url);

        $headers = [
        'Connection: keep-alive',
        'Cache-Control: max-age=0',
        'Upgrade-Insecure-Requests: 1',
        'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/82.0.4056.0 Safari/537.36 Edg/82.0.432.3',
        'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
        'Sec-Fetch-Site: none',
        'Sec-Fetch-Mode: navigate',
        'Sec-Fetch-User: ?1',
        'Sec-Fetch-Dest: document',
        'Accept-Language: en-AU,en-GB;q=0.9,en;q=0.8,en-US;q=0.7',
        'Cookie: _ga=GA1.2.981802271.1575153713; __utmc=157975585; __utmz=157975585.1582942495.16.12.utmcsr=jcu.edu.au|utmccn=(referral)|utmcmd=referral|utmcct=/library; hasSavedItems=1; __utma=157975585.1926423350.1575150294.1582942523.1582942523.20'
        ];

        $output = $this->cUrlGetData($url, [], $headers);

        //debug ($output);

        return $output;
    }

    function cUrlGetData($url, $post_fields = null, $headers = null) {
        $ch = curl_init();
        $timeout = 5;
        curl_setopt($ch, CURLOPT_URL, $url);
        if ($post_fields && !empty($post_fields)) {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
        }
        if ($headers && !empty($headers)) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $data = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);
        return $data;
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
