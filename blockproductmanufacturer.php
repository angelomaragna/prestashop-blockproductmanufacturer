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
    public function hookProductFooter($params)
    {

        $current_language_id = $this->context->language->id;

        $current_manufacturer_id            = $params['product']->id_manufacturer;
        $current_manufacturer_name          = $params['product']->manufacturer_name;

        $manufacturer                       = new ManufacturerCore($current_manufacturer_id);

        $current_manufacturer_description   = $manufacturer->short_description;

        $current_manufacturer_image         = $current_manufacturer_id.".jpg";

        $this->context->smarty->assign(
            array(
                'current_manufacturer_id'           => $current_manufacturer_id,
                'current_manufacturer_name'         => $current_manufacturer_name,
                'current_manufacturer_description'  => $current_manufacturer_description[$current_language_id],
                'current_manufacturer_image'        => $current_manufacturer_image,
            )
        );

        return $this->display(__FILE__, 'blockproductmanufacturer.tpl');
    }

    /**
     * Adds the module css to the head section
     *
     * @param $params
     * @return mixed
     */
    public function hookHeader($params)
    {
        $this->context->controller->addCSS(($this->_path).'blockproductmanufacturer.css', 'all');
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
            !$this->registerHook('productfooter') ||
            !$this->registerHook('header') ||
            !Configuration::updateValue('BLOCKPRODUCTMANUFACTURER_NAME', 'Block Product Manufacturer')
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