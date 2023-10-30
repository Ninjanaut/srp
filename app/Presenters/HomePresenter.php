<?php /** @noinspection PhpUnhandledExceptionInspection */
declare(strict_types=1);

namespace App\Presenters;

use App\Domain\Brand;
use App\Repositories\BrandRepository;
use App\Utils\Check;
use DomainException;
use Exception;
use Nette\Database\UniqueConstraintViolationException;

final class HomePresenter extends BasePresenter
{
    public function __construct(private readonly BrandRepository $repo)
    {
        parent::__construct();
    }

    public function renderDefault(string $order = "asc", int $page = 1, int $limit = 10): void
    {
        try {
            $count = $this->repo->count();
            $this->template->order = $order;
            $this->template->page = $page;
            $this->template->limit = $limit;
            $this->template->pages = ceil($count / $limit);
            $this->template->brands = $this->repo->search($order, $page, $limit);
        } catch (Exception) {
            $this->badRequest();
        }
    }

    public function actionAdd(string $name): void
    {
        try {
            $brand = new Brand($name);
            $this->repo->add($brand);
        } catch (UniqueConstraintViolationException) {
            $this->badRequest('Brand name already exists.');
        } catch (DomainException $exception) {
            $this->badRequest($exception->getMessage());
        } catch (Exception) {
            $this->badRequest();
        }
        $this->ok();
    }

    public function actionDelete(int $id): void
    {
        if (!Check::ID($id)) {
            $this->badRequest();
        }
        try {
            $this->repo->delete($id);
        } catch (Exception) {
            $this->badRequest();
        }
        $this->ok();
    }

    public function actionUpdate(int $id, string $name): void
    {
        if (!Check::ID($id)) {
            $this->BadRequest();
        }
        try {
            $brand = $this->repo->get($id);
            $brand->Update($name);
            $this->repo->update($brand);
        } catch (UniqueConstraintViolationException) {
            $this->badRequest('Brand name already exists.');
        } catch (DomainException $exception) {
            $this->badRequest($exception->getMessage());
        } catch (Exception) {
            $this->BadRequest();
        }
        $this->ok();
    }
}

