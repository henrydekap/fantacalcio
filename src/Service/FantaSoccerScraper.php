<?php

namespace App\Service;

use App\Entity\MatchDay;
use App\Entity\Player;
use App\Entity\PlayerVote;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerInterface;

class FantaSoccerScraper implements MatchDayScraperInterface, LoggerAwareInterface
{
  private $logger;
  private $em;
  private $login_url;
  private $login_username;
  private $login_password;
  private $squad_name;
  
  public function __construct(EntityManagerInterface $em, string $login_url, string $login_username, string $login_password, string $squad_name)
  {
    $this->em = $em;
    $this->login_url = $login_url;
    $this->login_username = $login_username;
    $this->login_password = $login_password;
    $this->squad_name = $squad_name;
  }

  /**
   * Sets a logger instance on the object.
   *
   * @param LoggerInterface $logger
   *
   * @return void
   */
  public function setLogger(LoggerInterface $logger)
  {
    $this->logger = $logger;
  }

  public function scrape(MatchDay $match_day): void
  {
    $em = $this->em;
    $match_url = $match_day->getUrl();
    // players info
    $player_repo = $em->getRepository(Player::class);

    $client = new \GuzzleHttp\Client(['cookies' => true]);

    //login
    $login_url = $this->login_url;
    $login_username = $this->login_username;
    $login_password = $this->login_password;

    $this->logger->debug("login_url: ".$login_url);
    $this->logger->debug("login_username: ".$login_username);
    $this->logger->debug("login_password: ".$login_password);

    $headers = array(
        'authority' => 'www.fanta.soccer',
        'pragma' => 'no-cache',
        'cache-control' => 'no-cache',
        'sec-ch-ua' => '"Chromium";v="86", "\"Not\\A;Brand";v="99", "Google Chrome";v="86"',
        'x-requested-with' => 'XMLHttpRequest',
        'x-microsoftajax' => 'Delta=true',
        'sec-ch-ua-mobile' => '?0',
        'user-agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safari/537.36',
        'content-type' => 'application/x-www-form-urlencoded; charset=UTF-8',
        'accept' => '*/*',
        'origin' => 'https://www.fanta.soccer',
        'sec-fetch-site' => 'same-origin',
        'sec-fetch-mode' => 'cors',
        'sec-fetch-dest' => 'empty',
        'referer' => 'https://www.fanta.soccer/it/login/',
        'accept-language' => 'it-IT,it;q=0.9,en-GB;q=0.8,en;q=0.7,et;q=0.6,en-US;q=0.5',
    );

    $login_params = array(
      'ctl00$MainContent$wuc_Login1$username' => $login_username,
      'ctl00$MainContent$wuc_Login1$password' => $login_password,
      'ctl00$MainContent$wuc_Login1$cmbSesso' => 'M',
      'ctl00$MainContent$wuc_Login1$txtNome' => '',
      'ctl00$MainContent$wuc_Login1$txtCognome' => '',
      'ctl00$MainContent$wuc_Login1$txtEmail' => '',
      'ctl00$MainContent$wuc_Login1$txtConfermaEmail' => '',
      'ctl00$MainContent$wuc_Login1$txtUsername' => '',
      'ctl00$MainContent$wuc_Login1$txtPassword' => '',
      'ctl00$MainContent$wuc_Login1$txtConfermaPassword' => '',
      'ctl00$MainContent$wuc_Login1$btnLogin' => 'accedi',
      'ctl00$smFantaSoccer' => 'ctl00$MainContent$wuc_Login1$upLogin|ctl00$MainContent$wuc_Login1$btnLogin',
      '__ASYNCPOST' => 'true',
      '__VIEWSTATEGENERATOR' => 'C2EE9ABB',
      '__EVENTTARGET' => '',
      '__EVENTARGUMENT' => '',
      '__VIEWSTATE' => '/wEPDwUKMTY3MTAyNDQ3Nw9kFgJmD2QWBAIBD2QWBAITDxYCHgRocmVmBR8vY3NzL3N0eWxlLmNzcz9tPTIwMjAxMTE4MTEwODE3ZAIZDxYCHgRUZXh0BUI8bGluayByZWw9ImNhbm9uaWNhbCIgaHJlZj0iaHR0cHM6Ly93d3cuZmFudGEuc29jY2VyL2l0L2xvZ2luLyIgLz5kAgMPFgIeBmFjdGlvbgUKL2l0L2xvZ2luLxYQAgIPFgIfAQUFZmFsc2VkAgUPDxYCHgtOYXZpZ2F0ZVVybAUKL2l0L2xvZ2luL2RkAgYPDxYCHgdWaXNpYmxlaGRkAggPFgIfBGhkAgkPZBYQAgEPFgIfAQUZRXVyb3BhIExlYWd1ZSAtIDIwMjAvMjAyMWQCAw8WAh8BBSNnaW92ZWTDrCAyNiBub3ZlbWJyZSAyMDIwIG9yZSAxODo1NWQCBQ8PFgQeCEltYWdlVXJsBRgvSW1hZ2VzL3NjdWRldHRpLzM1NC5wbmceDUFsdGVybmF0ZVRleHQFBUZhbHNlZGQCBw8WAh8BBQ5QRksgQ1NLQSBTb2ZpYWQCCQ8PFgQfBQUZL0ltYWdlcy9zY3VkZXR0aS8yMTc1LnBuZx8GBQVGYWxzZWRkAgsPFgIfAQUKWW91bmcgQm95c2QCDQ8WAh8BBYUBPGRpdiBjbGFzcz0iY291bnRkb3duIGNvdW50ZG93bi1jbGFzc2ljIiBkYXRhLXR5cGU9InVudGlsIiBkYXRhLXRpbWU9IjI2IE5vdiAyMDIwIDE4OjU1IiBkYXRhLWZvcm1hdD0iZGhtcyIgZGF0YS1zdHlsZT0ic2hvcnQiPjwvZGl2PmQCDw8PFgIfAwUzL2l0L3NlcmllYS82MjY4MC9wYXJ0aXRhL3Bma19jc2thX3NvZmlhLXlvdW5nX2JveXMvZGQCDA9kFgZmDxYCHwEFE0FjY2VkaSAvIFJlZ2lzdHJhdGlkAgIPDxYEHwEFB0FjY291bnQfAwUBI2RkAgMPFgIfAQUVQWNjZWRpIGEgRmFudGEuU29jY2VyZAIOD2QWAgIBD2QWAgILD2QWAmYPZBYGAg0PFgIfAQVTQWNjb25zZW50byBhbCB0cmF0dGFtZW50byBkZWkgbWllaSBkYXRpIHBlcnNvbmFsaSBjb21lIGRhIEluZm9ybWF0aXZhIHN1bGxhIFByaXZhY3lkAg8PFgIfAQVbQWNjb25zZW50byBhbGxhIHJpY2V6aW9uZSBkaSBlbWFpbCBxdWFsaSBub3RpZmljaGUgZS9vIGNvbnRlbnV0aSBkZWxsYSBwaWF0dGFmb3JtYSBkaSBnaW9jb2QCEQ8WAh8BBT1BY2NvbnNlbnRvIGFsbGEgcmljZXppb25lIGRpIGVtYWlsIGNvbiBjb250ZW51dG8gcHJvbW96aW9uYWxlZAIPDxYCHwEFOCA8c3BhbiBjbGFzcz0idGV4dC1zbWFsbCB0ZXh0LWRhcmsiPiAtIDEwLjAuMC4xNTY8L3NwYW4+ZBgBBR5fX0NvbnRyb2xzUmVxdWlyZVBvc3RCYWNrS2V5X18WBAUuY3RsMDAkTWFpbkNvbnRlbnQkd3VjX0xvZ2luMSRjaGtSZXN0YUNvbGxlZ2F0bwUnY3RsMDAkTWFpbkNvbnRlbnQkd3VjX0xvZ2luMSRjaGtQcml2YWN5BSpjdGwwMCRNYWluQ29udGVudCR3dWNfTG9naW4xJGNoa05ld3NsZXR0ZXIFI2N0bDAwJE1haW5Db250ZW50JHd1Y19Mb2dpbjEkY2hrREVNN4vwsYeGREG4bfgjQQ6bRULsdyY=',      
    );

    $body = http_build_query($login_params);

    $login_request = new \GuzzleHttp\Psr7\Request('POST', $login_url, $headers, $body);

    $r = $client->send($login_request);

    $cookieJar = $client->getConfig('cookies');
    $auth = $cookieJar->getCookieByName('FantaSoccer_Auth');
    if ($auth && $auth->getValue())
    {
      $this->logger->debug("Login Successful!");
    } else {
      $this->logger->debug("Login Error!");
      return;
    }

    $this->logger->debug("match_url: $match_url");
    $match_response = $client->request('GET', $match_url);

    libxml_use_internal_errors(true);
    $doc = \DOMDocument::loadHTML($match_response->getBody());

    $xpath = new \DOMXpath($doc);

    // Trasferta | Casa
    $elements = $xpath->query("//*[@id='MainContent_wuc_DettagliPartita1_PanelSquadraCasa']/table/thead/tr/th");
    $squadra_casa = $elements[0]->nodeValue;

    $squad_name = $this->squad_name;
    if (str_contains($squadra_casa, $squad_name)) {
      $posizione = 'Casa';
    } else {
      $posizione = 'Trasferta';
    }

    $this->logger->debug("Squadra $squad_name in ".$posizione);

    // Titolari: O TO 10
    // voto con bonus: MainContent_wuc_DettagliPartita1_rptTitolariCasa_lblTotale_0
    // voto puro: MainContent_wuc_DettagliPartita1_rptTitolariCasa_lblVoto_0
    // nome: MainContent_wuc_DettagliPartita1_rptTitolariCasa_lblNome_0
    // ruolo: MainContent_wuc_DettagliPartita1_rptTitolariCasa_ruolo_calciatore_0
    // entrato/uscito: MainContent_wuc_DettagliPartita1_rptTitolariCasa_imgIcona_0

    $this->logger->debug("Titolari:");
    for ($i = 0; $i <= 10; $i++) {
      $elem_titolari_nome = $xpath->query("//*[@id='MainContent_wuc_DettagliPartita1_rptTitolari".$posizione."_lblNome_$i']");
      $titolari_nome = strip_tags($elem_titolari_nome[0]->nodeValue);

      $elem_titolari_voto = $xpath->query("//*[@id='MainContent_wuc_DettagliPartita1_rptTitolari".$posizione."_lblTotale_$i']");
      $titolari_voto = strip_tags($elem_titolari_voto[0]->nodeValue);
      $titolari_voto = str_replace(',','.',$titolari_voto);
      if ($titolari_voto == '-') $titolari_voto = 0;

      $selected = true;
      $elem_titolari_icona = $xpath->query("//*[@id='MainContent_wuc_DettagliPartita1_rptTitolari".$posizione."_imgIcona_$i']");
      if (count($elem_titolari_icona) > 0) {
        $selected = false;
      }
      
      $player = $player_repo->findOneByName($titolari_nome);
      if ($player) {
        $player_id = $player->getId();
        $this->logger->debug("$i: $titolari_nome | $titolari_voto | $player_id");
        $player_vote = new PlayerVote();
        $player_vote->setPlayer($player);
        $player_vote->setVote($titolari_voto);
        $player_vote->setSelected($selected);
        $match_day->addPlayerVote($player_vote);
        $em->persist($player_vote);
      } else {
        $this->logger->debug("$i: $titolari_nome | $titolari_voto | NON TROVATO!");
      }
    }


    // Panchina: 0 TO 12
    // MainContent_wuc_DettagliPartita1_rptPanchinariCasa_lblTotale_0
    // MainContent_wuc_DettagliPartita1_rptPanchinariCasa_lblVoto_0
    // MainContent_wuc_DettagliPartita1_rptPanchinariCasa_lblNome_0
    // MainContent_wuc_DettagliPartita1_rptPanchinariCasa_ruolo_calciatore_0
    // MainContent_wuc_DettagliPartita1_rptPanchinariCasa_imgIcona_0

    $this->logger->debug("Panchina:");
    $panchina = array();
    for ($i = 0; $i <= 12; $i++) {
      $elem_panchinari_nome = $xpath->query("//*[@id='MainContent_wuc_DettagliPartita1_rptPanchinari".$posizione."_lblNome_$i']");
      $panchinari_nome = strip_tags($elem_panchinari_nome[0]->nodeValue);

      $elem_panchinari_voto = $xpath->query("//*[@id='MainContent_wuc_DettagliPartita1_rptPanchinari".$posizione."_lblTotale_$i']");
      $panchinari_voto = strip_tags($elem_panchinari_voto[0]->nodeValue);
      $panchinari_voto = str_replace(',','.',$panchinari_voto);
      if ($panchinari_voto == '-') $panchinari_voto = 0;

      $selected = false;
      $elem_panchinari_icona = $xpath->query("//*[@id='MainContent_wuc_DettagliPartita1_rptPanchinari".$posizione."_imgIcona_$i']");
      if (count($elem_panchinari_icona) > 0) {
        $selected = true;
      }

      $player = $player_repo->findOneByName($panchinari_nome);
      if ($player) {
        $player_id = $player->getId();
        $this->logger->debug("$i: $panchinari_nome | $panchinari_voto | $player_id");
        $player_vote = new PlayerVote();
        $player_vote->setMatchDay($match_day);
        $player_vote->setPlayer($player);
        $player_vote->setVote($panchinari_voto);
        $player_vote->setSelected($selected);
        $em->persist($player_vote);
      } else {
        $this->logger->debug("$i: $panchinari_nome | $panchinari_voto | NON TROVATO!");
      }
    }
    $em->flush();

  }
}