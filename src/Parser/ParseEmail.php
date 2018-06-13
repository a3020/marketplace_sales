<?php

namespace A3020\MarketplaceSales\Parser;

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

        return isset($matches[1]) ? $matches[1] : '';
    }

    private function getPkgName($email)
    {
        preg_match('/ been placed for: (.*) -/', $email, $matches);

        return isset($matches[1]) ? $matches[1] : '';
    }

    private function getPkgHandle($email)
    {
        preg_match('/addons\/(.*)\//', $email, $matches);
        $handle = isset($matches[1]) ? $matches[1] : '';

        if (empty($handle)) {
            preg_match('/themes\/(.*)\//', $email, $matches);
            $handle = isset($matches[1]) ? $matches[1] : '';
        }

        return $handle;
    }

    private function getUsername($email)
    {
        preg_match('/By the user: (.*) -/', $email, $matches);

        return isset($matches[1]) ? $matches[1] : '';
    }

    private function getUserId($email)
    {
        preg_match('/profile\/-\/(.*)\//', $email, $matches);

        return isset($matches[1]) ? $matches[1] : '';
    }

    private function getAmount($email)
    {
        preg_match('/has been credited: (.*)/', $email, $matches);

        return isset($matches[1]) ? $matches[1] : '';
    }
}
