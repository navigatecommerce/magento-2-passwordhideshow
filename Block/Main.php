<?php
/*
 * Navigate Commerce
 *
 * @author        Navigate Commerce
 * @package       Navigate_PasswordHideShow
 * @copyright     Copyright (c) Navigate (https://www.navigatecommerce.com/)
 * @license       https://www.navigatecommerce.com/end-user-license-agreement
 */

namespace Navigate\PasswordHideShow\Block;

use Magento\Framework\View\Element\Template;
use Magento\Store\Model\ScopeInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;

class Main extends \Magento\Framework\View\Element\Template
{
    protected const IS_ENABLE = 'passwordhideshow/general/enable';
    protected const ENABLE_LOGIN = 'passwordhideshow/general/enable_login_page';
    protected const ENABLE_REGISTRATION = 'passwordhideshow/general/enable_registration_page';
    protected const ENABLE_EDIT_ACCOUNT = 'passwordhideshow/general/enable_edit_account';
    protected const SHOW_PASSWORD = 'passwordhideshow/general/show_pasword';
    protected const HIDE_PASSWORD = 'passwordhideshow/general/hide_pasword';

    /**
     * @var StoreManagerInterface
     */
    protected $modelStoreManagerInterface;

    /**
     * Scope config Interface
     *
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * Construct method
     *
     * @param Template\Context $context
     * @param StoreManagerInterface $modelStoreManagerInterface
     * @param ScopeConfigInterface $scopeConfig
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        StoreManagerInterface $modelStoreManagerInterface,
        ScopeConfigInterface $scopeConfig,
        array $data = []
    ) {
        $this->modelStoreManagerInterface = $modelStoreManagerInterface;
        $this->scopeConfig = $scopeConfig;
        parent::__construct($context, $data);
    }

    /**
     * Get Current Store Info
     *
     * @return $this
     */
    public function getCurrentStoreInfo()
    {
        return $this->modelStoreManagerInterface->getStore()->getId();
    }

    /**
     * Function to check enabled or not
     *
     * @return boolean
     */
    public function isEnable()
    {
        return (bool)$this->scopeConfig->getValue(
            self::IS_ENABLE,
            ScopeInterface::SCOPE_STORE,
            $this->getCurrentStoreInfo()
        );
    }

    /**
     * Function to check enable for login or not
     *
     * @return boolean
     */
    public function isEnableForLogin()
    {
        if ($this->isEnable()) {
            return $this->scopeConfig->getValue(
                self::ENABLE_LOGIN,
                ScopeInterface::SCOPE_STORE,
                $this->getCurrentStoreInfo()
            );
        }
        return false;
    }

    /**
     * Function to check enabled for registration
     *
     * @return boolean
     */
    public function isEnableForRegistration()
    {
        if ($this->isEnable()) {
            return $this->scopeConfig->getValue(
                self::ENABLE_REGISTRATION,
                ScopeInterface::SCOPE_STORE,
                $this->getCurrentStoreInfo()
            );
        }
        return false;
    }

    /**
     * Function to check enable for edit account
     *
     * @return boolean
     */
    public function isEnableForEditAccount()
    {
        if ($this->isEnable()) {
            return $this->scopeConfig->getValue(
                self::ENABLE_EDIT_ACCOUNT,
                ScopeInterface::SCOPE_STORE,
                $this->getCurrentStoreInfo()
            );
        }
        return false;
    }

    /**
     * Retrive password iamge
     *
     * @return boolean|string
     */
    public function getShowPasswordImage()
    {
        if ($this->isEnable()) {
            $showpassword = "";
            $showpassword = $this->scopeConfig->getValue(
                self::SHOW_PASSWORD,
                ScopeInterface::SCOPE_STORE,
                $this->getCurrentStoreInfo()
            );
            if (!empty($showpassword)) {
                $mediaUrl = $this->modelStoreManagerInterface->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA).'Navigate/Icon/'; // phpcs:ignore
                return $mediaUrl.$showpassword;
            }
        }
        return false;
    }

    /**
     * Retrive hide password image
     *
     * @return boolean|string
     */
    public function getHidePasswordImage()
    {
        if ($this->isEnable()) {
            $hidepassword = "";
            $hidepassword = $this->scopeConfig->getValue(
                self::HIDE_PASSWORD,
                ScopeInterface::SCOPE_STORE,
                $this->getCurrentStoreInfo()
            );
            if (!empty($hidepassword)) {
                $mediaUrl = $this->modelStoreManagerInterface->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA).'Navigate/Icon/'; // phpcs:ignore
                return $mediaUrl.$hidepassword;
            }
        }
        return false;
    }
}
