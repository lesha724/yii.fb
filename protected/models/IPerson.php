<?php
/**
 * Created by PhpStorm.
 * User: NEFF
 * Date: 30.11.2017
 * Time: 13:31
 */

/**
 * Interface IPerson
 */
interface IPerson
{
    /**
     * Проверка заблокирован или нет
     * @return bool
     */
    public function checkBlocked();
}