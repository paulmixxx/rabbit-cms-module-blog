<?php

declare(strict_types=1);

namespace Paulmixxx\Blog\Domain\Entities\Post;

use Webmozart\Assert\Assert;

final class PostContent
{
    private string $header;
    private ?string $previewText;
    private ?string $detailText;

    /**
     * @SuppressWarnings(PHPMD)
     */
    public function __construct(
        string $header,
        ?string $previewText = null,
        ?string $detailText = null
    ) {
        Assert::stringNotEmpty($header);
        Assert::maxLength($header, 255);
        /** @psalm-suppress PossiblyNullArgument */
        Assert::maxLength($previewText, 65535); // @phpstan-ignore-line
        /** @psalm-suppress PossiblyNullArgument */
        Assert::maxLength($detailText, 65535); // @phpstan-ignore-line

        $this->header = $header;
        $this->previewText = $previewText;
        $this->detailText = $detailText;
    }

    public function getHeader(): string
    {
        return $this->header;
    }

    public function getPreviewText(): ?string
    {
        return $this->previewText;
    }

    public function getDetailText(): ?string
    {
        return $this->detailText;
    }

    /**
     * @SuppressWarnings(PHPMD)
     */
    public function changeHeader(string $header): self
    {
        Assert::stringNotEmpty($header);
        Assert::maxLength($header, 255);

        $this->header = $header;

        return $this;
    }

    /**
     * @SuppressWarnings(PHPMD)
     */
    public function changePreviewText(?string $previewText): self
    {
        /** @psalm-suppress PossiblyNullArgument */
        Assert::maxLength($previewText, 65535); // @phpstan-ignore-line

        $this->previewText = $previewText;

        return $this;
    }

    /**
     * @SuppressWarnings(PHPMD)
     */
    public function changeDetailText(?string $detailText): self
    {
        /** @psalm-suppress PossiblyNullArgument */
        Assert::maxLength($detailText, 65535); // @phpstan-ignore-line

        $this->detailText = $detailText;

        return $this;
    }
}
