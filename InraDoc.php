<?php

use \ls\menu\MenuItem;
use \ls\menu\Menu;

/**
 * Page for adding Inra documentation in admin page in LimeSurvey 2.57.1
 * @since 2017-01-04
 * @author Marc Bruschera
 */
class InraDoc extends \ls\pluginmanager\PluginBase
{
    static protected $description = 'A frame to insert Inra Documentation';
    static protected $name = 'InraDoc';
    protected $storage = 'DbStorage';
    
    /**
     * Init plugin and subscribe to event
     * @return void
     */
    public function init()
    {
        $this->subscribe('beforeAdminMenuRender');
    }

    /**
     * Append menus to top admin menu bar
     * @return void
     */
    public function beforeAdminMenuRender()
    {
        // Create the URL to the plugin action
        $url = $this->api->createUrl(
            'admin/pluginhelper',
            array(
                'sa'     => 'fullpagewrapper',
                'plugin' => $this->getName(),
                'method' => 'actionIndex'  // Method name in our plugin
            )
        );

        // Append menu
        $event = $this->getEvent();
        $event->append('extraMenus', array(
            new Menu(array(
                'label' => 'Inra Doc',
                'href'  => $url,
                'iconClass' => 'icon-settings',
            ))
        ));
    }

    /**
     * @return string html 
     */
    public function actionIndex()
    {
        return $this->renderPartial('index', array(), true);
    }
}
