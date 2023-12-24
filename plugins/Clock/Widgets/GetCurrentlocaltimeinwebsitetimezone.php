<?php
/**
 * Matomo - free/libre analytics platform
 *
 * @link https://matomo.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 *
 */
namespace Piwik\Plugins\Clock\Widgets;

use Piwik\Container\StaticContainer;
use Piwik\Site;
use Piwik\Widget\Widget;
use Piwik\Widget\WidgetConfig;

class GetCurrentlocaltimeinwebsitetimezone extends Widget
{
    public static function configure(WidgetConfig $config)
    {
        $config->setCategoryId('Clock_Utility');
        $config->setName('Clock_Currentlocaltimeinwebsitetimezone');
        $config->setOrder(99);
    }

    public function render()
    {
        $request = \Piwik\Request::fromRequest();
        $idSite = $request->getIntegerParameter('idSite', 0);
        $siteTimezone = Site::getTimezoneFor($idSite);

        $dateTimeProvider = StaticContainer::get('Piwik\Intl\Data\Provider\DateTimeFormatProvider');
        $is12HourFormat = $dateTimeProvider->uses12HourClock();

        return $this->renderTemplate('index', [
            'siteTimezone' => $siteTimezone,
            'is12HourFormat' => $is12HourFormat,
        ]);
    }

}
