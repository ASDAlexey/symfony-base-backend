<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Nelmio\Alice\Fixtures;

class LoadFixtures implements FixtureInterface {
    public function load(ObjectManager $manager) {
        Fixtures::load(__DIR__ . '/fixtures.yml', $manager, ['providers' => [$this]]);
    }

    public function color() {
        $genera = ['yellow', 'white', 'black', 'red', 'gray'];
        $key = array_rand($genera);
        return $genera[$key];
    }

    public function phoneName() {
        $genera = ['Gretel A7', 'Vertu Aster Lagoon Calf', 'IPhone 5', 'IPhone 6', 'IPhone 7', 'IPhone 8'];
        $key = array_rand($genera);
        return $genera[$key];
    }
}