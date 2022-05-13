<?php
namespace Navigate\PasswordHideShow\Block;

use Magento\Framework\View\Element\Template;
use Magento\Store\Model\ScopeInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;

class Main extends \Magento\Framework\View\Element\Template
{
    const IS_ENABLE = 'passwordhideshow/general/enable';
    const ENABLE_LOGIN = 'passwordhideshow/general/enable_login_page';
    const ENABLE_REGISTRATION = 'passwordhideshow/general/enable_registration_page';
    const ENABLE_EDIT_ACCOUNT = 'passwordhideshow/general/enable_edit_account';
    const SHOW_PASSWORD = 'passwordhideshow/general/show_pasword';
    const HIDE_PASSWORD = 'passwordhideshow/general/hide_pasword';
    
    protected $modelStoreManagerInterface;
    protected $scopeConfig;

    public function __construct(Template\Context $context, StoreManagerInterface $modelStoreManagerInterface, ScopeConfigInterface $scopeConfig, array $data = [])
    {
        $this->modelStoreManagerInterface = $modelStoreManagerInterface;
        $this->scopeConfig = $scopeConfig;
        parent::__construct($context, $data);
    }

    public function getCurrentStoreInfo()
    {
        return $this->modelStoreManagerInterface->getStore()->getId();
    }

    public function isEnable()
    {
        return (bool)$this->scopeConfig->getValue(self::IS_ENABLE, ScopeInterface::SCOPE_STORE, $this->getCurrentStoreInfo());
    }

    public function IsEnableForLogin()
    {
        if ($this->isEnable()) {
            return $this->scopeConfig->getValue(self::ENABLE_LOGIN, ScopeInterface::SCOPE_STORE, $this->getCurrentStoreInfo());
        }
        return false;
    }

    public function IsEnableForRegistration()
    {
        if ($this->isEnable()) {
            return $this->scopeConfig->getValue(self::ENABLE_REGISTRATION, ScopeInterface::SCOPE_STORE, $this->getCurrentStoreInfo());
        }
        return false;
    }

    public function IsEnableForEditAccount()
    {
        if ($this->isEnable()) {
            return $this->scopeConfig->getValue(self::ENABLE_EDIT_ACCOUNT, ScopeInterface::SCOPE_STORE, $this->getCurrentStoreInfo());
        }
        return false;
    }

    public function getShowPasswordImage()
    {
        if ($this->isEnable()) {
            $showpassword = "";
            $showpassword = $this->scopeConfig->getValue(self::SHOW_PASSWORD, ScopeInterface::SCOPE_STORE, $this->getCurrentStoreInfo());
            if (!empty($showpassword)) {
                $mediaUrl = $this->modelStoreManagerInterface->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA).'Navigate/Icon/';
                return $mediaUrl.$showpassword;
            }
        }
        return false;
    }

    public function getHidePasswordImage()
    {
        if ($this->isEnable()) {
            $hidepassword = "";
            $hidepassword = $this->scopeConfig->getValue(self::HIDE_PASSWORD, ScopeInterface::SCOPE_STORE, $this->getCurrentStoreInfo());
            if (!empty($hidepassword)) {
                $mediaUrl = $this->modelStoreManagerInterface->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA).'Navigate/Icon/';
                return $mediaUrl.$hidepassword;
            }
        }
        return false;
    }
}
