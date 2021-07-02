<?php

namespace BurkiSchererAG\BSEventSubmit\ContaoManager;


use BurkiSchererAG\BSEventSubmit\BSEventSubmitBundle;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use Contao\CalendarBundle\ContaoCalendarBundle;

/**
 * Plugin for the Contao Manager.
 *
 * @author Tenzin Tsarma 
 */
class Plugin implements BundlePluginInterface
{
    /**
     * {@inheritdoc}
     */
    public function getBundles(ParserInterface $parser)
    {
        return [
            BundleConfig::create(BSEventSubmitBundle::class)
                ->setLoadAfter([ContaoCalendarBundle::class])
        ];
    }
}
