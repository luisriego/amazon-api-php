<?php

namespace Tests\Unit\Application\Usecase\Product\CreateProduct;

use App\Application\UseCase\Product\CreateProduct\CreateProduct;
use App\Application\UseCase\Product\CreateProduct\Dto\CreateProductInputDto;
use App\Application\UseCase\Product\CreateProduct\Dto\CreateProductOutputDto;
use App\Domain\Model\Product;
use App\Domain\Repository\CategoryRepositoryInterface;
use App\Domain\Repository\ProductRepositoryInterface;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\MockObject\MockObject;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\BrowserKit\AbstractBrowser;

final class CreateProductTest extends WebTestCase
{
    private const VALUES = [
        'sku' => 'Ken: 9780688046590',
        'name' => 'The Pillars of the Earth',
        'description' => 'A wonderfully history',
        'price' => '3900',
        'category' => '9f9422af-cb8a-47a1-8764-680b93d637f6',
    ];

    private readonly ProductRepositoryInterface|MockObject $productRepository;

    private readonly CreateProduct $useCase;

    protected static ?AbstractBrowser $client = null;

    /**
     * @throws Exception
     */
    public function setUp(): void
    {
        $this->productRepository = $this->createMock(ProductRepositoryInterface::class);
        $categoryRepository = $this->createMock(CategoryRepositoryInterface::class);
        $this->useCase = new CreateProduct(
            $this->productRepository,
            $categoryRepository,
        );
    }

    public function testCreateProduct(): void
    {
        $dto = CreateProductInputDto::create(
            self::VALUES['sku'],
            self::VALUES['name'],
            self::VALUES['description'],
            self::VALUES['price'],
            self::VALUES['category'],
        );

        $this->productRepository
            ->expects($this->once())
            ->method('add')
            ->with(
                $this->callback(function (Product $product): bool {
                    return $product->getName() === self::VALUES['name'];
                })
            );

        $responseDTO = $this->useCase->handle($dto);

        self::assertInstanceOf(CreateProductOutputDto::class, $responseDTO);
    }

    protected function createAuthenticatedClient(
        $username = 'luisriego@hotmail.com',
        $password = '123456!'
    ): KernelBrowser
    {
        $client = CreateProductTest::createClient();
        $client->request(
            'POST',
            '/api/login_check',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode([
                'username' => $username,
                'password' => $password,
            ])
        );

        $data = json_decode($client->getResponse()->getContent(), true);

        $client->setServerParameter('HTTP_Authorization', sprintf('Bearer %s', $data['token']));

        return $client;
    }
}