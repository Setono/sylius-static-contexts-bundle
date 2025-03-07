<?php

declare(strict_types=1);

namespace Setono\SyliusStaticContextsBundle\Tests\Context;

use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Prophecy\Prophecy\ObjectProphecy;
use Setono\SyliusStaticContextsBundle\Context\StaticChannelContext;
use Sylius\Component\Channel\Context\ChannelNotFoundException;
use Sylius\Component\Channel\Model\ChannelInterface;
use Sylius\Component\Channel\Repository\ChannelRepositoryInterface;

final class StaticChannelContextTest extends TestCase
{
    use ProphecyTrait;

    /** @var ObjectProphecy<ChannelRepositoryInterface> */
    private ObjectProphecy $channelRepository;

    private StaticChannelContext $context;

    protected function setUp(): void
    {
        $this->channelRepository = $this->prophesize(ChannelRepositoryInterface::class);
        $this->context = new StaticChannelContext($this->channelRepository->reveal());
    }

    /**
     * @test
     */
    public function get_channel_throws_exception_when_channel_is_not_set(): void
    {
        $this->expectException(ChannelNotFoundException::class);
        $this->expectExceptionMessage('Static channel is not set');

        $this->context->getChannel();
    }

    /**
     * @test
     */
    public function set_channel_and_get_channel(): void
    {
        $channel = $this->prophesize(ChannelInterface::class)->reveal();

        $this->context->setChannel($channel);

        $this->assertSame($channel, $this->context->getChannel());
    }

    /**
     * @test
     */
    public function set_channel_code_throws_exception_if_channel_does_not_exist(): void
    {
        $this->channelRepository->findOneByCode('non_existing_code')->willReturn(null);

        $this->expectException(ChannelNotFoundException::class);
        $this->expectExceptionMessage('Channel with code "non_existing_code" does not exist');

        $this->context->setChannelCode('non_existing_code');
    }

    /**
     * @test
     */
    public function set_channel_code_successfully_sets_channel(): void
    {
        $channel = $this->prophesize(ChannelInterface::class)->reveal();

        $this->channelRepository->findOneByCode('existing_code')->willReturn($channel);

        $this->context->setChannelCode('existing_code');

        $this->assertSame($channel, $this->context->getChannel());
    }
}
