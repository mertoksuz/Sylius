<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Sylius\Component\Core\Model;

use Doctrine\Common\Collections\Collection;
use PhpSpec\ObjectBehavior;
use Sylius\Component\Core\Model\Taxon;
use Sylius\Component\Core\Model\TaxonImageInterface;
use Sylius\Component\Taxonomy\Model\TaxonInterface;

/**
 * @mixin Taxon
 *
 * @author Grzegorz Sadowski <grzegorz.sadowski@lakion.com>
 */
final class TaxonSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Taxon::class);
    }

    function it_is_Sylius_taxon()
    {
        $this->shouldImplement(TaxonInterface::class);
    }

    function it_initializes_image_collection_by_default()
    {
        $this->getImages()->shouldHaveType(Collection::class);
    }

    function it_adds_image(TaxonImageInterface $image)
    {
        $this->addImage($image);
        $this->hasImages()->shouldReturn(true);
        $this->hasImage($image)->shouldReturn(true);
    }

    function it_removes_image(TaxonImageInterface $image)
    {
        $this->addImage($image);
        $this->removeImage($image);
        $this->hasImage($image)->shouldReturn(false);
    }

    function it_returns_image_by_code(TaxonImageInterface $image)
    {
        $image->getCode()->willReturn('thumbnail');
        $image->setTaxon($this)->shouldBeCalled();

        $this->addImage($image);

        $this->getImageByCode('thumbnail')->shouldReturn($image);
    }
}
