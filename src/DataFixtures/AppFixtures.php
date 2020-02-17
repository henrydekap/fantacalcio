<?php

namespace App\DataFixtures;

use App\Entity\MatchDay;
use App\Entity\PlayerVote;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Player;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Validator\Constraints\Collection;

class AppFixtures extends Fixture
{

  /**
   * @param EntityManagerInterface $manager
   * @throws \Exception
   */
  public function load(ObjectManager $manager)
  {
    // players
    $player = new Player();
    $player->setName("Musso J.(Udi)");
    $player->setRole("P");
    $manager->persist($player);

    $player = new Player();
    $player->setName("Cragno A.(Cag)");
    $player->setRole("P");
    $manager->persist($player);

    $player = new Player();
    $player->setName("Olsen R.(Cag)");
    $player->setRole("P");
    $manager->persist($player);

    $player = new Player();
    $player->setName("Di Lorenzo G.(Nap)");
    $player->setRole("D");
    $manager->persist($player);

    $player = new Player();
    $player->setName("Skriniar M.(Int)");
    $player->setRole("D");
    $manager->persist($player);

    $player = new Player();
    $player->setName("Tomiyasu T.(Bol)");
    $player->setRole("D");
    $manager->persist($player);

    $player = new Player();
    $player->setName("Barreca A.(Gen)");
    $player->setRole("D");
    $manager->persist($player);

    $player = new Player();
    $player->setName("Depaoli F.(Sam)");
    $player->setRole("D");
    $manager->persist($player);

    $player = new Player();
    $player->setName("Bereszynski B.(Sam)");
    $player->setRole("D");
    $manager->persist($player);

    $player = new Player();
    $player->setName("Martella B.(Bre)");
    $player->setRole("D");
    $manager->persist($player);

    $player = new Player();
    $player->setName("Spinazzola L.(Rom)");
    $player->setRole("D");
    $manager->persist($player);

    $player = new Player();
    $player->setName("Calabria D.(Mil)");
    $player->setRole("D");
    $manager->persist($player);

    $player = new Player();
    $player->setName("Rincon T.(Tor)");
    $player->setRole("C");
    $manager->persist($player);

    $player = new Player();
    $player->setName("Pellegrini L.(Rom)");
    $player->setRole("C");
    $manager->persist($player);

    $player = new Player();
    $player->setName("Linetty K.(Sam)");
    $player->setRole("C");
    $manager->persist($player);

    $player = new Player();
    $player->setName("Can E.(Juv)");
    $player->setRole("C");
    $manager->persist($player);

    $player = new Player();
    $player->setName("Ramsey A.(Juv)");
    $player->setRole("C");
    $manager->persist($player);

    $player = new Player();
    $player->setName("Petriccione J.(Lec)");
    $player->setRole("C");
    $manager->persist($player);

    $player = new Player();
    $player->setName("Bennacer I.(Mil)");
    $player->setRole("C");
    $manager->persist($player);

    $player = new Player();
    $player->setName("Allan .(Nap)");
    $player->setRole("C");
    $manager->persist($player);

    $player = new Player();
    $player->setName("Amrabat S.(Hel)");
    $player->setRole("C");
    $manager->persist($player);

    $player = new Player();
    $player->setName("Mertens D.(Nap)");
    $player->setRole("A");
    $manager->persist($player);

    $player = new Player();
    $player->setName("Immobile C.(Laz)");
    $player->setRole("A");
    $manager->persist($player);

    $player = new Player();
    $player->setName("Ilicic J.(Ata)");
    $player->setRole("A");
    $manager->persist($player);

    $player = new Player();
    $player->setName("Insigne L.(Nap)");
    $player->setRole("A");
    $manager->persist($player);

    $player = new Player();
    $player->setName("Palacio R.(Bol)");
    $player->setRole("A");
    $manager->persist($player);

    $player = new Player();
    $player->setName("Caicedo F.(Laz)");
    $player->setRole("A");
    $manager->persist($player);


    $match_date = new DateTime('2019-08-25');
    for ($i = 1; $i <= 36; $i++) {
      $match = new MatchDay();
      $match->setNumber($i);
      $match->setMatchDate($match_date);
      $manager->persist($match);
      $match_day_list[$i] = $match;

      $match_date->add(new \DateInterval("P7D"));
    }


    $manager->flush();

    // 1
    $conn = $manager->getConnection();
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Olsen R.(Cag)'), 1, 6, 1, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Di Lorenzo G.(Nap)'), 1, 7, 1, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Skriniar M.(Int)'), 1, 6, 1, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Tomiyasu T.(Bol)'), 1, 5.75, 1, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Barreca A.(Gen)'), 1, 5.5, 1, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Rincon T.(Tor)'), 1, 6, 1, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Pellegrini L.(Rom)'), 1, 8.75, 1, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Linetty K.(Sam)'), 1, 5.5, 1, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Mertens D.(Nap)'), 1, 14.75, 1, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Immobile C.(Laz)'), 1, 9.25, 1, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Ilicic J.(Ata)'), 1, 5.25, 1, FALSE);");

    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Insigne L.(Nap)'), 1, 6, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Palacio R.(Bol)'), 1, 11, 0, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Caicedo F.(Laz)'), 1, 6, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Can E.(Juv)'), 1, null, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Ramsey A.(Juv)'), 1, null, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Petriccione J.(Lec)'), 1, null, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Bennacer I.(Mil)'), 1, null, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Allan .(Nap)'), 1, null, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Depaoli F.(Sam)'), 1, null, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Bereszynski B.(Sam)'), 1, 5.5, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Martella B.(Bre)'), 1, null, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Spinazzola L.(Rom)'), 1, 6, 0, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Musso J.(Udi)'), 1, 6.5, 0, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Cragno A.(Cag)'), 1, null, 0, FALSE);");

    //2
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Olsen R.(Cag)'), 2, 5.25, 1, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Skriniar M.(Int)'), 2, 6.5, 1, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Bereszynski B.(Sam)'), 2, 6.5, 1, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Tomiyasu T.(Bol)'), 2, 4.75, 1, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Spinazzola L.(Rom)'), 2, 6.5, 1, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Pellegrini L.(Rom)'), 2, 7, 1, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Linetty K.(Sam)'), 2, 6, 1, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Rincon T.(Tor)'), 2, 5.75, 1, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Immobile C.(Laz)'), 2, 11, 1, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Insigne L.(Nap)'), 2, 10.75, 1, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Ilicic J.(Ata)'), 2, 9.5, 1, TRUE);");

    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Barreca A.(Gen)'), 2, null, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Musso J.(Udi)'), 2, 6, 0, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Cragno A.(Cag)'), 2, null, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Mertens D.(Nap)'), 2, null, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Palacio R.(Bol)'), 2, null, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Caicedo F.(Laz)'), 2, 6.25, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Can E.(Juv)'), 2, null, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Ramsey A.(Juv)'), 2, 9.5, 0, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Bennacer I.(Mil)'), 2, null, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Petriccione J.(Lec)'), 2, 5.5, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Allan .(Nap)'), 2, null, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Depaoli F.(Sam)'), 2, 6.75, 0, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Di Lorenzo G.(Nap)'), 2, null, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Martella B.(Bre)'), 2, null, 0, FALSE);");

    //3
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Musso J.(Udi)'), 3, 8, 1, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Barreca A.(Gen)'), 3, 6, 1, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Di Lorenzo G.(Nap)'), 3, 5.75, 1, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Skriniar M.(Int)'), 3, 6, 1, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Spinazzola L.(Rom)'), 3, 6.25, 1, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Bennacer I.(Mil)'), 3, 5.75, 1, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Pellegrini L.(Rom)'), 3, 5.25, 1, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Ramsey A.(Juv)'), 3, 6.5, 1, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Immobile C.(Laz)'), 3, 5.25, 1, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Insigne L.(Nap)'), 3, 5.25, 1, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Mertens D.(Nap)'), 3, 6.25, 1, TRUE);");

    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Palacio R.(Bol)'), 3, 6, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Ilicic J.(Ata)'), 3, 5.75, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Caicedo F.(Laz)'), 3, 6.5, 0, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Rincon T.(Tor)'), 3, 6.25, 0, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Allan .(Nap)'), 3, 4.75, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Petriccione J.(Lec)'), 3, 6.25, 0, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Linetty K.(Sam)'), 3, null, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Can E.(Juv)'), 3, null, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Depaoli F.(Sam)'), 3, 5.25, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Tomiyasu T.(Bol)'), 3, 5.75, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Bereszynski B.(Sam)'), 3, 4.75, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Martella B.(Bre)'), 3, 6.25, 0, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Olsen R.(Cag)'), 3, 8, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Cragno A.(Cag)'), 3, null, 0, FALSE);");

    //4
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Olsen R.(Cag)'), 4, 5.25, 1, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Spinazzola L.(Rom)'), 4, 6, 1, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Skriniar M.(Int)'), 4, 5, 1, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Di Lorenzo G.(Nap)'), 4, 6.5, 1, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Ramsey A.(Juv)'), 4, 6, 1, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Pellegrini L.(Rom)'), 4, 5.75, 1, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Bennacer I.(Mil)'), 4, 3.25, 1, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Allan .(Nap)'), 4, 6.5, 1, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Ilicic J.(Ata)'), 4, 7.25, 1, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Mertens D.(Nap)'), 4, 9.75, 1, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Immobile C.(Laz)'), 4, 11, 1, TRUE);");

    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Musso J.(Udi)'), 4, 7, 0, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Cragno A.(Cag)'), 4, null, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Insigne L.(Nap)'), 4, null, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Palacio R.(Bol)'), 4, 5.5, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Caicedo F.(Laz)'), 4, 9.5, 0, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Rincon T.(Tor)'), 4, null, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Petriccione J.(Lec)'), 4, 6.25, 0, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Linetty K.(Sam)'), 4, 5.5, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Can E.(Juv)'), 4, 5.75, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Tomiyasu T.(Bol)'), 4, 5.75, 0, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Barreca A.(Gen)'), 4, 5, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Bereszynski B.(Sam)'), 4, 5.25, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Depaoli F.(Sam)'), 4, 5.25, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Martella B.(Bre)'), 4, 5, 0, FALSE);");

    //5
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Musso J.(Udi)'), 5, 5.75, 1, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Di Lorenzo G.(Nap)'), 5, 6.5, 1, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Martella B.(Bre)'), 5, 6, 1, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Skriniar M.(Int)'), 5, 5.5, 1, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Spinazzola L.(Rom)'), 5, 5, 1, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Allan .(Nap)'), 5, 6.5, 1, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Petriccione J.(Lec)'), 5, 5.5, 1, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Rincon T.(Tor)'), 5, 6.25, 1, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Immobile C.(Laz)'), 5, 13.75, 1, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Insigne L.(Nap)'), 5, 5, 1, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Mertens D.(Nap)'), 5, 5.25, 1, FALSE);");

    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Caicedo F.(Laz)'), 5, null, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Ilicic J.(Ata)'), 5, 6.5, 0, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Palacio R.(Bol)'), 5, 8.5, 0, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Ramsey A.(Juv)'), 5, null, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Can E.(Juv)'), 5, 5.5, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Bennacer I.(Mil)'), 5, null, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Linetty K.(Sam)'), 5, null, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Pellegrini L.(Rom)'), 5, null, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Barreca A.(Gen)'), 5, null, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Bereszynski B.(Sam)'), 5, 4.75, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Depaoli F.(Sam)'), 5, 5.75, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Tomiyasu T.(Bol)'), 5, 6.75, 0, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Olsen R.(Cag)'), 5, 5.75, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Cragno A.(Cag)'), 5, null, 0, FALSE);");

    //6
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Olsen R.(Cag)'), 6, 7.75, 1, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Skriniar M.(Int)'), 6, 5.75, 1, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Di Lorenzo G.(Nap)'), 6, 6, 1, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Spinazzola L.(Rom)'), 6, 5.75, 1, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Bereszynski B.(Sam)'), 6, 6, 1, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Allan .(Nap)'), 6, 5.5, 1, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Petriccione J.(Lec)'), 6, 6.5, 1, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Rincon T.(Tor)'), 6, 5.75, 1, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Immobile C.(Laz)'), 6, 14.75, 1, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Mertens D.(Nap)'), 6, 5.5, 1, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Insigne L.(Nap)'), 6, 6.75, 1, TRUE);");

    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Musso J.(Udi)'), 6, 7, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Cragno A.(Cag)'), 6, null, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Ilicic J.(Ata)'), 6, 5, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Caicedo F.(Laz)'), 6, 6, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Palacio R.(Bol)'), 6, 6.5, 0, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Ramsey A.(Juv)'), 6, null, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Can E.(Juv)'), 6, null, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Bennacer I.(Mil)'), 6, null, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Linetty K.(Sam)'), 6, null, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Pellegrini L.(Rom)'), 6, null, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Barreca A.(Gen)'), 6, null, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Depaoli F.(Sam)'), 6, 6.25, 0, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Martella B.(Bre)'), 6, null, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Tomiyasu T.(Bol)'), 6, null, 0, FALSE);");

    //7
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Olsen R.(Cag)'), 7, 5.25, 1, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Skriniar M.(Int)'), 7, 5.75, 1, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Di Lorenzo G.(Nap)'), 7, 5.5, 1, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Spinazzola L.(Rom)'), 7, 5.75, 1, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Bereszynski B.(Sam)'), 7, 4.5, 1, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Allan .(Nap)'), 7, 6.75, 1, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Petriccione J.(Lec)'), 7, 5.75, 1, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Rincon T.(Tor)'), 7, 4.75, 1, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Immobile C.(Laz)'), 7, 12, 1, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Mertens D.(Nap)'), 7, 5.25, 1, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Insigne L.(Nap)'), 7, 6.25, 1, FALSE);");

    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Musso J.(Udi)'), 7, -0.75, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Cragno A.(Cag)'), 7, null, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Ilicic J.(Ata)'), 7, 14, 0, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Caicedo F.(Laz)'), 7, 2.25, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Palacio R.(Bol)'), 7, 10.75, 0, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Ramsey A.(Juv)'), 7, null, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Can E.(Juv)'), 7, 5.5, 0, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Bennacer I.(Mil)'), 7, 5.5, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Linetty K.(Sam)'), 7, null, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Pellegrini L.(Rom)'), 7, null, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Barreca A.(Gen)'), 7, null, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Depaoli F.(Sam)'), 7, 6.5, 0, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Martella B.(Bre)'), 7, null, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Tomiyasu T.(Bol)'), 7, null, 0, FALSE);");

    //8
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Olsen R.(Cag)'), 8, 4, 1, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Di Lorenzo G.(Nap)'), 8, 5.75, 1, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Skriniar M.(Int)'), 8, 2.75, 1, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Martella B.(Bre)'), 8, 6, 1, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Depaoli F.(Sam)'), 8, 5, 1, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Petriccione J.(Lec)'), 8, 6.25, 1, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Ramsey A.(Juv)'), 8, 6, 1, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Bennacer I.(Mil)'), 8, 5.5, 1, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Immobile C.(Laz)'), 8, 13.5, 1, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Ilicic J.(Ata)'), 8, 11, 1, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Mertens D.(Nap)'), 8, 6.25, 1, TRUE);");

    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Insigne L.(Nap)'), 8, 6.5, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Palacio R.(Bol)'), 8, 5.75, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Caicedo F.(Laz)'), 8, 6.25, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Rincon T.(Tor)'), 8, null, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Allan .(Nap)'), 8, null, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Can E.(Juv)'), 8, null, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Linetty K.(Sam)'), 8, null, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Pellegrini L.(Rom)'), 8, null, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Bereszynski B.(Sam)'), 8, null, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Barreca A.(Gen)'), 8, null, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Spinazzola L.(Rom)'), 8, null, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Tomiyasu T.(Bol)'), 8, null, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Musso J.(Udi)'), 8, 1.5, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Cragno A.(Cag)'), 8, null, 0, FALSE);");

    //9
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Olsen R.(Cag)'), 9, 7.5, 1, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Di Lorenzo G.(Nap)'), 9, 5.5, 1, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Skriniar M.(Int)'), 9, 5.5, 1, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Spinazzola L.(Rom)'), 9, 6.25, 1, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Depaoli F.(Sam)'), 9, 5, 1, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Rincon T.(Tor)'), 9, 6, 1, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Petriccione J.(Lec)'), 9, 6.75, 1, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Ramsey A.(Juv)'), 9, 6, 1, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Immobile C.(Laz)'), 9, 10.25, 1, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Insigne L.(Nap)'), 9, 6, 1, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Ilicic J.(Ata)'), 9, 3, 1, FALSE);");

    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Mertens D.(Nap)'), 9, 5.25, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Palacio R.(Bol)'), 9, 6, 0, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Caicedo F.(Laz)'), 9, 6, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Can E.(Juv)'), 9, null, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Bennacer I.(Mil)'), 9, 6.25, 0, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Linetty K.(Sam)'), 9, null, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Pellegrini L.(Rom)'), 9, null, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Allan .(Nap)'), 9, null, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Martella B.(Bre)'), 9, 5.25, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Bereszynski B.(Sam)'), 9, null, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Barreca A.(Gen)'), 9, 5.25, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Tomiyasu T.(Bol)'), 9, null, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Cragno A.(Cag)'), 9, null, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Musso J.(Udi)'), 9, 5.5, 0, FALSE);");

    //10
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Olsen R.(Cag)'), 10, 4.75, 1, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Di Lorenzo G.(Nap)'), 10, 5.25, 1, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Skriniar M.(Int)'), 10, 6.25, 1, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Spinazzola L.(Rom)'), 10, 5.75, 1, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Depaoli F.(Sam)'), 10, 5.75, 1, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Amrabat S.(Hel)'), 10, 6, 1, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Bennacer I.(Mil)'), 10, 6, 1, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Rincon T.(Tor)'), 10, 6.5, 1, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Immobile C.(Laz)'), 10, 11.25, 1, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Insigne L.(Nap)'), 10, 5, 1, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Palacio R.(Bol)'), 10, 5.5, 1, TRUE);");

    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Mertens D.(Nap)'), 10, 5.25, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Caicedo F.(Laz)'), 10, null, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Ilicic J.(Ata)'), 10, null, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Allan .(Nap)'), 10, null, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Ramsey A.(Juv)'), 10, null, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Can E.(Juv)'), 10, null, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Petriccione J.(Lec)'), 10, 6.5, 0, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Pellegrini L.(Rom)'), 10, null, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Barreca A.(Gen)'), 10, null, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Calabria D.(Mil)'), 10, null, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Bereszynski B.(Sam)'), 10, 6.25, 0, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Tomiyasu T.(Bol)'), 10, null, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Musso J.(Udi)'), 10, 11.5, 0, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Cragno A.(Cag)'), 10, null, 0, FALSE);");

    //11
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Musso J.(Udi)'), 11, 4.25, 1, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Di Lorenzo G.(Nap)'), 11, 6, 1, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Skriniar M.(Int)'), 11, 6.25, 1, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Depaoli F.(Sam)'), 11, 6, 1, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Tomiyasu T.(Bol)'), 11, 5.75, 1, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Allan .(Nap)'), 11, 6, 1, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Petriccione J.(Lec)'), 11, 5.75, 1, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Ramsey A.(Juv)'), 11, 5.25, 1, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Immobile C.(Laz)'), 11, 9.75, 1, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Insigne L.(Nap)'), 11, 5.25, 1, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Palacio R.(Bol)'), 11, 9.75, 1, TRUE);");

    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Mertens D.(Nap)'), 11, 5.25, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Caicedo F.(Laz)'), 11, 11.25, 0, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Ilicic J.(Ata)'), 11, null, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Pellegrini L.(Rom)'), 11, 7, 0, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Rincon T.(Tor)'), 11, null, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Amrabat S.(Hel)'), 11, 7.25, 0, TRUE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Can E.(Juv)'), 11, 6, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Bennacer I.(Mil)'), 11, null, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Spinazzola L.(Rom)'), 11, null, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Calabria D.(Mil)'), 11, 6, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Barreca A.(Gen)'), 11, null, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Bereszynski B.(Sam)'), 11, null, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Olsen R.(Cag)'), 11, 3, 0, FALSE);");
    $conn->exec("INSERT INTO player_vote (player_id, match_day_id, vote, selected, best) VALUES ((SELECT id FROM player WHERE `name` = 'Cragno A.(Cag)'), 11, null, 0, FALSE);");

    //12




    $manager->flush();
  }

}
