<?php

namespace A3020\MarketplaceSales\Parser;

use Exception;

class ParseEmail
{
    /**
     * @param string $email
     *
     * @return array
     */
    public function parse($email)
    {
        $data = [];

        $data['orderNumber'] = $this->getOrderNumber($email);
        $data['pkgName'] = $this->getPkgName($email);
        $data['pkgHandle'] = $this->getPkgHandle($email);
        $data['username'] = $this->getUsername($email);
        $data['userId'] = $this->getUserId($email);
        $data['amount'] = $this->getAmount($email);

        return $data;
    }

    private function getOrderNumber($email)
    {
        preg_match('/ORDER NUMBER : #(.*)/', $email, $matches);

        return $this->returnOrFail($matches, t('Order number'));
    }

    private function getPkgName($email)
    {
        preg_match('/ been placed for: (.*) -/', $email, $matches);

        return $this->returnOrFail($matches, t('Add-on name'));
    }

    private function getPkgHandle($email)
    {
        preg_match('/addons\/(.*)\//', $email, $matches);

        if (!isset($matches[1])) {
            preg_match('/themes\/(.*)\//', $email, $matches);
        }

        return isset($matches[1]) ? $matches[1] : t('unknown');
    }

    private function getUsername($email)
    {
        preg_match('/By the user: (.*) -/', $email, $matches);

        return $this->returnOrFail($matches, t('Username'));
    }

    private function getUserId($email)
    {
        preg_match('/profile\/-\/(.*)\//', $email, $matches);

        return $this->returnOrFail($matches, t('User id'));
    }

    private function getAmount($email)
    {
        preg_match('/has been credited: (.*)/', $email, $matches);

        return $this->returnOrFail($matches, t('Amount'));
    }

    private function returnOrFail($matches, $type)
    {
        if (isset($matches[1]) && !empty($matches[1])) {
            return $matches[1];
        }

        throw new Exception($type . ' could not be parsed.');
    }
}
