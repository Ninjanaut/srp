<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Domain\Brand;
use InvalidArgumentException;
use Nette\Database\Explorer;

class BrandRepository
{
    protected readonly string $table;

    // Possible switch to ORM
    // public function __construct(private readonly ObjectManager $orm)
    public function __construct(private readonly Explorer $database)
    {
        $this->table = "brand";
    }

    public function add(Brand $brand): void
    {
        $this->database
            ->table($this->table)
            ->insert(['name' => $brand->getName()]);
    }

    public function delete(int $id): void
    {
        $this->database
            ->table($this->table)
            ->where('id', $id)
            ->delete();
    }

    public function update(Brand $brand): void
    {
        $this->database
            ->table($this->table)
            ->where('id', $brand->getId())
            ->update(['name' => $brand->getName()]);
    }

    public function get(int $id): Brand
    {
        $records = $this->database
            ->table($this->table)
            ->where('id', $id);

        return $this->toObjects($records)[0];
    }

    public function search(string $order, int $page, int $pageLength): array
    {
        $order = strtoupper($order);

        if ($order != 'ASC' && $order != 'DESC')
            throw new InvalidArgumentException("Order can be ASC or DESC only.");

        $offset = $page * $pageLength - $pageLength;

        $records = $this->database
            ->table($this->table)
            ->order('name ' . $order)
            ->limit($pageLength, $offset);

        return $this->toObjects($records);
    }

    public function count(): int
    {
        return $this->database
            ->table($this->table)
            ->count();
    }

    protected function toObjects($records): array
    {
        $brands = [];
        foreach ($records as $record) {
            $brand = new Brand($record->name);
            $brand->setId($record->id);
            $brands[] = $brand;
        }

        return $brands;
    }
}