<?php
/**
 * Created by PhpStorm.
 * User: bface
 * Date: 05/08/2015
 * Time: 18:39
 */

namespace BluEstuary\CoreBundle\Model;


interface ModulableInterface extends CommonInterface
{

    /**
     * Sets module
     *
     * @param ModuleInterface $module
     * @return self
     */
    public function setModule(ModuleInterface $module);

    /**
     * Gets module
     *
     * @return ModuleInterface
     */
    public function getModule();

    /**
     * Gets module name
     *
     * @return string
     */
    public function getModuleName();

    /**
     * Gets module code
     *
     * @return string
     */
    public function getModuleCode();
} 