<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Player;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
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

        $manager->flush();
    }
}
