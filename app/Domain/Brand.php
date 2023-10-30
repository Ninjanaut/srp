<?php
declare(strict_types=1);

namespace App\Domain;

use App\Utils\Check;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use DomainException;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'Brand')]
class Brand
{
    #[Id, GeneratedValue, Column(type: Types::INTEGER)]
    private int $id;

    #[Column(name: 'name', type: Types::STRING)]
    private string $name;

    function __construct(string $name)
    {
        $this->checkName($name);
        $this->name = $name;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->checkId($id);
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function Update(string $name): void
    {
        $this->checkName($name);
        $this->name = $name;
    }

    private function checkName(string $name): void
    {
        if (Check::IsEmpty($name)) throw new DomainException("Brand name cannot be empty.");
    }

    private function checkId(int $id): void
    {
        if (!Check::ID($id)) throw new DomainException("ID is not valid.");
    }

    public function toJson()
    {
        $vars = array('id' => $this->id, 'name' => $this->name);
        return json_encode($vars);
    }
}