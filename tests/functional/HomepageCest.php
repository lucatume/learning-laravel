<?php

use FunctionalTester as Tester;

class HomepageCest {
    public function _before( Tester $I ) {
    }

    /**
     * It should show the login option to non logged in users
     *
     * @test
     */
    public function should_show_the_login_option_to_non_logged_in_users( Tester $I ) {
        $I->amOnPage( '/' );
        $I->see( 'Login' );
    }
}
