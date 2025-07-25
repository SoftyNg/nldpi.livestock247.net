<?php
class Trongate_security extends Trongate {

    /**
     * Ensures the user is allowed access for the specified scenario.
     *
     * @param string $scenario The scenario for access control. Default is 'admin panel'.
     * @param array $params (Optional) Additional parameters for more granular control.
     * @return mixed Returns a Trongate token, a boolean, or null.
     */
    public function _make_sure_allowed(string $scenario = 'admin panel', array $params = []): mixed {
        // Returns either a Trongate token, a boolean, or null.

        switch ($scenario) {
            // case 'members area':
            //     $this->module('members');
            //     $token = $this->members->_make_sure_allowed();
            //     break;
            case 'admin':
                $this->module('admin');
                $token = $this->admin->_make_sure_allowed();
                break;
            case 'service providers':
                $this->module('service_providers');
                $token = $this->service_providers->_make_sure_allowed();
                break;
             case 'veterinary professional':
                 $this->module('users');
                 $token = $this->users->_make_sure_allow_veterinary_professional();
                 break;
            default:
                $this->module('trongate_administrators');
                $token = $this->trongate_administrators->_make_sure_allowed($scenario, $params);
                break;
        }

        return $token;
    }

}