<?php

namespace App\DataFixtures;

use App\Entity\Animal;
use App\Entity\Association;
use App\Entity\Breed;
use App\Entity\Species;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Ramsey\Uuid as Uuid;
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        // BREED

        $breedsStr = [
            'Labrador', 'Berger Allemand', 'Teckel', 'Bouledogue',
            'Caniche', 'Beagle', 'Dobermann', 'Border collie'
        ];

        for ($i = 0; $i < 8; $i++) {
            $breed = new Breed();
            $breed
                ->setUuid(Uuid\Uuid::uuid4())
                ->setDateCreation(new DateTime())
                ->setDateUpdate(null)
                ->setDeleted(null)
                ->setLabel($breedsStr[$i]);

            /** @var Breed[] $breedsObj */
            $breedsObj[] = $breed;

            $manager->persist($breed);
        }

        // SPECIES

        $speciesStr = [
            'Chien', 'Chat', 'Lapin', 'Hamster', 'Furet', 'Souris'
        ];

        for ($i = 0; $i < 6; $i++) {
            $species = new Species();
            $species
                ->setUuid(Uuid\Uuid::uuid4())
                ->setDateCreation(new DateTime())
                ->setDateUpdate(null)
                ->setDeleted(null)
                ->setLabel($speciesStr[$i]);

            /** @var Species[] $speciesObj */
            $speciesObj[] = $species;

            $manager->persist($species);
        }

        // ASSOCIATIONS

        for ($i = 0; $i < 5; $i++) {
            $association = new Association();
            $association
                ->setUuid(Uuid\Uuid::uuid4())
                ->setDateCreation(new DateTime())
                ->setDateUpdate(null)
                ->setDeleted(null)
                ->setName($faker->company)
                ->setLogo($faker->imageUrl(300, 300))
                ->setDescription($faker->realText())
                ->setPhone($faker->phoneNumber)
                ->setCellphone($faker->phoneNumber)
                ->setEmail($faker->email)
                ->setAddress($faker->address);

            /** @var Association[] $associationsObj */
            $associationsObj[] = $association;

            $manager->persist($association);
        }

        // ANIMALS

        for ($i = 0; $i < 20; $i++) {
            $animal = new Animal();
            $animal
                ->setUuid(Uuid\Uuid::uuid4())
                ->setDateCreation(new DateTime())
                ->setDateUpdate(null)
                ->setDeleted(null)
                ->setName($faker->firstName)
                ->setGender(($i % 2 == 0) ? 'male' : 'female')
                ->setAge($faker->numberBetween(1, 20))
                ->setDescription($faker->realText())
                ->setAssociation($associationsObj[$faker->numberBetween(0, count($associationsObj)-1)])
                ->setBreed($breedsObj[$faker->numberBetween(0, count($breedsObj)-1)])
                ->setSpecies($speciesObj[0]);

            $manager->persist($animal);
        }

        $manager->flush();
    }
}
