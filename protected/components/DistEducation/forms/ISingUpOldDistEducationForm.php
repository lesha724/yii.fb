<?php
/**
 * Created by PhpStorm.
 * User: NEFF
 * Date: 16.11.2017
 * Time: 16:42
 */

/**
 * Interface ISingUpOldDistEducationForm
 * @property $params array
 * @property $universityId int
 */
interface ISingUpOldDistEducationForm{
    /**
     * Сформировать параметры для привязки к существующей Учетке
     * @return mixed
     */
    public function getParams();

    /**
     * код университета
     * @return int
     */
    public function getUniversityId();

    /**
     * ISingUpOldDistEducationForm constructor.
     * @param $universityId int код унвиерситета
     */
    public function __construct($universityId);
}