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
        //$io->out('Query: ' . $args->getArgumentAt(0));

        //$query = $args->getArgumentAt(0);

        $content_type = '';

        $queries =
        [
            'Farmers AND "Technology Adoption" AND "Internet connectivity"',
            'Farmers AND "Technology Adoption" AND Broadband',
            'Farmers AND "Technology Adoption" AND NBN',
            'Agriculture AND "Technology Adoption" AND "Internet connectivity"',
            'Agriculture AND "Technology Adoption" AND Broadband',
            'Agriculture AND "Technology Adoption" AND NBN',
            'Beef AND "Technology Adoption" AND "Internet connectivity"',
            'Beef AND "Technology Adoption" AND Broadband',
            'Beef AND "Technology Adoption" AND NBN',
            'Cropping AND "Technology Adoption\" AND "Internet connectivity"',
            'Cropping AND "Technology Adoption\" AND Broadband',
            'Cropping AND "Technology Adoption\" AND NBN',
            'Graziers AND "Technology Adoption\" AND "Internet connectivity"',
            'Graziers AND "Technology Adoption\" AND Broadband',
            'Graziers AND "Technology Adoption\" AND NBN'
        ];


        foreach ($queries as $query) {
            echo "\r\n    ";
            $io->out('<info>Getting Query: </info>' . $query);

            //Get the first result
            //$data = $this->getJCUData($query, 1, $year, $month,1, $content_type);
            $data = $this->getJCUData($query, 1, 1, 1, 1, "");


            //Save this request
            file_put_contents("/Users/william/OneDrive - HM & W Harrington/PHD/Software/scraping-working-dir/$query-1.json", $data);

            $decoded_data = json_decode($data);

            $total_pages = $decoded_data->record_count;

            $io->out("<warning>      Got $total_pages results </warning>");

            if ($total_pages > 50) {
                $io->out('<warning>      Too many results, getting the first 50 pages</warning>');
                $io->out("   ");
            }

            for ($currnet_page = 2; $currnet_page <= $total_pages; $currnet_page++) {

                $data = $this->getJCUData($query, $currnet_page, 1, 1, 1, $content_type);

                $decoded_data = json_decode($data);

                if (property_exists($decoded_data, 'error')) {
                    break;
                }

                file_put_contents("/Users/william/OneDrive - HM & W Harrington/PHD/Software/scraping-working-dir/$query-$currnet_page.json", $data);
                echo ".";
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

        //$url = "https://jcu-summon-serialssolutions-com.elibrary.jcu.edu.au/api/search?screen_res=W885H821&__refererURL=&pn=$page&ho=t&fvf%5B%5D=ContentType%2C$content_type%2Cf&rf=PublicationDate%2C$year-$month-01%3A$year-$month-31&l=en-AU&q=$query";
        //$url = "https://jcu-summon-serialssolutions-com.elibrary.jcu.edu.au/api/search?screen_res=W894H821&__refererURL=&pn=$page&ho=t&fvf%5B%5D=ContentType%2C$content_type%2Cf&rf%5B%5D=PublicationDate%2C$year-$month-01%3A$year-$month-31&l=en-AU&q=farming%20broadband%20availability%20%22technology%20adoption%22";
        $url = "https://jcu.summon.serialssolutions.com/api/search?screen_res=W894H821&__refererURL=https%3A%2F%2Fjcu.summon.serialssolutions.com%2F&pn=$page&ho=t&l=en-AU&q=$query&rf%5B%5D=PublicationDate%2C2015-03-19%3A2020-03-19";

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
        'Cookie: _ga=GA1.3.97049568.1575106988; _fbp=fb.2.1575106989232.551205872; ELOQUA=GUID=9619B1BDEF2546DB81FA0058E1BACF44; _hjid=0a8e86fa-e343-4c50-9948-3c94ae72bccd; __gads=ID=4686260ab0d9fd82:T=1575150385:S=ALNI_Ma7411hF2NY8LeLBk545ElTk6PCTA; _vwo_uuid_v2=D2699A1264B0921E78E4BFBA2A6833207|7be867f5fcf8dfba34ec9e0f1c04ad12; _vwo_uuid=D2699A1264B0921E78E4BFBA2A6833207; _gcl_au=1.1.1564084817.1582925042; _vwo_ds=3%3Aa_0%2Ct_0%3A0%241583013509%3A27.9604868%3A%3A%3A305_0%3A0; __utma=137054123.97049568.1575106988.1583394904.1583557311.8; __utmz=137054123.1583557311.8.8.utmcsr=jcu.summon.serialssolutions.com|utmccn=(referral)|utmcmd=referral|utmcct=/; _fby_site_=1%7Cjcu.edu.au%7C1583557593%7C1583557593%7C1583557593%7C1583557595%7C1%7C2%7C2; _hp2_id.1083010732=%7B%22userId%22%3A%225332640532485762%22%2C%22pageviewId%22%3A%224104953898002939%22%2C%22sessionId%22%3A%223534586141798888%22%2C%22identity%22%3Anull%2C%22trackerVersion%22%3A%224.0%22%7D; mp_8e8ac8d2dbd2378f29bd1dd9116a0c9a_mixpanel=%7B%22distinct_id%22%3A%20%22170a51d5113303-02b686502c4fc3-17495073-13c680-170a51d511477e%22%2C%22%24device_id%22%3A%20%22170a51d5113303-02b686502c4fc3-17495073-13c680-170a51d511477e%22%2C%22%24initial_referrer%22%3A%20%22https%3A%2F%2Fjcu.summon.serialssolutions.com%2F%22%2C%22%24initial_referring_domain%22%3A%20%22jcu.summon.serialssolutions.com%22%2C%22Name%22%3A%20null%2C%22Organisation%20Name%22%3A%20%22JAMES%20COOK%20UNIVERSITY%22%2C%22Account%20ID%22%3A%20null%2C%22Authentication%20Type%22%3A%20%22ip%22%2C%22Session%20ID%22%3A%20%22laravelidgUUBUwhREXXEXvMFdZWI4YWnCyk5MUkjT42u0i6G%22%2C%22Publisher%20Name%22%3A%20%22Emerald%20Publishing%20Limited%22%7D; _vis_opt_s=4%7C; _vis_opt_test_cookie=1; _gid=GA1.3.383831272.1584606757; ezproxy=0UU8odKgNgPRtSX; optimizelyEndUserId=oeu1584606866317r0.32145179381187083; check=true; AMCVS_4D6368F454EC41940A4C98A6%40AdobeOrg=1; AMCV_4D6368F454EC41940A4C98A6%40AdobeOrg=1075005958%7CMCIDTS%7C18341%7CMCMID%7C34006650138240942084616094989770139900%7CMCAID%7CNONE%7CMCOPTOUT-1584614075s%7CNONE%7CMCAAMLH-1585211675%7C8%7CMCAAMB-1585211675%7Cj8Odv6LonN4r3an7LhD3WZrU1bUpAkFkkiY1ncBR96t2PTI%7CMCSYNCSOP%7C411-18348%7CvVersion%7C4.4.1%7CMCCIDH%7C-148178212; mbox=session#c9de27177e0f4220a382c0295ac56a0f#1584608727|PC#c9de27177e0f4220a382c0295ac56a0f.29_0#1647851904; s_pers=%20s_fid%3D5E8D8D46529C1DA5-074183BB9C7C38E1%7C1733084860117%3B%20c19%3Dsc%253Asearch%253Adocument%2520results%7C1584608912934%3B%20v68%3D1584607102770%7C1584608913022%3B%20v8%3D1584607159926%7C1679215159926%3B%20v8_s%3DLess%2520than%25207%2520days%7C1584608959926%3B; s_sess=%20s_cpc%3D0%3B%20c21%3Dtitle-abs-key%2528agriculture%2520and%2520technology%2520adoption%2520and%2520broadband%2529%3B%20e13%3Dtitle-abs-key%2528agriculture%2520and%2520technology%2520adoption%2520and%2520broadband%2529%253A1%3B%20c13%3Ddate%2520%2528newest%2529%3B%20e41%3D1%3B%20s_cc%3Dtrue%3B%20s_ppvl%3Dsc%25253Asearch%25253Adocument%252520results%252C51%252C51%252C1261%252C1440%252C821%252C1440%252C900%252C2%252CP%3B%20s_sq%3Delsevier-sc-prod%25252Celsevier-global-prod%253D%252526c.%252526a.%252526activitymap.%252526page%25253Dsc%2525253Asearch%2525253Adocument%25252520results%252526link%25253DExport%25252520refine%252526region%25253DclusterFooter%252526pageIDType%25253D1%252526.activitymap%252526.a%252526.c%252526pid%25253Dsc%2525253Asearch%2525253Adocument%25252520results%252526pidt%25253D1%252526oid%25253D%25252520Export%25252520refine%252526oidt%25253D3%252526ot%25253DSUBMIT%3B%20s_ppv%3Dsc%25253Asearch%25253Adocument%252520results%252C93%252C51%252C2303%252C1440%252C821%252C1440%252C900%252C2%252CP%3B'
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
