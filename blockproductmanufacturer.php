<?php
if (!defined('_PS_VERSION_'))
    exit;

class BlockProductmanufacturer extends Module
{
    /**
     * Setting default initialization values required by PrestaShop
     */
    public function __construct()
    {
        $this->name = 'blockproductmanufacturer';
        $this->tab = 'front_office_features';
        $this->version = '1.0.0';
        $this->author = 'Angelo Maragna';
        $this->need_instance = 0;
        $this->ps_versions_compliancy = array('min' => '1.6', 'max' => _PS_VERSION_);
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Block Product Manufacturer');
        $this->description = $this->l('This module displays product manufacturer\'s information, within the product page.');

        $this->confirmUninstall = $this->l('Are you sure you want to uninstall?');

        if (!Configuration::get('BLOCKPRODUCTMANUFACTURER_NAME'))
            $this->warning = $this->l('No name provided');
    }

    /**
     * Display the module content on displayFooterProduct hook, usually called right before the tabs
     * views/templates/hook/blockproductmanufacturer.tpl
     *
     * @param $params
     * @return mixed
     */
    public function hookDisplayFooterProduct($params)
    {
        echo "it's working like a charm";
        die();
        $current_manufacturer_id = 0;

        if (Tools::getValue('id_manufacturer'))
        {

        }

        if (Tools::getValue('id_manufacturer'))
        {
            $current_manufacturer_id = Tools::getValue('id_manufacturer');
        }

        $manufacturers = ManufacturerCore::getManufacturers();

        // assigning to each manufacturer his own shop url link
        if (isset($manufacturers))
        {
            $link = new Link();
            foreach ($manufacturers as $key => $manufacturer)
            {
                $manufacturer = new ManufacturerCore($manufacturer['id_manufacturer']);
                $manufacturers[$key]['link'] = $link->getManufacturerLink($manufacturer);
            }
        }

        $this->context->smarty->assign(
            array(
                'manufacturers' => $manufacturers,
                'current_manufacturer_id' => $current_manufacturer_id,
            )
        );

        return $this->display(__FILE__, 'blockproductmanufacturer.tpl');
    }

    /**
     * Install the module and register the hooks
     * @return bool
     */
    public function install()
    {
        if (Shop::isFeatureActive())
            Shop::setContext(Shop::CONTEXT_ALL);


        if (!parent::install() ||
            !$this->registerHook('leftColumn') ||
            !$this->registerHook('header') ||
            !Configuration::updateValue('BLOCKPRODUCTMANUFACTURER_NAME', 'Block Manufacturers')
        )
            return false;

        return true;
    }

    /**
     * Uninstall the module
     * @return bool
     */
    public function uninstall()
    {
        if (!parent::uninstall() ||
            !Configuration::deleteByName('BLOCKPRODUCTMANUFACTURER_NAME')
        )
            return false;

        return true;
    }



}