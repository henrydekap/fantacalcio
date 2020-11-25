<?php

namespace App\Controller;

use App\Entity\MatchDay;
use App\Entity\Player;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
  /**
   * @Route("/", name="home")
   */
  public function index(EntityManagerInterface $em)
  {
    $player_repo = $em->getRepository(Player::class);
    $player_list = $player_repo->findAll();

    $matchday_repo  = $em->getRepository(MatchDay::class);
    $match_day_list = $matchday_repo->findAll();

    return $this->render('home/index.html.twig', [
      'controller_name' => 'HomeController',
      'player_list'     => $player_list,
      'match_day_list'  => $match_day_list,
    ]);
  }

  /** 
   * @Route("/scrape", name="scrape")
   */
  public function scrape(EntityManagerInterface $em)
  {
    $matchday_repo  = $em->getRepository(MatchDay::class);
    $match_day = $matchday_repo->findOneById(1);

    $match_url = $match_day->getUrl();

    var_dump("Match URL: $match_url");

    $client = new \GuzzleHttp\Client(['cookies' => true]);
    
    //login
    $login_url = $this->getParameter('login_url');
    $login_username = getenv('login_username');
    $login_password = getenv('login_password');
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
      //'__ASYNCPOST' => 'true',
      //'__VIEWSTATEGENERATOR' => 'C2EE9ABB',
      //'__EVENTTARGET' => '',
      //'__EVENTARGUMENT' => '',
      //'__VIEWSTATE' => '/wEPDwUKMTY3MTAyNDQ3Nw9kFgJmD2QWBAIBD2QWBAITDxYCHgRocmVmBR8vY3NzL3N0eWxlLmNzcz9tPTIwMjAxMTE4MTExMDI0ZAIZDxYCHgRUZXh0BUI8bGluayByZWw9ImNhbm9uaWNhbCIgaHJlZj0iaHR0cHM6Ly93d3cuZmFudGEuc29jY2VyL2l0L2xvZ2luLyIgLz5kAgMPFgIeBmFjdGlvbgUKL2l0L2xvZ2luLxYQAgIPFgIfAQUFZmFsc2VkAgUPDxYCHgtOYXZpZ2F0ZVVybAUKL2l0L2xvZ2luL2RkAgYPDxYCHgdWaXNpYmxlaGRkAggPFgIfBGhkAgkPZBYQAgEPFgIfAQUhVUVGQSBDaGFtcGlvbnMgTGVhZ3VlIC0gMjAyMC8yMDIxZAIDDxYCHwEFJW1lcmNvbGVkw6wgMjUgbm92ZW1icmUgMjAyMCBvcmUgMTg6NTVkAgUPDxYEHghJbWFnZVVybAUYL0ltYWdlcy9zY3VkZXR0aS85NzEucG5nHg1BbHRlcm5hdGVUZXh0BQVGYWxzZWRkAgcPFgIfAQUSQm9ydXNzaWEgTUdsYWRiYWNoZAIJDw8WBB8FBRkvSW1hZ2VzL3NjdWRldHRpLzIyNTQucG5nHwYFBUZhbHNlZGQCCw8WAh8BBRBTaGFraHRhciBEb25ldHNrZAINDxYCHwEFhQE8ZGl2IGNsYXNzPSJjb3VudGRvd24gY291bnRkb3duLWNsYXNzaWMiIGRhdGEtdHlwZT0idW50aWwiIGRhdGEtdGltZT0iMjUgTm92IDIwMjAgMTg6NTUiIGRhdGEtZm9ybWF0PSJkaG1zIiBkYXRhLXN0eWxlPSJzaG9ydCI+PC9kaXY+ZAIPDw8WAh8DBT0vaXQvc2VyaWVhLzYyNTk2L3BhcnRpdGEvYm9ydXNzaWFfbWdsYWRiYWNoLXNoYWtodGFyX2RvbmV0c2svZGQCDA9kFgZmDxYCHwEFE0FjY2VkaSAvIFJlZ2lzdHJhdGlkAgIPDxYEHwEFB0FjY291bnQfAwUBI2RkAgMPFgIfAQUVQWNjZWRpIGEgRmFudGEuU29jY2VyZAIOD2QWAgIBD2QWAgILD2QWAmYPZBYGAg0PFgIfAQVTQWNjb25zZW50byBhbCB0cmF0dGFtZW50byBkZWkgbWllaSBkYXRpIHBlcnNvbmFsaSBjb21lIGRhIEluZm9ybWF0aXZhIHN1bGxhIFByaXZhY3lkAg8PFgIfAQVbQWNjb25zZW50byBhbGxhIHJpY2V6aW9uZSBkaSBlbWFpbCBxdWFsaSBub3RpZmljaGUgZS9vIGNvbnRlbnV0aSBkZWxsYSBwaWF0dGFmb3JtYSBkaSBnaW9jb2QCEQ8WAh8BBT1BY2NvbnNlbnRvIGFsbGEgcmljZXppb25lIGRpIGVtYWlsIGNvbiBjb250ZW51dG8gcHJvbW96aW9uYWxlZAIPDxYCHwEFNyA8c3BhbiBjbGFzcz0idGV4dC1zbWFsbCB0ZXh0LWRhcmsiPiAtIDEwLjAuMC42Mjwvc3Bhbj5kGAEFHl9fQ29udHJvbHNSZXF1aXJlUG9zdEJhY2tLZXlfXxYEBS5jdGwwMCRNYWluQ29udGVudCR3dWNfTG9naW4xJGNoa1Jlc3RhQ29sbGVnYXRvBSdjdGwwMCRNYWluQ29udGVudCR3dWNfTG9naW4xJGNoa1ByaXZhY3kFKmN0bDAwJE1haW5Db250ZW50JHd1Y19Mb2dpbjEkY2hrTmV3c2xldHRlcgUjY3RsMDAkTWFpbkNvbnRlbnQkd3VjX0xvZ2luMSRjaGtERU1rQY5GBTaeCk4UIg2RLVsgthbPjQ==',      
    );

    $body = http_build_query($login_params);

    $login_request = new \GuzzleHttp\Psr7\Request('POST', $login_url, $headers, $body);
 
    $r = $client->send($login_request);
    
    $cookieJar = $client->getConfig('cookies');
    if ($auth = $cookieJar->getCookieByName('FantaSoccer_Auth') && $auth->getValue())
    {
      echo "<hr>";
      echo "Login Successful!";
    } else {
      echo "<hr>";
      echo "Login Error!";
      die();
    }

    $match_response = $client->request('GET', $match_url);
    //echo $match_response->getBody();
    libxml_use_internal_errors(true);
    $doc = \DOMDocument::loadHTML($match_response->getBody());

    $xpath = new \DOMXpath($doc);

    
    // Trasferta | Casa
    $elements = $xpath->query("//*[@id='MainContent_wuc_DettagliPartita1_PanelSquadraCasa']/table/thead/tr/th");
    $squadra_casa = $elements[0]->nodeValue;
    
    $nome_squadra = $this->getParameter('nome_squadra');
    if (str_contains($squadra_casa, $nome_squadra)) {
      $posizione = 'Casa';
    } else {
      $posizione = 'Trasferta';
    }
    
    echo "<hr>";
    echo "Squadra $nome_squadra in ".$posizione;
    
    


    // O TO 10
    // MainContent_wuc_DettagliPartita1_rptTitolariCasa_lblTotale_0
    // MainContent_wuc_DettagliPartita1_rptTitolariCasa_lblVoto_0
    // MainContent_wuc_DettagliPartita1_rptTitolariCasa_lblNome_0
    // MainContent_wuc_DettagliPartita1_rptTitolariCasa_ruolo_calciatore_0

    // 0 TO 12
    // MainContent_wuc_DettagliPartita1_rptPanchinariCasa_lblTotale_0
    // MainContent_wuc_DettagliPartita1_rptPanchinariCasa_lblVoto_0
    // MainContent_wuc_DettagliPartita1_rptPanchinariCasa_lblNome_0
    // MainContent_wuc_DettagliPartita1_rptPanchinariCasa_ruolo_calciatore_0

    

    die();

    return $this->render();
  }
}
