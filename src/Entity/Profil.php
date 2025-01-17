<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Profil
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $bio = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $linkedin = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $github = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $siteWeb = null;
}
