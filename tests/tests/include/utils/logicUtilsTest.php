<?php

use org\bovigo\vfs\vfsStream;

require_once 'include/utils/logic_utils.php';

class logic_utilsTest extends PHPUnit_Framework_TestCase
{
    public function testget_hook_array()
    {
        //test with a vaid module. it will return an array
        $AccountsHooks = get_hook_array('Accounts');
        $this->assertTrue(is_array($AccountsHooks));
    }

    private function getTestHook()
    {

        //array containing hooks array to test

        $hook_array = array();
        $hook_array['after_ui_footer'] = array();
        $hook_array['after_ui_footer'][] = array(10, 'popup_onload', 'modules/SecurityGroups/AssignGroups.php', 'AssignGroups', 'popup_onload');
        $hook_array['after_ui_frame'] = array();
        $hook_array['after_ui_frame'][] = array(20, 'mass_assign', 'modules/SecurityGroups/AssignGroups.php', 'AssignGroups', 'mass_assign');
        $hook_array['after_ui_frame'][] = array();
        $hook_array['after_save'] = array();
        $hook_array['after_save'][] = array(30, 'popup_select', 'modules/SecurityGroups/AssignGroups.php', 'AssignGroups', 'popup_select');
        $hook_array['after_delete'] = array();
        $hook_array['after_restore'] = array();

        return $hook_array;
    }

    public function check_existing_elementProvider()
    {
        //provide test cases dataset to validate 

        $hook_array = $this->getTestHook();

        return array(
                array($hook_array, 'after_save', array(0, 'popup_select'), true),
                array($hook_array, 'after_save', array(0, 'foo'), false),
                array($hook_array, 'foo', array(0, 'popup_select'), false),
        );
    }

    /**
     * @dataProvider check_existing_elementProvider
     */
    public function testcheck_existing_element($hook_array, $event, $action_array, $expected)
    {
        //test with dataset containing valid and invalid cases
        $this->assertSame(check_existing_element($hook_array, $event, $action_array), $expected);
    }

}
